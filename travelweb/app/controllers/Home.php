<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * Home Controller
 * 
 * Handles home page display with categories, tours, hotels, cars, and blogs.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Home extends Controller
{
    /**
     * Displays home page
     * 
     * Shows all available content including categories, tours,
     * hotels, cars, and blogs.
     * 
     * @return void
     */
    public function index(): void
    {
        $homeModel = $this->model('HomeModel');

        $categories = $homeModel->getAllCategories();
        
        // Calculate tour count for each category
        $categoriesWithCount = [];
        foreach ($categories as $category) {
            $category['tour_count'] = $homeModel->getTourCountByCategory($category['id']);
            $categoriesWithCount[] = $category;
        }

        $data = [
            'categories' => $categoriesWithCount,
            'tours' => $homeModel->getAllTours(),
            'hotels' => $homeModel->getAllHotels(),
            'cars' => $homeModel->getAllCars(),
            'blogs' => $homeModel->getAllBlogs(),
            'activities' => $homeModel->getAllActivities()
        ];

        $this->view('home', $data);
    }
}
