<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Fatal Vercel PHP Error</h1>";
    echo "<h3>Main Exception:</h3>";
    echo "<pre>" . (string)$e . "</pre>";
    
    $prev = $e->getPrevious();
    $count = 1;
    while ($prev) {
        echo "<h3>Previous Exception $count:</h3>";
        echo "<pre>" . (string)$prev . "</pre>";
        $prev = $prev->getPrevious();
        $count++;
    }
}
