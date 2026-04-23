<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * Tours Controller
 * 
 * Handles tour-related pages including tour listing and tour details.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Tours extends Controller
{
    /**
     * Displays all tours page
     * 
     * Shows a grid/list of all available tours.
     * 
     * @return void
     */
    public function index(): void
    {
        $data['page_title'] = 'All Tour Packages';
        $data['tours'] = $this->model('HomeModel')->getAllTours();
        $this->view('tours/index', $data);
    }

    /**
     * Displays tour detail page
     * 
     * Shows detailed information about a specific tour.
     * Redirects to tours list if tour not found.
     * 
     * @param int $id Tour ID
     * @return void
     */
    public function detail(int $id = 0): void
    {
        if ($id === 0) {
            header('Location: ' . BASEURL . '/tours');
            exit;
        }

        $data['tour'] = $this->model('HomeModel')->getTourById($id);

        if (!$data['tour']) {
            die('404: Tour not found!');
        }

        $data['page_title'] = $data['tour']['title'];
        $this->view('tours/detail', $data);
    }

    /**
     * Generates a customized trip plan based on search preferences
     * 
     * @return void
     */
    public function plan(): void
    {
        // Follow Post-Redirect-Get (PRG) pattern to prevent Form Resubmission errors
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['plan_search'] = $_POST;
            
            $location = trim($_POST['location'] ?? '');
            $climate = trim($_POST['climate'] ?? '');
            $budget = trim($_POST['budget'] ?? '');
            $activity = trim($_POST['activity'] ?? '');
            $startDate = trim($_POST['start_date'] ?? '');
            $endDate = trim($_POST['end_date'] ?? '');
            $dateRange = ($startDate && $endDate) ? $startDate . ' to ' . $endDate : date('Y-m-d') . ' to ' . date('Y-m-d');

            if (isset($_SESSION['user_id'])) {
                $this->model('ProfileModel')->savePlanHistory(
                    $_SESSION['user_id'], 
                    ($location ? "[$location] " : "") . ($climate ?: 'Any'), 
                    $budget ?: 'Any', 
                    $activity ?: 'Any', 
                    $dateRange
                );
            }

            header('Location: ' . BASEURL . '/tours/plan');
            exit;
        }

        // Handle GET request (rendering the view)
        $searchData = $_SESSION['plan_search'] ?? [];
        
        // If no search data in session, redirect to home
        if (empty($searchData)) {
            header('Location: ' . BASEURL);
            exit;
        }

        // Sanitize and read preferences from session data
        $location = trim($searchData['location'] ?? '');
        $climate = trim($searchData['climate'] ?? '');
        $budget = trim($searchData['budget'] ?? '');
        $activity = trim($searchData['activity'] ?? '');
        
        $startDate = trim($searchData['start_date'] ?? '');
        $endDate = trim($searchData['end_date'] ?? '');
        $dateRangeDisplay = '';
        
        if ($startDate && $endDate) {
            $dateRangeDisplay = date('M d, Y', strtotime($startDate)) . ' to ' . date('M d, Y', strtotime($endDate));
            $internalDateRange = $startDate . ' to ' . $endDate;
        } else {
            $dateRangeDisplay = date('M d, Y');
            $internalDateRange = date('Y-m-d') . ' to ' . date('Y-m-d');
        }

        // Fetch matched tours from the model
        $data['tours'] = $this->model('HomeModel')->findToursByPreferences($climate, $budget, $activity, $location);
        
        // If empty, fetch some highly-rated generic suggestions (limit 6)
        $data['suggested_tours'] = [];
        if (empty($data['tours'])) {
            $allTours = $this->model('HomeModel')->getAllTours();
            // Sort by rating or just take first 6
            $data['suggested_tours'] = array_slice($allTours, 0, 6);
        }

        $data['page_title'] = 'Your Personalized Trip Plan';
        $data['preferences'] = [
            'location' => $location,
            'climate' => $climate ?: 'Any',
            'budget' => $budget ?: 'Any',
            'activity' => $activity ?: 'Any',
            'date_range' => $internalDateRange,
            'date_range_display' => $dateRangeDisplay
        ];

        // Load the planner result view
        $this->view('tours/plan', $data);
    }
}
