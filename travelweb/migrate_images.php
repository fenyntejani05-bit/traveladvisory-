<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

function downloadImage($url, $savePath) {
    $dir = dirname($savePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    echo "Downloading $url...\n";
    $ch = curl_init($url);
    $fp = fopen($savePath, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

// 1. Tours
$db->query('SELECT id, image_url FROM tours WHERE image_url LIKE "%http%"');
$tours = $db->resultSet();
foreach ($tours as $t) {
    if (strpos($t['image_url'], 'http') !== false) {
        $filename = 'tour_' . $t['id'] . '_' . uniqid() . '.jpg';
        $path = __DIR__ . '/public/img/' . $filename;
        downloadImage($t['image_url'], $path);
        
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $t['id']);
        $db->execute();
    }
}

// 2. Hotels
$db->query('SELECT id, image_url FROM hotels WHERE image_url LIKE "%http%"');
$hotels = $db->resultSet();
foreach ($hotels as $h) {
    if (strpos($h['image_url'], 'http') !== false) {
        $filename = 'hotel_' . $h['id'] . '_' . uniqid() . '.jpg';
        $path = __DIR__ . '/public/img/' . $filename;
        downloadImage($h['image_url'], $path);
        
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE hotels SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $h['id']);
        $db->execute();
    }
}

// 3. Categories
$db->query('SELECT id, image_url FROM categories WHERE image_url LIKE "%http%"');
$cats = $db->resultSet();
foreach ($cats as $c) {
    if (strpos($c['image_url'], 'http') !== false) {
        $filename = 'cat_' . $c['id'] . '_' . uniqid() . '.jpg';
        $path = __DIR__ . '/public/img/' . $filename;
        downloadImage($c['image_url'], $path);
        
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE categories SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $c['id']);
        $db->execute();
    }
}

echo "Migration Complete.\n";
