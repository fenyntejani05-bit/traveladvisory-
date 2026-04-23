<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$db->query("UPDATE tours SET image_url = 'https://images.unsplash.com/photo-1623194723910-c0817ddaa8cb?auto=format&fit=crop&w=800&q=80' WHERE title = 'Manali Snow Adventure'");
$db->execute();
$db->query("UPDATE tours SET image_url = 'https://images.unsplash.com/photo-1589136777351-fdc9c9cb166f?auto=format&fit=crop&w=800&q=80' WHERE title = 'Rishikesh River Rafting'");
$db->execute();
$db->query("UPDATE tours SET image_url = 'https://images.unsplash.com/photo-1615836245337-f839dcc8a08e?auto=format&fit=crop&w=800&q=80' WHERE title = 'Udaipur City of Lakes'");
$db->execute();
$db->query("UPDATE categories SET image_url = 'https://images.unsplash.com/photo-1544989164-32a24558eeb0?auto=format&fit=crop&w=800&q=80' WHERE name = 'Himalayan Treks'");
$db->execute();

echo "DB Fixed!";
