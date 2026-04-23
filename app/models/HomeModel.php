<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/BaseModel.php';

/**
 * Home Model
 * 
 * Handles database operations for home page content including
 * categories, tours, hotels, cars, and blogs. Also provides
 * CRUD operations for tour management.
 * 
 * @package Models
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class HomeModel extends BaseModel
{
    /**
     * HomeModel constructor
     * 
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Gets all categories
     * 
     * @return array Array of category records
     */
    public function getAllCategories(): array
    {
        $this->db->query("SELECT * FROM categories ORDER BY id ASC");
        return $this->db->resultSet();
    }

    /**
     * Gets a category by ID
     * 
     * @param int $id Category ID
     * @return array|false Category data or false if not found
     */
    public function getCategoryById(int $id)
    {
        $this->db->query("SELECT * FROM categories WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Gets tours by category ID
     * 
     * Checks if category_id column exists before querying.
     * If column doesn't exist, returns empty array.
     * 
     * @param int $categoryId Category ID
     * @return array Array of tour records
     */
    public function getToursByCategory(int $categoryId): array
    {
        // Check if category_id column exists
        if (!$this->columnExists('tours', 'category_id')) {
            return [];
        }

        $query = "SELECT * FROM tours 
                  WHERE category_id = :category_id 
                  ORDER BY id DESC";
        
        $this->db->query($query);
        $this->db->bind('category_id', $categoryId);
        return $this->db->resultSet();
    }

    /**
     * Gets tour count by category ID
     * 
     * Checks if category_id column exists before querying.
     * If column doesn't exist, returns 0.
     * 
     * @param int $categoryId Category ID
     * @return int Number of tours in category
     */
    public function getTourCountByCategory(int $categoryId): int
    {
        // Check if category_id column exists
        if (!$this->columnExists('tours', 'category_id')) {
            return 0;
        }

        $query = "SELECT COUNT(*) as total FROM tours WHERE category_id = :category_id";
        $this->db->query($query);
        $this->db->bind('category_id', $categoryId);
        $result = $this->db->single();
        return (int)($result['total'] ?? 0);
    }

    /**
     * Checks if a column exists in a table
     * 
     * @param string $tableName Table name
     * @param string $columnName Column name
     * @return bool True if column exists, false otherwise
     */
    private function columnExists(string $tableName, string $columnName): bool
    {
        try {
            $query = "SELECT COUNT(*) as count 
                     FROM information_schema.COLUMNS 
                     WHERE TABLE_SCHEMA = DATABASE() 
                     AND TABLE_NAME = :table_name 
                     AND COLUMN_NAME = :column_name";
            
            $this->db->query($query);
            $this->db->bind('table_name', $tableName);
            $this->db->bind('column_name', $columnName);
            $result = $this->db->single();
            
            return (int)($result['count'] ?? 0) > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Gets all tours
     * 
     * @return array Array of tour records
     */
    public function getAllTours(): array
    {
        $this->db->query("SELECT * FROM tours ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Gets all hotels
     * 
     * @return array Array of hotel records
     */
    public function getAllHotels(): array
    {
        $this->db->query("SELECT * FROM hotels ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Gets all cars
     * 
     * @return array Array of car records
     */
    public function getAllCars(): array
    {
        $this->db->query("SELECT * FROM cars ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Gets all blogs
     * 
     * @return array Array of blog records
     */
    public function getAllBlogs(): array
    {
        $this->db->query("SELECT * FROM blogs ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Gets a tour by ID
     * 
     * @param int $id Tour ID
     * @return array|false Tour data or false if not found
     */
    public function getTourById(int $id)
    {
        $this->db->query("SELECT * FROM tours WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Gets a hotel by ID
     * 
     * @param int $id Hotel ID
     * @return array|false Hotel data or false if not found
     */
    public function getHotelById(int $id)
    {
        $this->db->query("SELECT * FROM hotels WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Gets a car by ID
     * 
     * @param int $id Car ID
     * @return array|false Car data or false if not found
     */
    public function getCarById(int $id)
    {
        $this->db->query("SELECT * FROM cars WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Adds a new tour
     * 
     * @param array $data Tour data containing title, location, duration,
     *                    guests, price, and image_url
     * @return int Number of affected rows
     */
    public function addTour(array $data): int
    {
        $query = "INSERT INTO tours (title, location, duration, guests, price, image_url) 
                  VALUES (:title, :location, :duration, :guests, :price, :image_url)";
        
        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('location', $data['location']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('guests', $data['guests']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Deletes a tour
     * 
     * @param int $id Tour ID
     * @return int Number of affected rows
     */
    public function deleteTour(int $id): int
    {
        $this->db->query("DELETE FROM tours WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Updates a tour
     * 
     * @param array $data Tour data containing id, title, location, duration,
     *                    guests, price, and image_url
     * @return int Number of affected rows
     */
    public function updateTour(array $data): int
    {
        $query = "UPDATE tours SET 
                    title = :title,
                    location = :location,
                    duration = :duration,
                    guests = :guests,
                    price = :price,
                    image_url = :image_url
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('title', $data['title']);
        $this->db->bind('location', $data['location']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('guests', $data['guests']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Finds tours by planner preferences
     * 
     * @param string $climate
     * @param string $budget
     * @param string $activity
     * @return array Array of matched tours
     */
    public function findToursByPreferences(string $climate, string $budget, string $activity, string $location = ''): array
    {
        $selectClause = "SELECT *, ";
        $scoreExprs = [];
        $params = [];

        if (!empty($location)) {
            $scoreExprs[] = "IF(location LIKE :location OR title LIKE :location, 100, 0)";
            $params['location'] = '%' . $location . '%';
        }
        if (!empty($climate)) {
            $scoreExprs[] = "IF(climate = :climate, 10, 0)";
            $params['climate'] = $climate;
        }
        if (!empty($budget)) {
            $scoreExprs[] = "IF(budget = :budget, 8, 0)";
            $params['budget'] = $budget;
        }
        if (!empty($activity)) {
            $scoreExprs[] = "IF(activity = :activity, 6, 0)";
            $params['activity'] = $activity;
        }

        if (empty($scoreExprs)) {
            $query = "SELECT * FROM tours ORDER BY id DESC";
        } else {
            $scoreStr = implode(" + ", $scoreExprs);
            $query = $selectClause . "($scoreStr) as match_score FROM tours HAVING match_score > 0 ORDER BY match_score DESC, rating DESC LIMIT 10";
        }

        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->resultSet();
    }

    /**
     * Gets all activities
     * 
     * @return array Array of activity records
     */
    public function getAllActivities(): array
    {
        $this->db->query("SELECT * FROM activities ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Gets an activity by ID
     * 
     * @param int $id Activity ID
     * @return array|false Activity data or false if not found
     */
    public function getActivityById(int $id)
    {
        $this->db->query("SELECT * FROM activities WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
