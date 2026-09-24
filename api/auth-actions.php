<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 0); // Keep output clean for JSON

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/security.php';
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../src/Auth.php';
} catch (Throwable $t) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Config Load Error: ' . $t->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$action = $_POST['action'] ?? '';
$csrfToken = $_POST['csrf_token'] ?? '';

// Fallback verification for CSRF
if (function_exists('verifyCsrfToken')) {
    if (!verifyCsrfToken($csrfToken)) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Session expired. Please refresh the page.']);
        exit;
    }
}

// 1. REGISTER
if ($action === 'register') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($fullName) || empty($email) || empty($password)) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    }

    if (strlen($password) < 6) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters.']);
        exit;
    }

    try {
        $pdo = Database::getConnection();

        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $checkStmt->execute([':email' => $email]);
        if ($checkStmt->fetch()) {
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'An account with this email already exists.']);
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("
            INSERT INTO users (full_name, email, password_hash, role, is_active) 
            VALUES (:full_name, :email, :password_hash, 'user', 1)
        ");
        $stmt->execute([
            ':full_name'     => $fullName,
            ':email'         => $email,
            ':password_hash' => $passwordHash
        ]);

        ob_clean();
        echo json_encode([
            'success' => true,
            'message' => 'Account created! Switching to Sign In...',
            'auto_switch_to_login' => true
        ]);
    } catch (Throwable $e) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
    }
    exit;
}

// 2. LOGIN
// Inside api/auth-actions.php (LOGIN ACTION)
if ($action === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Please enter both email and password.']);
        exit;
    }

    try {
        $result = Auth::login($email, $password);

        ob_clean();
        if ($result['status'] === true) {
            // Check if application is running in /password-manager/ subfolder
            $basePath = (strpos($_SERVER['REQUEST_URI'], '/password-manager/') !== false) 
                ? '/password-manager/' 
                : '';

            $redirectUrl = ($result['role'] === 'admin') 
                ? $basePath . 'admin/dashboard.php' 
                : $basePath . 'dashboard.php';

            echo json_encode([
                'success'  => true,
                'message'  => 'Credentials verified. Entering vault...',
                'redirect' => $redirectUrl
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $result['message'] ?? 'Invalid login credentials.'
            ]);
        }
    } catch (Throwable $t) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Auth Error: ' . $t->getMessage()]);
    }
    exit;
}

ob_clean();
echo json_encode(['success' => false, 'message' => 'Unknown action.']);
exit;