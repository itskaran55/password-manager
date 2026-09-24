<?php
// 1. MUST load security config so cookie domain, path & name match exactly
if (file_exists(__DIR__ . '/config/security.php')) {
    require_once __DIR__ . '/config/security.php';
}

// 2. Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Completely wipe session array
$_SESSION = [];

// 4. Force delete session cookies from browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    
    // Clear with exact session params
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
    
    // Clear root and subfolder paths as fallback
    setcookie(session_name(), '', time() - 42000, '/');
    setcookie(session_name(), '', time() - 42000, '/password-manager/');
    setcookie('PHPSESSID', '', time() - 42000, '/');
    setcookie('PHPSESSID', '', time() - 42000, '/password-manager/');
}

// 5. Destroy server session data
session_unset();
session_destroy();

// 6. Prevent browser back-button caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// 7. Redirect to login page
header("Location: index.php?page=login");
exit;