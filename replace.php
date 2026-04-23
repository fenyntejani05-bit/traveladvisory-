<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/app');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents($file);
        $original = $content;
        
        // Replace DoniTrip with TravelAdvisor
        $content = str_replace('DoniTrip', 'TravelAdvisor', $content);
        
        // Replace Rp < ?= number_format($var, ...) ? > with < ?= Formatter::currency($var) ? >
        $content = preg_replace(
            '/(?:Rp\s*|₹\s*|<\?=\s*\'Rp \'\s*\.\s*)?number_format\(\s*([^,]+)(?:,\s*[^)]+)?\)/', 
            'Formatter::currency($1)', 
            $content
        );
        
        // Replace remaining standalone "Rp " with "₹ "
        $content = str_replace('Rp ', '₹ ', $content);

        if ($content !== $original) {
            file_put_contents($file, $content);
            echo "Updated: " . $file . "\n";
        }
    }
}
echo "Replacement complete!\n";
