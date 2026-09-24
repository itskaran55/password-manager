<?php
require_once __DIR__ . '/../config/database.php';

class Auth {
    
    /**
     * Authenticate user, verifying password & isActive status
     */
    public static function login($email, $password) {
        $pdo = Database::getConnection();
        
        $stmt = $pdo->prepare("SELECT id, full_name, email, password_hash, role, is_active FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => trim($email)]);
        $user = $stmt->fetch();

        if (!$user) {
            return ['status' => false, 'message' => 'Invalid email or password.'];
        }

        // Strict Check: Ensure user account is active
        if ((int)$user['is_active'] !== 1) {
            return ['status' => false, 'message' => 'Your account has been deactivated by an admin.'];
        }

        // Verify Bcrypt hash
        if (password_verify($password, $user['password_hash'])) {
            // Set session identifiers
            $_SESSION['user_id']   = (int)$user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email']= $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            return ['status' => true, 'role' => $user['role']];
        }

        return ['status' => false, 'message' => 'Invalid email or password.'];
    }

    /**
     * Middleware check: verifies session and ensures isActive has not been revoked mid-session
     */
   public static function validateActiveSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
    }

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT is_active, role FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    // Auto-logout if user was deactivated mid-session
    if (!$user || (int)$user['is_active'] !== 1) {
        session_unset();
        session_destroy();
        header("Location: index.php?page=login&error=deactivated");
        exit;
    }
}
}