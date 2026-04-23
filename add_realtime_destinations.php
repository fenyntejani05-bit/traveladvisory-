<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$newCategories = [
    'International Cities', 'Islands', 'Historical Wonders', 'Nature & Parks'
];

$newTours = [
    // International Cities
    ['category' => 'International Cities', 'title' => 'Eiffel Tower Experience', 'location' => 'Paris, France', 'price' => 45000, 'rating' => 4.9],
    ['category' => 'International Cities', 'title' => 'Tokyo Metropolis Tour', 'location' => 'Tokyo, Japan', 'price' => 55000, 'rating' => 4.8],
    ['category' => 'International Cities', 'title' => 'New York City Highlights', 'location' => 'New York, USA', 'price' => 60000, 'rating' => 4.7],
    // Islands
    ['category' => 'Islands', 'title' => 'Maldives Luxury Getaway', 'location' => 'Maldives', 'price' => 85000, 'rating' => 4.9],
    ['category' => 'Islands', 'title' => 'Bali Tropical Retreat', 'location' => 'Bali, Indonesia', 'price' => 35000, 'rating' => 4.8],
    // Historical Wonders
    ['category' => 'Historical Wonders', 'title' => 'Colosseum & Ancient Rome', 'location' => 'Rome, Italy', 'price' => 42000, 'rating' => 4.9],
    ['category' => 'Historical Wonders', 'title' => 'Great Wall of China Trek', 'location' => 'Beijing, China', 'price' => 38000, 'rating' => 4.7],
    ['category' => 'Historical Wonders', 'title' => 'Machu Picchu Adventure', 'location' => 'Cusco, Peru', 'price' => 75000, 'rating' => 4.9],
    // Nature & Parks
    ['category' => 'Nature & Parks', 'title' => 'Banff National Park', 'location' => 'Alberta, Canada', 'price' => 50000, 'rating' => 4.8],
    ['category' => 'Nature & Parks', 'title' => 'Swiss Alps Journey', 'location' => 'Zurich, Switzerland', 'price' => 65000, 'rating' => 4.9],
];

function getWikipediaImageUrl($searchQuery) {
    // URL encode and format for Wikipedia API
    $search = trim(str_replace(['Experience', 'Highlights', 'Luxury Getaway', 'Tropical Retreat', 'Adventure', 'Trek', 'Journey', 'Metropolis Tour'], '', $searchQuery));
    $apiUrl = 'https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&redirects=1&titles=' . urlencode($search);
    
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DoniTripBot/2.0 (info@donitrip.com)');
    $response = curl_exec($ch);
    curl_close($ch);
    
    if (!$response) return false;
    
    $data = json_decode($response, true);
    if (!empty($data['query']['pages'])) {
        $firstPage = reset($data['query']['pages']);
        if (!empty($firstPage['original']['source'])) {
            return $firstPage['original']['source'];
        }
    }
    return false;
}

function downloadImageLocal($url, $savePath) {
    if (!$url) return false;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200 && $data && strlen($data) > 1000 && strpos($data, '404') === false) {
        file_put_contents($savePath, $data);
        return true;
    }
    return false;
}

echo "Beginning Real-Time Database Expansion...\n";
$imgDir = __DIR__ . '/public/img';
if (!is_dir($imgDir)) mkdir($imgDir, 0777, true);

// 1. Insert Categories
$categoryMap = [];
foreach ($newCategories as $catName) {
    $db->query("SELECT id FROM categories WHERE name = :name");
    $db->bind(':name', $catName);
    $existingCat = $db->single();
    
    if ($existingCat) {
        $cat_id = $existingCat['id'];
        echo "Category '$catName' already exists (ID: $cat_id).\n";
    } else {
        $db->query("INSERT INTO categories (name, tours_count, image_url) VALUES (:name, 0, '')");
        $db->bind(':name', $catName);
        $db->execute();
        
        $db->query("SELECT id FROM categories WHERE name = :name");
        $db->bind(':name', $catName);
        $cat_id = $db->single()['id'];
        
        echo "Inserted Category '$catName' (ID: $cat_id).\n";
        
        // Fetch Image for Category
        $wikiUrl = getWikipediaImageUrl($catName);
        $filename = "cat_rt_{$cat_id}_" . uniqid() . ".jpg";
        $path = $imgDir . '/' . $filename;
        
        if ($wikiUrl && downloadImageLocal($wikiUrl, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query("UPDATE categories SET image_url = :url WHERE id = :id");
            $db->bind(':url', $newUrl);
            $db->bind(':id', $cat_id);
            $db->execute();
            echo "  -> Image downloaded from Wikipedia.\n";
        } else {
            echo "  -> Failed to download image from Wikipedia.\n";
        }
    }
    $categoryMap[$catName] = $cat_id;
}

// 2. Insert Tours
foreach ($newTours as $tour) {
    $cat_id = $categoryMap[$tour['category']];
    
    $db->query("SELECT id FROM tours WHERE title = :title");
    $db->bind(':title', $tour['title']);
    if ($db->single()) {
        echo "Tour '{$tour['title']}' already exists. Skipping.\n";
        continue;
    }
    
    echo "Inserting Tour: {$tour['title']}... ";
    
    $db->query('INSERT INTO tours (category_id, title, location, duration, guests, price, rating, reviews, image_url) 
                VALUES (:cat_id, :title, :location, :duration, :guests, :price, :rating, :reviews, :url)');
    $db->bind(':cat_id', $cat_id);
    $db->bind(':title', $tour['title']);
    $db->bind(':location', $tour['location']);
    $db->bind(':duration', rand(3, 10) . ' Days');
    $db->bind(':guests', rand(2, 8) . ' Guests');
    $db->bind(':price', $tour['price']);
    $db->bind(':rating', $tour['rating']);
    $db->bind(':reviews', rand(50, 500));
    $db->bind(':url', '');
    $db->execute();
    
    $db->query('SELECT id FROM tours WHERE title = :title ORDER BY id DESC LIMIT 1');
    $db->bind(':title', $tour['title']);
    $tour_id = $db->single()['id'];
    
    // Update Category count
    $db->query("UPDATE categories SET tours_count = tours_count + 1 WHERE id = :id");
    $db->bind(':id', $cat_id);
    $db->execute();
    
    // Fetch Image
    $wikiUrl = getWikipediaImageUrl($tour['title']);
    $filename = "tour_rt_{$tour_id}_" . uniqid() . ".jpg";
    $path = $imgDir . '/' . $filename;
    
    if ($wikiUrl && downloadImageLocal($wikiUrl, $path)) {
        echo "[Wiki Download OK]... ";
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $tour_id);
        $db->execute();
    } else {
        echo "[Wiki Download Failed]... ";
    }
    
    echo "Done!\n";
    usleep(500000); // 0.5s pause
}

echo "Database Expansion Complete!\n";
