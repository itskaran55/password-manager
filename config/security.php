<?php
if (!defined('APP_INIT')) {
    define('APP_INIT', true);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Master Encryption Key (32 characters for AES-256)
if (!defined('ENCRYPTION_KEY')) {
    define('ENCRYPTION_KEY', 'SA_VAULT_SECURE_KEY_2026_!@#$%^');
}
if (!defined('CIPHER_METHOD')) {
    define('CIPHER_METHOD', 'AES-256-CBC');
}

// CSRF Token Utilities
if (!function_exists('generateCsrfToken')) {
    function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('verifyCsrfToken')) {
    function verifyCsrfToken($token) {
        if (!isset($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}