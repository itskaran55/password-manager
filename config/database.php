<?php
require_once __DIR__ . '/security.php';

class Database {
    // Replace with your Hostinger MySQL credentials
    private static $host = 'localhost';
    private static $db_name = 'u234754781_sa_p_manager';
    private static $username = 'u234754781_sa_p_manager';
    private static $password = 'SA_PASSWORD_Manager_230826_1013';
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false, // Enforce native prepared statements
                ];
                self::$conn = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                // Log real error on server, show generic error to browser
                error_log("Database Connection Error: " . $e->getMessage());
                die(json_encode([
                    'status' => 'error',
                    'message' => 'Database connection failed. Please check configurations.'
                ]));
            }
        }
        return self::$conn;
    }
}