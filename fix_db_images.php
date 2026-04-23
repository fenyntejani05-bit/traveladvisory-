<?php
require_once __DIR__ . '/app/config/config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
    // Some verified beautiful photos
    $verifiedImages = [
        'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=800&q=80', // Taj Mahal
        'https://images.unsplash.com/photo-1582610116397-edb318620f90?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1524443169398-9aa1ceab67d5?auto=format&fit=crop&w=800&q=80', // Fort
        'https://images.unsplash.com/photo-1506450372079-913aeb6d5257?auto=format&fit=crop&w=800&q=80', // Nature
        'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80', // Kerala Backwaters
        'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80', // Jaipur
        'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80', // Beach
    ];

    $tables = ['tours', 'activities', 'hotels', 'categories'];
    $fixedCount = 0;

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT id, image_url FROM $table");
        $rows = $stmt->fetchAll();
        
        foreach ($rows as $row) {
            $url = $row['image_url'];
            
            // Only check if it's an unsplash URL
            if (strpos($url, 'images.unsplash.com') !== false) {
                $headers = @get_headers($url);
                
                // If it's a 404
                if (!$headers || strpos($headers[0], '404') !== false || strpos($headers[0], '403') !== false) {
                    echo "Broken Image Found in $table (ID: {$row['id']}): $url\n";
                    
                    // Pick a random verified image
                    $newUrl = $verifiedImages[array_rand($verifiedImages)];
                    
                    // Update DB
                    $updateStmt = $pdo->prepare("UPDATE $table SET image_url = :new_url WHERE id = :id");
                    $updateStmt->execute(['new_url' => $newUrl, 'id' => $row['id']]);
                    
                    echo " -> Fixed with $newUrl\n";
                    $fixedCount++;
                }
            } else if (empty($url) || strlen($url) < 10) {
                 // Empty URLs get replaced too
                 echo "Empty Image Found in $table (ID: {$row['id']})\n";
                 $newUrl = $verifiedImages[array_rand($verifiedImages)];
                 $updateStmt = $pdo->prepare("UPDATE $table SET image_url = :new_url WHERE id = :id");
                 $updateStmt->execute(['new_url' => $newUrl, 'id' => $row['id']]);
                 echo " -> Fixed with $newUrl\n";
                 $fixedCount++;
            }
        }
    }
    
    echo "Done! Fixed $fixedCount images overall.\n";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
