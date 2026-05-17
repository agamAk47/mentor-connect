<?php
/**
 * Vercel Serverless Entry Point for Laravel
 * 
 * Handles all Vercel-specific filesystem constraints before Laravel boots:
 * 1. Creates writable /tmp directories for storage, cache, views, logs
 * 2. Copies pre-built bootstrap cache files to writable location
 * 3. Catches and displays any fatal errors
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // ── Step 1: Create ALL writable directories Laravel needs ──
    $directories = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
        '/tmp/bootstrap-cache/cache',
    ];
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    // ── Step 2: Copy bootstrap cache files to writable /tmp ──
    $sourceCache = __DIR__ . '/../bootstrap/cache';
    $tmpCache = '/tmp/bootstrap-cache/cache';
    if (is_dir($sourceCache)) {
        foreach (glob($sourceCache . '/*.php') as $file) {
            $dest = $tmpCache . '/' . basename($file);
            if (!file_exists($dest)) {
                copy($file, $dest);
            }
        }
    }

    // ── Step 3: Boot Laravel ──
    require __DIR__ . '/../public/index.php';

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Application Error</h1>";
    echo "<pre>" . htmlspecialchars((string)$e) . "</pre>";
    $prev = $e->getPrevious();
    while ($prev) {
        echo "<h3>Caused by:</h3>";
        echo "<pre>" . htmlspecialchars((string)$prev) . "</pre>";
        $prev = $prev->getPrevious();
    }
}
