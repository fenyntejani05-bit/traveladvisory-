<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../helpers/Security.php';

/**
 * Authentication Service
 * 
 * Handles authentication-related business logic including
 * user registration, login, and session management.
 * 
 * @package Services
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class AuthService
{
    /**
     * User model instance
     * 
     * @var UserModel
     */
    private $userModel;

    /**
     * AuthService constructor
     * 
     * Initializes the user model.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Registers a new user
     * 
     * Validates input data and creates a new user account.
     * 
     * @param array $data User registration data
     * @return array Result array with success status and message
     */
    public function register(array $data): array
    {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return [
                'success' => false,
                'message' => 'All fields are required'
            ];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Invalid email format'
            ];
        }

        if ($this->userModel->getUserByEmail($data['email'])) {
            return [
                'success' => false,
                'message' => 'Email already registered'
            ];
        }

        if ($this->userModel->register($data) > 0) {
            return [
                'success' => true,
                'message' => 'Registration successful'
            ];
        }

        return [
            'success' => false,
            'message' => 'Registration failed'
        ];
    }

    /**
     * Authenticates a user and creates session
     * 
     * @param string $email User email
     * @param string $password User password
     * @return array Result array with success status, message, and user data
     */
    public function login(string $email, string $password): array
    {
        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Invalid email or password'
            ];
        }

        if (!Security::verifyPassword($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Invalid email or password'
            ];
        }

        $this->createSession($user);

        return [
            'success' => true,
            'message' => 'Login successful',
            'user' => $user,
            'redirect' => $user['role'] === 'admin' ? BASEURL . '/admin' : BASEURL . '/home'
        ];
    }

    /**
     * Creates user session
     * 
     * @param array $user User data
     * @return void
     */
    private function createSession(array $user): void
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
    }

    /**
     * Logs out the current user
     * 
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
    }
}

