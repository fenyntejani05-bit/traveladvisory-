<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$db->query("SELECT id, name FROM categories");
$categories = $db->resultSet();

$inserted = 0;
$dummy_images = [
    'https://images.unsplash.com/photo-1544641886-f138e6df61c7?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1506450372079-913aeb6d5257?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1514222134-b57cbb8ce073?auto=format&fit=crop&w=600&q=80'
];

foreach ($categories as $cat) {
    if (!isset($cat['id'])) continue;
    
    $db->query("SELECT COUNT(*) as count FROM tours WHERE category_id = :cid");
    $db->bind(':cid', $cat['id']);
    $res = $db->single();
    $count = $res['count'] ?? 0;
    
    $needed = 4 - $count;
    
    for ($i = 0; $i < $needed; $i++) {
        $db->query("INSERT INTO tours (title, location, duration, guests, price, rating, reviews, image_url, category_id, climate, budget, activity) 
                    VALUES (:title, :loc, '3 Days', 4, 15000, 4.8, 120, :img, :cid, 'Tropical', 'Medium', 'Relaxing')");
        $db->bind(':title', 'Explore ' . $cat['name'] . ' ' . rand(100, 999));
        $db->bind(':loc', 'Greater ' . $cat['name']);
        $db->bind(':img', $dummy_images[array_rand($dummy_images)]);
        $db->bind(':cid', $cat['id']);
        $db->execute();
        $inserted++;
    }
}

echo "Inserted $inserted new tours into categories.\n";
