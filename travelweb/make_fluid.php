<?php
$files = [
    'app/views/home.php',
    'app/views/layouts/header.php',
    'app/views/layouts/footer.php',
    'app/views/activities/index.php',
    'app/views/activities/detail.php',
    'app/views/category/index.php',
    'app/views/category/show.php',
    'app/views/tours/index.php',
    'app/views/tours/detail.php',
    'app/views/hotels/index.php',
    'app/views/hotels/detail.php',
    'app/views/tours/plan.php',
    'app/views/about/index.php'
];

foreach ($files as $f) {
    if (file_exists($f)) {
        $c = file_get_contents($f);
        $c = str_replace('class="container"', 'class="container-fluid px-4 px-lg-5"', $c);
        $c = str_replace('class="container search-box-container"', 'class="container-fluid px-4 px-lg-5 search-box-container"', $c);
        $c = str_replace('class="container mt-5"', 'class="container-fluid px-4 px-lg-5 mt-5"', $c);
        $c = str_replace('class="container position-relative"', 'class="container-fluid px-4 px-lg-5 position-relative"', $c);
        file_put_contents($f, $c);
        echo "Updated $f\n";
    }
}
?>
