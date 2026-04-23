<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * Category Controller
 * 
 * Handles category-related pages including category listing
 * and tours filtered by category.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Category extends Controller
{
    /**
     * Displays all categories page
     * 
     * Shows a grid/list of all available categories.
     * 
     * @return void
     */
    public function index(): void
    {
        $data = [
            'page_title' => 'Tour Categories',
            'categories' => $this->model('HomeModel')->getAllCategories()
        ];

        $this->view('category/index', $data);
    }

    /**
     * Displays tours by category
     * 
     * Shows tours filtered by a specific category.
     * 
     * @param int $id Category ID
     * @return void
     */
    public function show(int $id = 0): void
    {
        if ($id === 0) {
            header('Location: ' . BASEURL . '/category');
            exit;
        }

        $homeModel = $this->model('HomeModel');
        $category = $homeModel->getCategoryById($id);

        if (!$category) {
            header('Location: ' . BASEURL . '/category');
            exit;
        }

        $data = [
            'page_title' => $category['name'] . ' - Tour Categories',
            'category' => $category,
            'tours' => $homeModel->getToursByCategory($id),
            'tour_count' => $homeModel->getTourCountByCategory($id)
        ];

        $this->view('category/show', $data);
    }
}

