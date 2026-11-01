<?php

// Prepare /tmp directory structure for Laravel on Vercel serverless environment
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Never allow Vite dev hot file to be served in serverless production
if (file_exists(__DIR__ . '/../public/hot')) {
    @unlink(__DIR__ . '/../public/hot');
}

// Copy SQLite database to writable /tmp if needed
if (!file_exists('/tmp/database.sqlite') && file_exists(__DIR__ . '/../database/database.sqlite')) {
    @copy(__DIR__ . '/../database/database.sqlite', '/tmp/database.sqlite');
}

// Forward request to Laravel public/index.php
require __DIR__ . '/../public/index.php';

