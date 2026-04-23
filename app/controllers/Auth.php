<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/AuthService.php';

/**
 * Authentication Controller
 * 
 * Handles user authentication including registration, login, and logout.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Auth extends Controller
{
    /**
     * Authentication service instance
     * 
     * @var AuthService
     */
    private $authService;

    /**
     * Auth constructor
     * 
     * Initializes the authentication service.
     */
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Handles user registration
     * 
     * Processes registration form submission and creates a new user account.
     * Redirects to home page on success.
     * 
     * @return void
     */
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $result = $this->authService->register($_POST);

        if ($result['success']) {
            header('Location: ' . BASEURL . '/home?action=registered');
        } else {
            echo $result['message'];
        }
        exit;
    }

    /**
     * Handles user login
     * 
     * Processes login form submission and authenticates user.
     * Redirects based on user role (admin or regular user).
     * 
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->authService->login($email, $password);

        if ($result['success']) {
            header('Location: ' . $result['redirect']);
        } else {
            header('Location: ' . BASEURL . '/home');
        }
        exit;
    }

    /**
     * Handles user logout
     * 
     * Destroys user session and redirects to home page.
     * 
     * @return void
     */
    public function logout(): void
    {
        $this->authService->logout();
        header('Location: ' . BASEURL . '/home');
        exit;
    }
}
