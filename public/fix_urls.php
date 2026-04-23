<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';

$db = new Database();

$old_url = 'http://localhost/donitrip-travel-booking-main/donitrip-travel-booking-main/public';
$new_url = BASEURL;

$tables = ['tours', 'hotels', 'categories'];
foreach($tables as $table) {
    try {
        $db->query("UPDATE $table SET image_url = REPLACE(image_url, :old, :new)");
        $db->bind(':old', $old_url);
        $db->bind(':new', $new_url);
        $db->execute();
        echo "Updated $table\n";
    } catch(Exception $e) {
        echo "Error $table: " . $e->getMessage() . "\n";
    }
}
echo "Done";
