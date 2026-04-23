<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * Hotels Controller
 * 
 * Handles displaying hotel details.
 */
class Hotels extends Controller
{
    /**
     * Displays all hotels page
     * 
     * Shows a list of all available hotels.
     * 
     * @return void
     */
    public function index(): void
    {
        $data['page_title'] = 'All Hotels';
        $data['hotels'] = $this->model('HomeModel')->getAllHotels();
        $this->view('hotels/index', $data);
    }
    /**
     * Displays hotel detail page
     * 
     * @param int $id Hotel ID
     * @return void
     */
    public function detail(int $id): void
    {
        $homeModel = $this->model('HomeModel');
        $hotel = $homeModel->getHotelById($id);
        
        if (!$hotel) {
            header('Location: ' . BASEURL);
            exit;
        }

        $data = [
            'hotel' => $hotel,
            'page_title' => $hotel['name'] . " - Details"
        ];

        $this->view('hotels/detail', $data);
    }
}
