<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // On Vercel, the filesystem is read-only except /tmp
    // Laravel needs bootstrap/cache to be writable BEFORE it boots
    $bootstrapCache = __DIR__ . '/../bootstrap/cache';
    if (!is_writable($bootstrapCache)) {
        $tmpCache = '/tmp/bootstrap-cache';
        if (!is_dir($tmpCache)) {
            mkdir($tmpCache, 0777, true);
        }
        // Copy existing cache files to tmp
        foreach (glob($bootstrapCache . '/*') as $file) {
            if (is_file($file)) {
                copy($file, $tmpCache . '/' . basename($file));
            }
        }
        // Create packages.php and services.php if they don't exist
        if (!file_exists($tmpCache . '/packages.php')) {
            file_put_contents($tmpCache . '/packages.php', '<?php return [];');
        }
        if (!file_exists($tmpCache . '/services.php')) {
            file_put_contents($tmpCache . '/services.php', '<?php return [];');
        }
    }
    
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
