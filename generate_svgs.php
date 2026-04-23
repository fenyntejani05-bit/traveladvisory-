<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

function generateSVG($title, $width=800, $height=600) {
    // Generate a random gradient color based on the title string
    $hash = md5($title);
    $color1 = substr($hash, 0, 6);
    $color2 = substr($hash, 6, 6);
    
    // Convert to readable text (shorten if too long)
    if (strlen($title) > 20) {
        $title = substr($title, 0, 20) . '...';
    }
    // Clean text for SVG
    $title = htmlspecialchars($title, ENT_XML1);

    return "<svg width=\"{$width}\" height=\"{$height}\" xmlns=\"http://www.w3.org/2000/svg\">
        <defs>
            <linearGradient id=\"grad_{$color1}\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"100%\">
                <stop offset=\"0%\" style=\"stop-color:#{$color1};stop-opacity:1\" />
                <stop offset=\"100%\" style=\"stop-color:#{$color2};stop-opacity:1\" />
            </linearGradient>
        </defs>
        <rect width=\"100%\" height=\"100%\" fill=\"url(#grad_{$color1})\" />
        <text x=\"50%\" y=\"50%\" font-family=\"'Plus Jakarta Sans', sans-serif\" font-size=\"36\" font-weight=\"bold\" fill=\"#ffffff\" text-anchor=\"middle\" dominant-baseline=\"middle\" style=\"text-shadow: 2px 2px 4px rgba(0,0,0,0.4);\">
            {$title}
        </text>
    </svg>";
}

echo "Generating SVGs...\n";

// 1. Tours
$db->query('SELECT id, title FROM tours');
$tours = $db->resultSet();
foreach ($tours as $t) {
    $filename = 'tour_' . $t['id'] . '_' . uniqid() . '.svg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $svgContent = generateSVG($t['title']);
    file_put_contents($path, $svgContent);
    
    $newUrl = BASEURL . '/img/' . $filename;
    $db->query('UPDATE tours SET image_url = :url WHERE id = :id');
    $db->bind(':url', $newUrl);
    $db->bind(':id', $t['id']);
    $db->execute();
}

// 2. Hotels
$db->query('SELECT id, name FROM hotels');
$hotels = $db->resultSet();
foreach ($hotels as $h) {
    $filename = 'hotel_' . $h['id'] . '_' . uniqid() . '.svg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $svgContent = generateSVG($h['name']);
    file_put_contents($path, $svgContent);
    
    $newUrl = BASEURL . '/img/' . $filename;
    $db->query('UPDATE hotels SET image_url = :url WHERE id = :id');
    $db->bind(':url', $newUrl);
    $db->bind(':id', $h['id']);
    $db->execute();
}

// 3. Categories
$db->query('SELECT id, name FROM categories');
$cats = $db->resultSet();
foreach ($cats as $c) {
    $filename = 'cat_' . $c['id'] . '_' . uniqid() . '.svg';
    $path = __DIR__ . '/public/img/' . $filename;
    
    $svgContent = generateSVG($c['name']);
    file_put_contents($path, $svgContent);
    
    $newUrl = BASEURL . '/img/' . $filename;
    $db->query('UPDATE categories SET image_url = :url WHERE id = :id');
    $db->bind(':url', $newUrl);
    $db->bind(':id', $c['id']);
    $db->execute();
}

echo "SVG Migration Complete!\n";
