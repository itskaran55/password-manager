<?php
require_once __DIR__ . '/../config/security.php';

class PasswordService {
    
    /**
     * Encrypt a plaintext password using AES-256-CBC
     * @param string $plainText
     * @return array ['ciphertext' => string, 'iv' => string]
     */
    public static function encryptPassword($plainText) {
        // Generate a 16-byte cryptographically secure initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(CIPHER_METHOD));
        
        // Encrypt the payload
        $encrypted = openssl_encrypt(
            $plainText,
            CIPHER_METHOD,
            ENCRYPTION_KEY,
            0,
            $iv
        );

        return [
            'ciphertext' => $encrypted,
            'iv'         => base64_encode($iv)
        ];
    }

    /**
     * Decrypt a ciphertext password
     * @param string $ciphertext
     * @param string $base64Iv
     * @return string|false
     */
    public static function decryptPassword($ciphertext, $base64Iv) {
        $iv = base64_decode($base64Iv);
        return openssl_decrypt(
            $ciphertext,
            CIPHER_METHOD,
            ENCRYPTION_KEY,
            0,
            $iv
        );
    }
}