<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * API Controller
 * 
 * Provides RESTful API endpoints for external access to application data.
 * Returns JSON responses for tours, hotels, and authentication.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Api extends Controller
{
    /**
     * Api constructor
     * 
     * Sets JSON content type header for all API responses.
     */
    public function __construct()
    {
        header('Content-Type: application/json; charset=utf-8');
    }

    /**
     * API index endpoint
     * 
     * Returns API information and status.
     * 
     * @return void
     */
    public function index(): void
    {
        echo json_encode([
            'status' => 'success',
            'message' => 'Selamat Datang di TravelAdvisor API v1.0',
            'author' => 'Doni Setiawan'
        ]);
    }

    /**
     * Gets all tours
     * 
     * Returns JSON response with all available tours.
     * 
     * @return void
     */
    public function tours(): void
    {
        $tours = $this->model('HomeModel')->getAllTours();
        
        echo json_encode([
            'status' => 'success',
            'total_data' => count($tours),
            'data' => $tours
        ]);
    }

    /**
     * Gets all hotels
     * 
     * Returns JSON response with all available hotels.
     * 
     * @return void
     */
    public function hotels(): void
    {
        $hotels = $this->model('HomeModel')->getAllHotels();
        
        echo json_encode([
            'status' => 'success',
            'total_data' => count($hotels),
            'data' => $hotels
        ]);
    }

    /**
     * Gets tour detail by ID
     * 
     * Returns JSON response with tour details or 404 if not found.
     * 
     * @param int $id Tour ID
     * @return void
     */
    public function tour_detail(int $id = 0): void
    {
        $tour = $this->model('HomeModel')->getTourById($id);

        if ($tour) {
            echo json_encode([
                'status' => 'success',
                'data' => $tour
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Data wisata tidak ditemukan'
            ]);
        }
    }

    /**
     * Handles API login
     * 
     * Authenticates user via API and returns user data (without password).
     * 
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Method harus POST'
            ]);
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model('UserModel')->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Login Berhasil',
                'data' => $user
            ]);
        } else {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Email atau Password salah!'
            ]);
        }
    }
}
