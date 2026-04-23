<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$internationalCategories = ['International Cities', 'Islands', 'Historical Wonders', 'Nature & Parks'];
$internationalTours = ['Eiffel Tower Experience', 'Tokyo Metropolis Tour', 'New York City Highlights', 'Maldives Luxury Getaway', 'Bali Tropical Retreat', 'Colosseum & Ancient Rome', 'Great Wall of China Trek', 'Machu Picchu Adventure', 'Banff National Park', 'Swiss Alps Journey'];

echo "Cleaning up International Destinations...\n";
foreach ($internationalTours as $tourTitle) {
    $db->query("DELETE FROM tours WHERE title = :title");
    $db->bind(':title', $tourTitle);
    $db->execute();
}
foreach ($internationalCategories as $catName) {
    $db->query("DELETE FROM categories WHERE name = :name");
    $db->bind(':name', $catName);
    $db->execute();
}

$newCategories = [
    'Himalayan Treks', 'Rajasthan Royal', 'Kerala Escapes', 'Goa Beaches', 'Golden Triangle'
];

$newTours = [
    ['category' => 'Himalayan Treks', 'title' => 'Manali Snow Adventure', 'location' => 'Himachal Pradesh, India', 'price' => 15000, 'rating' => 4.8],
    ['category' => 'Himalayan Treks', 'title' => 'Rishikesh River Rafting', 'location' => 'Uttarakhand, India', 'price' => 8000, 'rating' => 4.9],
    ['category' => 'Rajasthan Royal', 'title' => 'Jaipur Royal Heritage', 'location' => 'Rajasthan, India', 'price' => 12000, 'rating' => 4.7],
    ['category' => 'Rajasthan Royal', 'title' => 'Udaipur City of Lakes', 'location' => 'Rajasthan, India', 'price' => 18000, 'rating' => 4.9],
    ['category' => 'Kerala Escapes', 'title' => 'Munnar Tea Gardens', 'location' => 'Kerala, India', 'price' => 14000, 'rating' => 4.8],
    ['category' => 'Goa Beaches', 'title' => 'Goa Party & Cruise', 'location' => 'Goa, India', 'price' => 22000, 'rating' => 4.8],
    ['category' => 'Golden Triangle', 'title' => 'Agra Taj Mahal Sunrise', 'location' => 'Uttar Pradesh, India', 'price' => 10000, 'rating' => 4.9],
    ['category' => 'Golden Triangle', 'title' => 'Delhi Historical Walk', 'location' => 'New Delhi, India', 'price' => 5000, 'rating' => 4.6],
];

$imgMap = [
    'Himalayan Treks' => 'https://images.unsplash.com/photo-1544989164-32a24558eeb0?auto=format&fit=crop&w=800&q=80',
    'Rajasthan Royal' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80',
    'Kerala Escapes' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80',
    'Goa Beaches' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=800&q=80',
    'Golden Triangle' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80',
    
    'Manali Snow Adventure' => 'https://images.unsplash.com/photo-1623194723910-c0817ddaa8cb?auto=format&fit=crop&w=800&q=80',
    'Rishikesh River Rafting' => 'https://images.unsplash.com/photo-1589136777351-fdc9c9cb166f?auto=format&fit=crop&w=800&q=80',
    'Jaipur Royal Heritage' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80',
    'Udaipur City of Lakes' => 'https://images.unsplash.com/photo-1615836245337-f839dcc8a08e?auto=format&fit=crop&w=800&q=80',
    'Munnar Tea Gardens' => 'https://images.unsplash.com/photo-1593693397690-362cb9666fc2?auto=format&fit=crop&w=800&q=80',
    'Goa Party & Cruise' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=800&q=80',
    'Agra Taj Mahal Sunrise' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80',
    'Delhi Historical Walk' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=800&q=80',
];

$imgDir = __DIR__ . '/public/img';

function downloadImageLocal($url, $savePath) {
    if (!$url) return false;
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

echo "Beginning Indian Destinations Expansion...\n";

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
        
        $url = $imgMap[$catName];
        $filename = "cat_india_{$cat_id}_" . uniqid() . ".jpg";
        $path = $imgDir . '/' . $filename;
        
        if (downloadImageLocal($url, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query("UPDATE categories SET image_url = :url WHERE id = :id");
            $db->bind(':url', $newUrl);
            $db->bind(':id', $cat_id);
            $db->execute();
            echo "  -> Image downloaded.\n";
        }
    }
    $categoryMap[$catName] = $cat_id;
}

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
    $db->bind(':duration', rand(3, 8) . ' Days');
    $db->bind(':guests', rand(2, 6) . ' Guests');
    $db->bind(':price', $tour['price']);
    $db->bind(':rating', $tour['rating']);
    $db->bind(':reviews', rand(50, 500));
    $db->bind(':url', '');
    $db->execute();
    
    $db->query('SELECT id FROM tours WHERE title = :title ORDER BY id DESC LIMIT 1');
    $db->bind(':title', $tour['title']);
    $tour_id = $db->single()['id'];
    
    $db->query("UPDATE categories SET tours_count = tours_count + 1 WHERE id = :id");
    $db->bind(':id', $cat_id);
    $db->execute();
    
    $url = $imgMap[$tour['title']];
    $filename = "tour_india_{$tour_id}_" . uniqid() . ".jpg";
    $path = $imgDir . '/' . $filename;
    
    if (downloadImageLocal($url, $path)) {
        echo "[Image OK]... ";
        $newUrl = BASEURL . '/img/' . $filename;
        $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
        $db->bind(':url', $newUrl);
        $db->bind(':id', $tour_id);
        $db->execute();
    }
    
    echo "Done!\n";
}

echo "Database Expansion Complete!\n";
