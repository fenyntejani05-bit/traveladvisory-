<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

// Get all tour IDs
$db->query("SELECT id FROM tours");
$tours = $db->resultSet();
$tour_ids = array_column($tours, 'id');

if (empty($tour_ids)) {
    die("No tours found.");
}

// Get all category IDs
$db->query("SELECT id FROM categories");
$categories = $db->resultSet();

$inserted = 0;

foreach ($categories as $cat) {
    $cat_id = $cat['id'];
    
    // Check how many tours are already in this category
    $db->query("SELECT tour_id FROM category_tours WHERE category_id = :cid");
    $db->bind(':cid', $cat_id);
    $existing = $db->resultSet();
    $existing_ids = array_column($existing, 'tour_id');
    
    $needed = 8 - count($existing_ids); // Ensure at least 8 tours per category
    
    if ($needed > 0) {
        // Re-index $available_ids to correctly use array_rand
        $available_ids = array_values(array_diff($tour_ids, $existing_ids));
        
        if ($needed > count($available_ids)) {
            $needed = count($available_ids);
        }
        
        if ($needed > 0) {
            $random_tour_keys = (array) array_rand($available_ids, $needed);
            foreach ($random_tour_keys as $key) {
                $tour_id = $available_ids[$key];
                
                $db->query("INSERT IGNORE INTO category_tours (category_id, tour_id) VALUES (:cid, :tid)");
                $db->bind(':cid', $cat_id);
                $db->bind(':tid', $tour_id);
                $db->execute();
                $inserted++;
            }
        }
    }
}

echo "Successfully added $inserted new category-tour mappings!\n";
