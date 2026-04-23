<?php

/**
 * Authentication Middleware
 * 
 * Handles authentication checks for protected routes.
 * Ensures users are logged in before accessing certain pages.
 * 
 * @package Middleware
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class AuthMiddleware
{
    /**
     * Checks if user is authenticated
     * 
     * Redirects to home page if user is not logged in.
     * 
     * @return void
     */
    public static function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    /**
     * Checks if user is authenticated as admin
     * 
     * Redirects to home page if user is not logged in or not an admin.
     * 
     * @return void
     */
    public static function requireAdmin(): void
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    /**
     * Checks if user is authenticated and returns boolean
     * 
     * @return bool True if authenticated, false otherwise
     */
    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Checks if current user is an admin
     * 
     * @return bool True if admin, false otherwise
     */
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    /**
     * Gets the current authenticated user ID
     * 
     * @return int|null User ID or null if not authenticated
     */
    public static function getUserId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Gets the current authenticated user role
     * 
     * @return string|null User role or null if not authenticated
     */
    public static function getUserRole(): ?string
    {
        return $_SESSION['user_role'] ?? null;
    }
}

