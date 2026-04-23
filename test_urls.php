<?php
$urls = [
    'https://images.unsplash.com/photo-1548013146-72479768bada',
    'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944',
    'https://images.unsplash.com/photo-1599661046289-e31897846e41',
    'https://images.unsplash.com/photo-1544641886-f138e6df61c7',
    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
    'https://images.unsplash.com/photo-1582610116397-edb318620f90',
    'https://images.unsplash.com/photo-1524443169398-9aa1ceab67d5',
    'https://images.unsplash.com/photo-1506450372079-913aeb6d5257',
    // also the ones in auth modal maybe?
    'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800'
];
foreach($urls as $u) {
    echo $u . "\n";
    $h = @get_headers($u);
    echo " -> " . ($h ? $h[0] : 'FAILED') . "\n";
}
?>
