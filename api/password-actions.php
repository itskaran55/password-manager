<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Auth.php';
require_once __DIR__ . '/../src/PasswordService.php';

// Enforce Active Session Check on every request
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access. Please login.']);
    exit;
}

$pdo = Database::getConnection();
$userId = (int)$_SESSION['user_id'];
$userRole = $_SESSION['user_role'] ?? 'user';

// Strict isActive verification check
$userCheck = $pdo->prepare("SELECT is_active FROM users WHERE id = :id LIMIT 1");
$userCheck->execute([':id' => $userId]);
$user = $userCheck->fetch();

if (!$user || (int)$user['is_active'] !== 1) {
    session_unset();
    session_destroy();
    echo json_encode(['success' => false, 'message' => 'Account is deactivated.', 'redirect' => 'index.php?page=login']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ACTION 1: Fetch Assigned Passwords List
if ($action === 'list') {
    if ($userRole === 'admin') {
        // Admin sees all passwords
        $stmt = $pdo->prepare("
            SELECT p.id, p.title, p.username_or_email, p.website_url, p.category, p.notes, 
                   1 AS can_view, 1 AS can_edit
            FROM passwords p
            ORDER BY p.title ASC
        ");
        $stmt->execute();
    } else {
        // Regular user sees only explicitly granted passwords
        $stmt = $pdo->prepare("
            SELECT p.id, p.title, p.username_or_email, p.website_url, p.category, p.notes,
                   perm.can_view, perm.can_edit
            FROM passwords p
            INNER JOIN password_permissions perm ON p.id = perm.password_id
            WHERE perm.user_id = :user_id AND perm.can_view = 1
            ORDER BY p.title ASC
        ");
        $stmt->execute([':user_id' => $userId]);
    }

    $passwords = $stmt->fetchAll();
    echo json_encode(['success' => true, 'data' => $passwords]);
    exit;
}

// ACTION 2: Decrypt & Reveal Password
if ($action === 'reveal') {
    $passwordId = (int)($_POST['id'] ?? 0);

    if ($passwordId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid password identifier.']);
        exit;
    }

    if ($userRole === 'admin') {
        $stmt = $pdo->prepare("SELECT encrypted_password, iv FROM passwords WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $passwordId]);
    } else {
        $stmt = $pdo->prepare("
            SELECT p.encrypted_password, p.iv 
            FROM passwords p
            INNER JOIN password_permissions perm ON p.id = perm.password_id
            WHERE p.id = :id AND perm.user_id = :user_id AND perm.can_view = 1
            LIMIT 1
        ");
        $stmt->execute([':id' => $passwordId, ':user_id' => $userId]);
    }

    $row = $stmt->fetch();

    if (!$row) {
        echo json_encode(['success' => false, 'message' => 'Access denied or record does not exist.']);
        exit;
    }

    $decrypted = PasswordService::decryptPassword($row['encrypted_password'], $row['iv']);

    if ($decrypted === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to decrypt credential.']);
        exit;
    }

    echo json_encode(['success' => true, 'decrypted_password' => $decrypted]);
    exit;
}

// Add this inside api/password-actions.php after existing actions:

// ACTION 3: Admin Create New Credential
if ($action === 'create_credential') {
    if ($userRole !== 'admin') {
        echo json_encode(['success' => false, 'message' => 'Unauthorized operation.']);
        exit;
    }

    $title = trim($_POST['title'] ?? '');
    $usernameOrEmail = trim($_POST['username_or_email'] ?? '');
    $rawPassword = $_POST['raw_password'] ?? '';
    $websiteUrl = trim($_POST['website_url'] ?? '');
    $category = trim($_POST['category'] ?? 'General');
    $notes = trim($_POST['notes'] ?? '');

    if (empty($title) || empty($usernameOrEmail) || empty($rawPassword)) {
        echo json_encode(['success' => false, 'message' => 'Title, username/email, and password are required.']);
        exit;
    }

    // Encrypt password with AES-256-CBC
    $encryptedData = PasswordService::encryptPassword($rawPassword);

    $stmt = $pdo->prepare("
        INSERT INTO passwords (title, username_or_email, encrypted_password, iv, website_url, category, notes, created_by)
        VALUES (:title, :username_or_email, :encrypted_password, :iv, :website_url, :category, :notes, :created_by)
    ");

    $inserted = $stmt->execute([
        ':title'              => $title,
        ':username_or_email'  => $usernameOrEmail,
        ':encrypted_password' => $encryptedData['ciphertext'],
        ':iv'                 => $encryptedData['iv'],
        ':website_url'        => $websiteUrl,
        ':category'           => $category ?: 'General',
        ':notes'              => $notes,
        ':created_by'         => $userId
    ]);

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Credential encrypted and saved to vault.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save credential.']);
    }
    exit;
}

// ACTION 4: Admin Delete Credential
if ($action === 'delete_credential') {
    if ($userRole !== 'admin') {
        echo json_encode(['success' => false, 'message' => 'Unauthorized operation.']);
        exit;
    }

    $passwordId = (int)($_POST['id'] ?? 0);
    if ($passwordId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM passwords WHERE id = :id");
    $deleted = $stmt->execute([':id' => $passwordId]);

    if ($deleted) {
        echo json_encode(['success' => true, 'message' => 'Password removed from vault.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove password.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unknown endpoint action.']);
exit;