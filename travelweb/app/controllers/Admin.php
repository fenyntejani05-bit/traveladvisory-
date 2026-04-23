<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

/**
 * Admin Controller
 * 
 * Handles all admin-related operations including dashboard,
 * transaction management, tour management, and profile management.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Admin extends Controller
{


    /**
     * Admin constructor
     * 
     * Initializes services and checks admin authentication.
     */
    public function __construct()
    {
        AuthMiddleware::requireAdmin();
    }

    /**
     * Displays admin dashboard
     * 
     * Shows statistics, charts, and recent transactions.
     * 
     * @return void
     */
    public function index(): void
    {
        $data['page_title'] = "Admin Dashboard";
        $data['stats'] = [];
        
        $homeModel = $this->model('HomeModel');
        $data['stats']['total_tours'] = count($homeModel->getAllTours());
        
        $this->view('admin/index', $data);
    }



    /**
     * Displays tour management page
     * 
     * Shows list of all tours for admin management.
     * 
     * @return void
     */
    public function tours(): void
    {
        $data['page_title'] = "Manage Tour Packages";
        $data['tours'] = $this->model('HomeModel')->getAllTours();
        $this->view('admin/tours/index', $data);
    }

    /**
     * Displays tour creation form
     * 
     * Shows form to add a new tour.
     * 
     * @return void
     */
    public function createTour(): void
    {
        $data['page_title'] = "Add New Tour";
        $this->view('admin/tours/create', $data);
    }

    /**
     * Processes tour creation
     * 
     * Handles form submission to create a new tour.
     * 
     * @return void
     */
    public function storeTour(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }

        $homeModel = $this->model('HomeModel');
        if ($homeModel->addTour($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }

        echo "Failed to add tour.";
    }

    /**
     * Deletes a tour
     * 
     * Removes a tour from the database.
     * 
     * @param int $id Tour ID
     * @return void
     */
    public function deleteTour(int $id): void
    {
        $homeModel = $this->model('HomeModel');
        if ($homeModel->deleteTour($id) > 0) {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }

        echo "Failed to delete tour.";
    }

    /**
     * Displays tour edit form
     * 
     * Shows form to edit an existing tour.
     * 
     * @param int $id Tour ID
     * @return void
     */
    public function editTour(int $id): void
    {
        $data['page_title'] = "Edit Tour";
        $data['tour'] = $this->model('HomeModel')->getTourById($id);
        
        if (!$data['tour']) {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }
        
        $this->view('admin/tours/edit', $data);
    }

    /**
     * Processes tour update
     * 
     * Handles form submission to update an existing tour.
     * 
     * @return void
     */
    public function updateTour(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }

        $homeModel = $this->model('HomeModel');
        if ($homeModel->updateTour($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/tours');
            exit;
        }

        echo "Failed to update tour.";
    }

    /**
     * Displays admin profile page
     * 
     * Shows admin profile information and edit forms.
     * 
     * @return void
     */
    public function profile(): void
    {
        $data['page_title'] = "My Profile";
        $userModel = $this->model('UserModel');
        $data['user'] = $userModel->getUserById(AuthMiddleware::getUserId());
        $this->view('admin/profile', $data);
    }

    /**
     * Updates admin profile
     * 
     * Processes profile update form submission.
     * 
     * @return void
     */
    public function updateProfile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }

        $userModel = $this->model('UserModel');
        $id = AuthMiddleware::getUserId();
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        if ($userModel->updateProfile($id, $name, $email) > 0) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            header('Location: ' . BASEURL . '/admin/profile?success=1');
        } else {
            header('Location: ' . BASEURL . '/admin/profile?error=1');
        }
        exit;
    }

    /**
     * Updates admin password
     * 
     * Processes password update form submission.
     * 
     * @return void
     */
    public function updatePassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }

        $userModel = $this->model('UserModel');
        $id = AuthMiddleware::getUserId();
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';

        if (!$userModel->verifyPassword($id, $currentPassword)) {
            header('Location: ' . BASEURL . '/admin/profile?error=2');
            exit;
        }

        if ($userModel->updatePassword($id, $newPassword) > 0) {
            header('Location: ' . BASEURL . '/admin/profile?success=2');
        } else {
            header('Location: ' . BASEURL . '/admin/profile?error=3');
        }
        exit;
    }
}
