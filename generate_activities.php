<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';
$db = new Database();

$activities = [
    ['title' => 'Scuba Diving at Havelock', 'location' => 'Andaman Islands', 'description' => 'Explore the vibrant coral reefs.', 'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=600&q=80'],
    ['title' => 'Hot Air Balloon Safari', 'location' => 'Jaipur', 'description' => 'Float over the pink city at sunrise.', 'image_url' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=600&q=80'],
    ['title' => 'Paragliding over Solang', 'location' => 'Manali', 'description' => 'Experience the thrill of flying in the Himalayas.', 'image_url' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=600&q=80'],
    ['title' => 'Camel Safari', 'location' => 'Jaisalmer', 'description' => 'Ride through the Thar desert under the stars.', 'image_url' => 'https://images.unsplash.com/photo-1544641886-f138e6df61c7?auto=format&fit=crop&w=600&q=80'],
    ['title' => 'River Rafting', 'location' => 'Rishikesh', 'description' => 'Tame the wild rapids of the holy Ganges.', 'image_url' => 'https://images.unsplash.com/photo-1506450372079-913aeb6d5257?auto=format&fit=crop&w=600&q=80'],
    ['title' => 'Tea Tasting Tour', 'location' => 'Darjeeling', 'description' => 'Sip the finest teas right at the lush estates.', 'image_url' => 'https://images.unsplash.com/photo-1514222134-b57cbb8ce073?auto=format&fit=crop&w=600&q=80']
];

foreach ($activities as $act) {
    $db->query("INSERT INTO activities (title, location, description, image_url) VALUES (:t, :l, :d, :i)");
    $db->bind(':t', $act['title']);
    $db->bind(':l', $act['location']);
    $db->bind(':d', $act['description']);
    $db->bind(':i', $act['image_url']);
    $db->execute();
}
echo "Added more robust activities.";
