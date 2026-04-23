<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
$imgDir = __DIR__ . '/public/img';
if (!is_dir($imgDir)) mkdir($imgDir, 0755, true);

function getWikipediaImageBySearch($term) {
    $apiUrl = 'https://en.wikipedia.org/w/api.php?action=query&generator=search&gsrsearch=' . urlencode($term) . '&gsrlimit=1&prop=pageimages&format=json&piprop=original';
    
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DoniTripBot/3.0 (info@donitrip.com)');
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
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64) Chrome/91.0');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200 && $data && strlen($data) > 2000) {
        file_put_contents($savePath, $data);
        return true;
    }
    return false;
}

function processTable($db, $imgDir, $table, $idCol, $nameCol, $prefix) {
    echo "Fixing $table...\n";
    $db->query("SELECT $idCol, $nameCol FROM $table");
    $items = $db->resultSet();
    foreach ($items as $item) {
        echo "- {$item[$nameCol]}... ";
        
        $term = $item[$nameCol];
        if (strpos($term, 'Rafting') !== false) $term = 'Rishikesh River';
        if (strpos($term, 'Houseboat') !== false) $term = 'Kerala backwaters';
        if (strpos($term, 'Camel Safari') !== false) $term = 'Jaisalmer camel';
        
        $wikiUrl = getWikipediaImageBySearch($term);
        
        if ($wikiUrl) {
            $filename = "{$prefix}_fix_{$item[$idCol]}.jpg";
            $path = $imgDir . '/' . $filename;
            
            if (downloadImageLocal($wikiUrl, $path)) {
                $newUrl = BASEURL . '/img/' . $filename;
                $db->query("UPDATE $table SET image_url = :url WHERE $idCol = :id");
                $db->bind(':url', $newUrl);
                $db->bind(':id', $item[$idCol]);
                $db->execute();
                echo "Success!\n";
            } else {
                echo "Failed Download.\n";
            }
        } else {
            echo "No Result.\n";
        }
        usleep(150000); // Respect API
    }
}

processTable($db, $imgDir, 'tours', 'id', 'title', 'tour');
processTable($db, $imgDir, 'hotels', 'id', 'name', 'hotel');
processTable($db, $imgDir, 'activities', 'id', 'title', 'act');
processTable($db, $imgDir, 'categories', 'id', 'name', 'cat');

echo "All images fixed!\n";
