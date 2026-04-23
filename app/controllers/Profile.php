<?php

require_once __DIR__ . '/../core/Controller.php';

class Profile extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $userId = $_SESSION['user_id'];
        
        $userModel = $this->model('UserModel');
        $profileModel = $this->model('ProfileModel');

        $data['page_title'] = 'My Profile - TravelAdvisor';
        $data['user'] = $userModel->getUserById($userId);
        
        // Fetch histories and wishlists
        $data['plan_history'] = $profileModel->getPlanHistory($userId);
        $data['wishlist_tours'] = $profileModel->getWishlistTours($userId);
        $data['wishlist_hotels'] = $profileModel->getWishlistHotels($userId);

        $this->view('user/profile', $data);
    }

    public function toggleWishlist(): void
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to auth if not logged in
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL);
            exit;
        }

        $userId = $_SESSION['user_id'];
        $itemId = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
        $itemType = isset($_POST['item_type']) ? $_POST['item_type'] : '';
        $action = isset($_POST['action']) ? $_POST['action'] : 'add';

        if ($itemId && in_array($itemType, ['tour', 'hotel'])) {
            $profileModel = $this->model('ProfileModel');

            if ($action === 'add') {
                $profileModel->addWishlist($userId, $itemId, $itemType);
            } else {
                $profileModel->removeWishlist($userId, $itemId, $itemType);
            }
        }

        // Redirect back to the page the user was on
        $referer = $_SERVER['HTTP_REFERER'] ?? BASEURL;
        header('Location: ' . $referer);
        exit;
    }

    public function uploadPhoto(): void    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $userId = $_SESSION['user_id'];
            $file = $_FILES['photo'];
            
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = 'profile_' . $userId . '_' . time() . '.' . $fileExtension;
                // Note: Ensure the public/img/profiles directory exists and is writable
                $uploadFileDir = __DIR__ . '/../../public/img/profiles/';
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $this->model('UserModel')->updateImage($userId, $newFileName);
                }
            }
        }
        
        header('Location: ' . BASEURL . '/profile');
        exit;
    }
}
