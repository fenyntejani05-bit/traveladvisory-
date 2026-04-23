<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

$db = new Database();

// 1. Alter schema
try {
    $db->query("ALTER TABLE tours ADD COLUMN description TEXT");
    $db->execute();
    echo "Added description to tours.\n";
} catch (Exception $e) {
    echo "tours description exists or error: " . $e->getMessage() . "\n";
}

try {
    $db->query("ALTER TABLE hotels ADD COLUMN description TEXT");
    $db->execute();
    echo "Added description to hotels.\n";
} catch (Exception $e) {
    echo "hotels description exists or error: " . $e->getMessage() . "\n";
}

// 2. Data for specific places
$tourDescriptions = [
    'Taj Mahal' => 'Experience the breathtaking beauty of the world\'s most famous monument of love in Agra. Famous for its pristine white marble Mughal architecture and stunning sunrise views, tourists can explore the complex, learn about Emperor Shah Jahan, and take iconic photographs.',
    'Goa Beaches' => 'Immerse yourself in the party capital of India. Goa is renowned for its sun-kissed beaches, Portuguese-influenced architecture, and vibrant nightlife. Tourists can experience thrilling water sports, beach shack dining with fresh seafood, and lively night markets.',
    'Jaipur Forts' => 'Step into the royal heritage of the Pink City. Jaipur is famous for its majestic hilltop forts like Amber Fort and intricately designed palaces. Tourists can experience elephant rides, explore historic courtyards, and shop for authentic Rajasthani handicrafts and jewelry.',
    'Kerala Backwaters' => 'Drift along serene palm-fringed canals on a traditional wooden houseboat in Alleppey. Kerala is globally famous for its tranquil backwaters and lush tropical scenery. Tourists will experience authentic Kerala cuisine prepared on board and witness local village life along the water.',
    'Varanasi Ghats' => 'Feel the spiritual pulse of India\'s holiest city along the sacred Ganges river. Famous for its centuries-old ghats and the mesmerizing evening Ganga Aarti ceremony. Tourists can experience spiritual boat rides at dawn, explore narrow ancient alleys, and witness deep-rooted cultural rituals.',
    'Leh Ladakh Highlights' => 'Embark on a high-altitude adventure in the land of high passes. Ladakh is famous for its stark, moon-like landscapes, crystal-clear Tibetan lakes (like Pangong Tso), and ancient Buddhist monasteries. Tourists can experience high-altitude treks, motorbike expeditions, and peaceful monastic retreats.',
    'Ranthambore Safari' => 'Get up close with wild Bengal tigers in their natural habitat. Ranthambore is famous as one of the best national parks in India for tiger spotting. Tourists can experience thrilling open-jeep safaris, explore the historic Ranthambore Fort within the park, and spot diverse wildlife.',
    'Rishikesh Adventure' => 'Dive into the "Yoga Capital of the World" which doubles as an adventure hub. Famous for its white-water rafting on the holy Ganges and spiritual ashrams. Tourists can experience extreme sports like bungee jumping, attend tranquil yoga retreats, and watch the peaceful evening Aarti along the riverbanks.',
    'Udaipur Palaces' => 'Discover the "City of Lakes" and its immense romantic charm. Udaipur is famous for its stunning Lake Palace situated in the middle of Lake Pichola and its grand City Palace. Tourists can experience romantic sunset boat cruises, heritage walks, and rooftop dining with regal views.',
    'Munnar Tea Gardens' => 'Escape into the misty rolling hills of the Western Ghats covered in emerald green tea plantations. Famous for its cool climate and exotic flora like the Neelakurinji. Tourists can experience guided tea estate tours, hiking to viewpoints, and breathing in the pristine mountain air.'
];

