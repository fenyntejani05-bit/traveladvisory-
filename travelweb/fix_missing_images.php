<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$imgMap = [
    // Categories
    'International Cities' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=800&q=80', // Paris
    'Islands' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80', // Maldives
    'Historical Wonders' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?auto=format&fit=crop&w=800&q=80', // Colosseum
    'Nature & Parks' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=800&q=80', // Mountains
    // Tours
    'Maldives Luxury Getaway' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
    'Bali Tropical Retreat' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80',
    'Colosseum & Ancient Rome' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?auto=format&fit=crop&w=800&q=80',
    'Machu Picchu Adventure' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=800&q=80',
    'Swiss Alps Journey' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=800&q=80',
];

$imgDir = __DIR__ . '/public/img';

function downloadImageLocal($url, $savePath) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200 && $data && strlen($data) > 1000) {
        file_put_contents($savePath, $data);
        return true;
    }
    return false;
}

echo "Fixing Missing Images...\n";

// Fix Categories
foreach (['International Cities', 'Islands', 'Historical Wonders', 'Nature & Parks'] as $cat) {
    $db->query("SELECT id FROM categories WHERE name = :name");
    $db->bind(':name', $cat);
    $res = $db->single();
    if ($res) {
        $id = $res['id'];
        $url = $imgMap[$cat];
        $filename = "cat_rt_fixed_{$id}.jpg";
        $path = $imgDir . '/' . $filename;
        if (downloadImageLocal($url, $path)) {
            $db->query("UPDATE categories SET image_url = :url WHERE id = :id");
            $db->bind(':url', BASEURL . '/img/' . $filename);
            $db->bind(':id', $id);
            $db->execute();
            echo "Fixed Category: $cat\n";
        }
    }
}

// Fix Tours
$toursToFix = ['Maldives Luxury Getaway', 'Bali Tropical Retreat', 'Colosseum & Ancient Rome', 'Machu Picchu Adventure', 'Swiss Alps Journey'];
foreach ($toursToFix as $title) {
    $db->query("SELECT id FROM tours WHERE title = :title");
    $db->bind(':title', $title);
    $res = $db->single();
    if ($res) {
        $id = $res['id'];
        $url = $imgMap[$title];
        $filename = "tour_rt_fixed_{$id}.jpg";
        $path = $imgDir . '/' . $filename;
        if (downloadImageLocal($url, $path)) {
            $db->query("UPDATE tours SET image_url = :url WHERE id = :id");
            $db->bind(':url', BASEURL . '/img/' . $filename);
            $db->bind(':id', $id);
            $db->execute();
            echo "Fixed Tour: $title\n";
        }
    }
}

echo "Done fixing images.\n";
