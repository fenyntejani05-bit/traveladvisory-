<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

// Ensure public directory is available
$imgDir = __DIR__ . '/public/img';
if (!is_dir($imgDir)) {
    mkdir($imgDir, 0755, true);
}

function getWikipediaImageUrl($title) {
    // Wikipedia API URL to fetch original image for a page
    // Using a broad search and resolving redirects
    $apiUrl = 'https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&redirects=1&titles=' . urlencode($title);
    
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
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DoniTripBot/1.0 (info@donitrip.com)');
    
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

echo "Starting Wikimedia Commons High-Res Fetcher...\n";

// 1. Fetch Images for Tours
$db->query('SELECT id, title FROM tours');
$tours = $db->resultSet();
foreach ($tours as $t) {
    echo "Processing Tour: {$t['title']}... ";
    
    $wikiUrl = getWikipediaImageUrl($t['title']);
    
    if (!$wikiUrl) {
        // Fallback: search wikipedia broadly if direct title fails (e.g. drop specific words)
        $shortTitle = trim(str_replace(['Highlights', 'Tour', 'Retreat', 'Safari', 'Expedition', 'Getaway'], '', $t['title']));
        $wikiUrl = getWikipediaImageUrl($shortTitle);
    }
    
    if ($wikiUrl) {
        $filename = 'tour_wiki_' . $t['id'] . '.jpg';
        $path = $imgDir . '/' . $filename;
        
        if (downloadImageLocal($wikiUrl, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
            $db->bind(':url', $newUrl);
            $db->bind(':id', $t['id']);
            $db->execute();
            echo "Success!\n";
        } else {
            echo "Failed to Download from $wikiUrl\n";
        }
    } else {
        echo "No Image Found on Wikipedia.\n";
    }
    usleep(500000); // 0.5s delay to strictly respect API limits
}

// 2. Fetch Images for Hotels
$db->query('SELECT id, name FROM hotels');
$hotels = $db->resultSet();
foreach ($hotels as $h) {
    echo "Processing Hotel: {$h['name']}... ";
    
    $wikiUrl = getWikipediaImageUrl($h['name']);
    
    if ($wikiUrl) {
        $filename = 'hotel_wiki_' . $h['id'] . '.jpg';
        $path = $imgDir . '/' . $filename;
        
        if (downloadImageLocal($wikiUrl, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query('UPDATE hotels SET image_url = :url WHERE id = :id');
            $db->bind(':url', $newUrl);
            $db->bind(':id', $h['id']);
            $db->execute();
            echo "Success!\n";
        } else {
            echo "Failed to Download from $wikiUrl\n";
            fallbackHotelPhoto($h['id'], $imgDir, $db);
        }
    } else {
        echo "No Image Found on Wikipedia.\n";
        fallbackHotelPhoto($h['id'], $imgDir, $db);
    }
    usleep(500000); // Respect API limits
}

function fallbackHotelPhoto($id, $imgDir, $db) {
    echo "Using Fallback for Hotel $id... ";
    $filename = 'hotel_wiki_fb_' . $id . '.jpg';
    $path = $imgDir . '/' . $filename;
    if (downloadImageLocal("https://picsum.photos/seed/hotel_india_{$id}/800/600", $path)) {
        $db->query('UPDATE hotels SET image_url = :url WHERE id = :id');
        $db->bind(':url', BASEURL . '/img/' . $filename);
        $db->bind(':id', $id);
        $db->execute();
        echo "Fallback Success!\n";
    }
}

// 3. Fetch Images for Activities
$db->query('SELECT id, title FROM activities');
$activities = $db->resultSet();
foreach ($activities as $a) {
    echo "Processing Activity: {$a['title']}... ";
    
    $wikiUrl = getWikipediaImageUrl($a['title']);
    
    if (!$wikiUrl) {
        $shortTitle = trim(str_replace([' Cruise', ' Safari', ' Trekking', ' Diving'], '', $a['title']));
        $wikiUrl = getWikipediaImageUrl($shortTitle);
    }
    
    if ($wikiUrl) {
        $filename = 'activity_wiki_' . $a['id'] . '.jpg';
        $path = $imgDir . '/' . $filename;
        
        if (downloadImageLocal($wikiUrl, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query('UPDATE activities SET image_url = :url WHERE id = :id');
            $db->bind(':url', $newUrl);
            $db->bind(':id', $a['id']);
            $db->execute();
            echo "Success!\n";
        } else {
            echo "Failed to Download from $wikiUrl\n";
        }
    } else {
        echo "No Image Found on Wikipedia.\n";
    }
    usleep(500000); 
}

// 4. Fetch Images for Categories
$db->query('SELECT id, name FROM categories');
$categories = $db->resultSet();
foreach ($categories as $c) {
    echo "Processing Category: {$c['name']}... ";
    
    $wikiUrl = getWikipediaImageUrl($c['name']);
    
    if ($wikiUrl) {
        $filename = 'category_wiki_' . $c['id'] . '.jpg';
        $path = $imgDir . '/' . $filename;
        
        if (downloadImageLocal($wikiUrl, $path)) {
            $newUrl = BASEURL . '/img/' . $filename;
            $db->query('UPDATE categories SET image_url = :url WHERE id = :id');
            $db->bind(':url', $newUrl);
            $db->bind(':id', $c['id']);
            $db->execute();
            echo "Success!\n";
        } else {
            echo "Failed to Download from $wikiUrl\n";
        }
    } else {
        echo "No Image Found on Wikipedia.\n";
    }
    usleep(500000); 
}

echo "Image Migration Completed!\n";