$hotelDescriptions = [
    'The Taj Mahal Palace' => 'An iconic luxury hotel in Mumbai offering breathtaking views of the Arabian Sea and the Gateway of India. Famous for its heritage architecture and world-class hospitality, guests can experience exquisite fine dining, a luxurious spa, and a deeply historic ambiance.',
    'The Oberoi Udaivilas' => 'Located on the banks of Lake Pichola in Udaipur, this resort mimics a traditional Rajasthani palace. Famous for its romantic setting and unparalleled luxury, tourists can experience private lakeside dining, serene pool cabanas, and regal architectural walks.',
    'ITC Grand Chola' => 'A monumental luxury hotel in Chennai inspired by the grandeur of the Chola dynasty. Famous for its massive palatial architecture and eco-friendly luxury. Guests can experience authentic South Indian fine dining, an extensive wellness spa, and royal hospitality.',
    'Rambagh Palace' => 'The former residence of the Maharaja of Jaipur, now a remarkably preserved heritage hotel. Famous for its opulent interiors and sprawling manicured gardens. Tourists can experience vintage car rides, peacock-filled courtyards, and dinner in a royal banquet hall.',
    'Umaid Bhawan Palace' => 'Set high above the desert capital of Jodhpur, this is one of the world\'s largest private residences partially converted into a hotel. Famous for its golden-yellow sandstone art deco architecture. Guests can experience a private museum tour, royal butler service, and sweeping views of the Blue City.',
    'The Leela Palace' => 'An ultra-luxury waterfront hotel set across the shores of Lake Pichola in Udaipur or the diplomatic enclave in Delhi. Famous for its grand crystal chandeliers and majestic art. Tourists can experience sunset boat rides, incredible local and international cuisines, and palatial comfort.',
    'Taj Lake Palace' => 'A floating marble palace in the middle of Lake Pichola in Udaipur. Globally famous for its romantic isolation and stunning 360-degree views of the city. Guests can experience arriving by private boat, exclusive heritage walks, and dinners set on floating pontoons.',
    'Kumarakom Lake Resort' => 'A luxurious heritage resort set on the banks of Vembanad Lake in Kerala. Famous for its reconstructed 16th-century traditional Kerala homesteads. Tourists can experience Ayurvedic spa treatments, private houseboat cruises, and authentic backwater dining.',
    'Wildflower Hall' => 'A breathtaking property located in Shimla, high in the Himalayas. Famous for being the former residence of Lord Kitchener and offering unmatched mountain views. Tourists can experience an outdoor heated infinity pool amidst snow-capped peaks, nature trails, and colonial elegance.',
    'Taj Falaknuma Palace' => 'Perched on a hill 2000 feet above Hyderabad, this stunning palace was built naturally in the shape of a scorpion. Famous for its incredibly opulent Venetian chandeliers and grand staircase. Guests can experience arriving in a horse-drawn carriage, bespoke dining, and a walk through royal history.'
];

$db->query("SELECT id, title FROM tours");
$tours = $db->resultSet();

foreach ($tours as $t) {
    if (isset($tourDescriptions[$t['title']])) {
        $desc = $tourDescriptions[$t['title']];
    } else {
        $desc = "Experience the unforgettable beauty and culture of " . $t['title'] . ". Famous for its breathtaking landscapes and immersive local traditions, tourists visiting here can experience authentic local cuisine, engaging sightseeing activities, and create memories that will last a lifetime.";
    }
    
    $updateParams = [':desc' => $desc, ':id' => $t['id']];
    $db->query("UPDATE tours SET description = :desc WHERE id = :id");
    foreach($updateParams as $key => $val) { $db->bind($key, $val); }
    $db->execute();
}
echo "Tours updated.\n";

$db->query("SELECT id, name FROM hotels");
$hotels = $db->resultSet();

foreach ($hotels as $h) {
    if (isset($hotelDescriptions[$h['name']])) {
        $desc = $hotelDescriptions[$h['name']];
    } else {
        $desc = "Stay at the incredible " . $h['name'] . ", famous for its top-tier hospitality and prime location. Guests can experience luxurious comfort, exquisite dining options, and close proximity to local tourist attractions.";
    }
    
    $updateParams = [':desc' => $desc, ':id' => $h['id']];
    $db->query("UPDATE hotels SET description = :desc WHERE id = :id");
    foreach($updateParams as $key => $val) { $db->bind($key, $val); }
    $db->execute();
}
echo "Hotels updated.\n";
