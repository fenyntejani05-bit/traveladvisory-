<?php

/**
 * Security Helper Class
 * 
 * Provides security-related utility methods for input sanitization,
 * XSS prevention, and CSRF protection.
 * 
 * @package Helpers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Security
{
    /**
     * Sanitizes input data to prevent XSS attacks
     * 
     * @param mixed $data Data to sanitize
     * @return mixed Sanitized data
     */
    public static function sanitize($data)
    {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }

        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escapes output for safe HTML display
     * 
     * @param string $string String to escape
     * @return string Escaped string
     */
    public static function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generates a CSRF token
     * 
     * @return string CSRF token
     */
    public static function generateCsrfToken(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validates a CSRF token
     * 
     * @param string $token Token to validate
     * @return bool True if valid, false otherwise
     */
    public static function validateCsrfToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Generates a secure random string
     * 
     * @param int $length Length of the string
     * @return string Random string
     */
    public static function randomString(int $length = 32): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Hashes a password using bcrypt
     * 
     * @param string $password Plain text password
     * @return string Hashed password
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifies a password against a hash
     * 
     * @param string $password Plain text password
     * @param string $hash Password hash
     * @return bool True if password matches, false otherwise
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}

