<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$newCats = [
    ['name' => 'Wildlife', 'tours' => 150, 'acts' => 80],
    ['name' => 'Heritage', 'tours' => 420, 'acts' => 310],
    ['name' => 'Desert', 'tours' => 90, 'acts' => 45],
    ['name' => 'Backwaters', 'tours' => 110, 'acts' => 60],
    ['name' => 'Hill Station', 'tours' => 340, 'acts' => 210],
    ['name' => 'Waterfalls', 'tours' => 250, 'acts' => 150]
];

function fetchRealImage($url, $savePath) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DoniTripBot/1.0');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200 && $data) {
        if (strpos($data, '404') === false && strlen($data) > 1000) {
            file_put_contents($savePath, $data);
            return true;
        }
    }
    return false;
}

foreach ($newCats as $cat) {
    // Insert into DB first
    $db->query('INSERT INTO categories (name, tours_count, activities_count, image_url) VALUES (:name, :tours, :acts, :url)');
    $db->bind(':name', $cat['name']);
    $db->bind(':tours', $cat['tours']);
    $db->bind(':acts', $cat['acts']);
    $db->bind(':url', ''); // Temporary
    $db->execute();
    
    // Get last inserted ID
    $db->query('SELECT id FROM categories WHERE name = :name ORDER BY id DESC LIMIT 1');
    $db->bind(':name', $cat['name']);
    $id = $db->single()['id'];
    
    // Download image
    $filename = 'cat_real_' . $id . '.jpg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $success = fetchRealImage("https://picsum.photos/seed/cat_{$id}/600/400", $path);
    
    if ($success) {
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE categories SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $id);
        $db->execute();
        echo "Inserted Category '{$cat['name']}' successfully.\n";
    }
}
echo "Expansion Complete!\n";
