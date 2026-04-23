<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

function fetchRealImage($url, $savePath) {
    // We use curl to fetch image data.
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Some sites like Picsum need a user agent
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200 && $data) {
        // Save only if valid image data (check header)
        if (strpos($data, '404') === false && strlen($data) > 1000) {
            file_put_contents($savePath, $data);
            return true;
        }
    }
    return false;
}

echo "Restoring Real Photos Local Migration...\n";

// Ensure directories
if (!is_dir(__DIR__ . '/public/img')) {
    mkdir(__DIR__ . '/public/img', 0755, true);
}

// TOURS
$db->query('SELECT id, title FROM tours');
$tours = $db->resultSet();
foreach ($tours as $t) {
    $filename = 'tour_real_' . $t['id'] . '.jpg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    // Picsum seed ensures same image for same id
    $success = fetchRealImage("https://picsum.photos/seed/tour_{$t['id']}/800/600", $path);
    
    if ($success) {
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $t['id']);
        $db->execute();
        echo "Tour {$t['id']} -> Success\n";
    } else {
        echo "Tour {$t['id']} -> Failed\n";
    }
    
    // Respect rate limits slightly
    usleep(200000); 
}

// HOTELS
$db->query('SELECT id, name FROM hotels');
$hotels = $db->resultSet();
foreach ($hotels as $h) {
    $filename = 'hotel_real_' . $h['id'] . '.jpg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $success = fetchRealImage("https://picsum.photos/seed/hotel_{$h['id']}/800/600", $path);
    
    if ($success) {
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE hotels SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $h['id']);
        $db->execute();
        echo "Hotel {$h['id']} -> Success\n";
    }
}

// CATEGORIES
$db->query('SELECT id, name FROM categories');
$cats = $db->resultSet();
foreach ($cats as $c) {
    $filename = 'cat_real_' . $c['id'] . '.jpg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $success = fetchRealImage("https://picsum.photos/seed/cat_{$c['id']}/600/400", $path);
    
    if ($success) {
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE categories SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $c['id']);
        $db->execute();
        echo "Cat {$c['id']} -> Success\n";
    }
}

echo "Image Fetch Complete!\n";
