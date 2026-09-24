<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Auth.php';

// Strict Admin Session Check
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized admin access.']);
    exit;
}

$pdo = Database::getConnection();
$adminId = (int)$_SESSION['user_id'];

// Check admin isActive state
$adminCheck = $pdo->prepare("SELECT is_active FROM users WHERE id = :id LIMIT 1");
$adminCheck->execute([':id' => $adminId]);
$admin = $adminCheck->fetch();

if (!$admin || (int)$admin['is_active'] !== 1) {
    session_unset();
    session_destroy();
    echo json_encode(['success' => false, 'message' => 'Admin session expired.', 'redirect' => '../index.php?page=login']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ACTION 1: List All Users with Assigned Password Counts
if ($action === 'list') {
    $stmt = $pdo->prepare("
        SELECT u.id, u.full_name, u.email, u.role, u.is_active, u.created_at,
               COUNT(perm.password_id) AS assigned_passwords_count
        FROM users u
        LEFT JOIN password_permissions perm ON u.id = perm.user_id AND perm.can_view = 1
        GROUP BY u.id
        ORDER BY u.id ASC
    ");
    $stmt->execute();
    $users = $stmt->fetchAll();

    echo json_encode(['success' => true, 'data' => $users]);
    exit;
}

// ACTION 2: Toggle isActive Status (1 <-> 0)
if ($action === 'toggle_status') {
    $targetUserId = (int)($_POST['user_id'] ?? 0);
    $newStatus = (int)($_POST['is_active'] ?? 0);

    if ($targetUserId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid user ID.']);
        exit;
    }

    // Prevent admin from deactivating themselves
    if ($targetUserId === $adminId) {
        echo json_encode(['success' => false, 'message' => 'You cannot deactivate your own active admin account.']);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET is_active = :status WHERE id = :id");
    $updated = $stmt->execute([':status' => $newStatus, ':id' => $targetUserId]);

    if ($updated) {
        $statusLabel = $newStatus === 1 ? 'activated' : 'deactivated';
        echo json_encode([
            'success' => true,
            'message' => "User account has been {$statusLabel} successfully."
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user status.']);
    }
    exit;
}

// ACTION 3: Create New User / Team Member
if ($action === 'create') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if (empty($fullName) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Check for duplicate email
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $checkStmt->execute([':email' => $email]);
    if ($checkStmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'A user with this email already exists.']);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("
        INSERT INTO users (full_name, email, password_hash, role, is_active) 
        VALUES (:full_name, :email, :password_hash, :role, 1)
    ");
    $inserted = $stmt->execute([
        ':full_name'     => $fullName,
        ':email'         => $email,
        ':password_hash' => $passwordHash,
        ':role'          => $role === 'admin' ? 'admin' : 'user'
    ]);

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'New team member added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
    }
    exit;
}

// ACTION 4: Fetch User Permissions for Matrix Modal
if ($action === 'get_user_permissions') {
    $targetUserId = (int)($_GET['user_id'] ?? 0);

    $stmt = $pdo->prepare("
        SELECT p.id, p.title, p.category, p.username_or_email,
               IF(perm.can_view IS NULL, 0, perm.can_view) AS can_view,
               IF(perm.can_edit IS NULL, 0, perm.can_edit) AS can_edit
        FROM passwords p
        LEFT JOIN password_permissions perm ON p.id = perm.password_id AND perm.user_id = :user_id
        ORDER BY p.title ASC
    ");
    $stmt->execute([':user_id' => $targetUserId]);
    $permissions = $stmt->fetchAll();

    echo json_encode(['success' => true, 'data' => $permissions]);
    exit;
}

// ACTION 5: Save Updated User Permissions
if ($action === 'save_permissions') {
    $targetUserId = (int)($_POST['user_id'] ?? 0);
    $selectedPasswordIds = json_decode($_POST['password_ids'] ?? '[]', true);

    if ($targetUserId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid user ID.']);
        exit;
    }

    // Delete existing permissions for this user
    $delStmt = $pdo->prepare("DELETE FROM password_permissions WHERE user_id = :user_id");
    $delStmt->execute([':user_id' => $targetUserId]);

    // Insert new selected permissions
    if (!empty($selectedPasswordIds)) {
        $insStmt = $pdo->prepare("
            INSERT INTO password_permissions (password_id, user_id, can_view, can_edit) 
            VALUES (:password_id, :user_id, 1, 0)
        ");
        foreach ($selectedPasswordIds as $pwdId) {
            $insStmt->execute([
                ':password_id' => (int)$pwdId,
                ':user_id'     => $targetUserId
            ]);
        }
    }

    echo json_encode(['success' => true, 'message' => 'Permissions updated successfully.']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unknown admin action.']);
exit;