<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$newTours = [
    // Category 1: Beach
    ['cat_id' => 1, 'title' => 'Radhanagar Beach Resort', 'location' => 'Andaman & Nicobar Islands', 'price' => 15000, 'rating' => 4.9],
    ['cat_id' => 1, 'title' => 'Varkala Cliff Beach', 'location' => 'Kerala', 'price' => 8000, 'rating' => 4.7],
    // Category 2: Temples
    ['cat_id' => 2, 'title' => 'Golden Temple Amritsar', 'location' => 'Punjab', 'price' => 6000, 'rating' => 4.9],
    ['cat_id' => 2, 'title' => 'Meenakshi Amman Temple', 'location' => 'Tamil Nadu', 'price' => 4500, 'rating' => 4.8],
    ['cat_id' => 2, 'title' => 'Konark Sun Temple', 'location' => 'Odisha', 'price' => 5000, 'rating' => 4.7],
    // Category 3: Yacht
    ['cat_id' => 3, 'title' => 'Goa Luxury Catamaran', 'location' => 'Goa', 'price' => 25000, 'rating' => 4.8],
    ['cat_id' => 3, 'title' => 'Mumbai Harbour Cruise', 'location' => 'Maharashtra', 'price' => 18000, 'rating' => 4.6],
    // Category 4: Valley
    ['cat_id' => 4, 'title' => 'Spiti Valley Expedition', 'location' => 'Himachal Pradesh', 'price' => 22000, 'rating' => 4.9],
    ['cat_id' => 4, 'title' => 'Nubra Valley Safari', 'location' => 'Ladakh', 'price' => 19000, 'rating' => 4.8],
    // Category 5: Mountain
    ['cat_id' => 5, 'title' => 'Nanda Devi Trek', 'location' => 'Uttarakhand', 'price' => 12000, 'rating' => 4.8],
    ['cat_id' => 5, 'title' => 'Kanchenjunga Base Camp', 'location' => 'Sikkim', 'price' => 35000, 'rating' => 4.9],
    // Category 6: Wildlife
    ['cat_id' => 6, 'title' => 'Jim Corbett Safari Retreat', 'location' => 'Uttarakhand', 'price' => 14000, 'rating' => 4.8],
    ['cat_id' => 6, 'title' => 'Kanha Tiger Expedition', 'location' => 'Madhya Pradesh', 'price' => 16000, 'rating' => 4.9],
    ['cat_id' => 6, 'title' => 'Kaziranga Rhino Safari', 'location' => 'Assam', 'price' => 13500, 'rating' => 4.7],
    // Category 7: Heritage
    ['cat_id' => 7, 'title' => 'Hawa Mahal Palace', 'location' => 'Rajasthan', 'price' => 8000, 'rating' => 4.8],
    ['cat_id' => 7, 'title' => 'Qutub Minar Complex', 'location' => 'New Delhi', 'price' => 5000, 'rating' => 4.6],
    // Category 8: Desert
    ['cat_id' => 8, 'title' => 'Thar Desert Night Safari', 'location' => 'Rajasthan', 'price' => 11000, 'rating' => 4.8],
    ['cat_id' => 8, 'title' => 'Rann of Kutch Festival', 'location' => 'Gujarat', 'price' => 14500, 'rating' => 4.9],
    // Category 9: Backwaters
    ['cat_id' => 9, 'title' => 'Alleppey Premium Houseboats', 'location' => 'Kerala', 'price' => 18500, 'rating' => 4.8],
    ['cat_id' => 9, 'title' => 'Kumarakom Serenity', 'location' => 'Kerala', 'price' => 16000, 'rating' => 4.7],
    // Category 10: Hill Station
    ['cat_id' => 10, 'title' => 'Munnar Tea Plantations', 'location' => 'Kerala', 'price' => 9500, 'rating' => 4.8],
    ['cat_id' => 10, 'title' => 'Darjeeling Queen of Hills', 'location' => 'West Bengal', 'price' => 10500, 'rating' => 4.7],
    // Category 11: Waterfalls
    ['cat_id' => 11, 'title' => 'Jog Falls Adventure', 'location' => 'Karnataka', 'price' => 7000, 'rating' => 4.6],
    ['cat_id' => 11, 'title' => 'Athirappilly Cascade', 'location' => 'Kerala', 'price' => 8500, 'rating' => 4.8],
];

// Wikipedia Fetcher Algorithm
function getWikipediaImageUrl($title) {
    // Drop descriptive words to increase match probability
    $search = trim(str_replace(['Resort', 'Expedition', 'Safari', 'Retreat', 'Premium Houseboats', 'Queen of Hills', 'Adventure', 'Cascade', 'Serenity', 'Festival', 'Complex'], '', $title));
    
    $apiUrl = 'https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&redirects=1&titles=' . urlencode($search);
    
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DoniTripBot/1.0 (info@donitrip.com)');
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

echo "Beginning Mass Database Expansion & Image Sourcing...\n";
$imgDir = __DIR__ . '/public/img';

foreach ($newTours as $tour) {
    echo "Inserting: {$tour['title']}... ";
    
    // 1. Insert DB Entry with temporary blank image
    $db->query('INSERT INTO tours (category_id, title, location, duration, guests, price, rating, reviews, image_url) 
                VALUES (:cat_id, :title, :location, :duration, :guests, :price, :rating, :reviews, :url)');
    $db->bind(':cat_id', $tour['cat_id']);
    $db->bind(':title', $tour['title']);
    $db->bind(':location', $tour['location']);
    $db->bind(':duration', rand(3, 7) . ' Days');
    $db->bind(':guests', rand(2, 6) . ' Guests');
    $db->bind(':price', $tour['price']);
    $db->bind(':rating', $tour['rating']);
    $db->bind(':reviews', rand(120, 950));
    $db->bind(':url', '');
    $db->execute();
    
    // Get newly created Tour ID
    $db->query('SELECT id FROM tours WHERE title = :title ORDER BY id DESC LIMIT 1');
    $db->bind(':title', $tour['title']);
    $id = $db->single()['id'];
    
    // 2. Fetch Image
    $wikiUrl = getWikipediaImageUrl($tour['title']);
    $filename = "tour_real_{$id}.jpg";
    $path = $imgDir . '/' . $filename;
    
    // Safe execution: If Wiki fails, immediately utilize picsum fallback tied to its Tour ID
    if ($wikiUrl && downloadImageLocal($wikiUrl, $path)) {
        echo "[Wiki Download OK]... ";
    } else {
        echo "[Fallback Picsum Download]... ";
        downloadImageLocal("https://picsum.photos/seed/newtour_{$id}/800/600", $path);
    }
    
    // 3. Update specific URL
    $newUrl = BASEURL . '/img/' . $filename;
    $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
    $db->bind(':url', $newUrl);
    $db->bind(':id', $id);
    $db->execute();
    
    echo "Done!\n";
    usleep(500000); // 0.5s pause to respect API bounds
}

echo "Mass Database Expansion Complete!\n";
