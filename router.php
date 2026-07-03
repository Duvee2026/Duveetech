<?php
// Simple router for development - redirects clean URLs to .html files

$request = $_SERVER['REQUEST_URI'];
$file = __DIR__ . $request;

// Remove query string if present
$path = parse_url($request, PHP_URL_PATH);

// If it's a file that exists, serve it
if (file_exists($file) && is_file($file)) {
    return false;
}

// Try to find .html file
if (file_exists(__DIR__ . $path . '.html')) {
    include __DIR__ . $path . '.html';
    exit;
}

// Try to find .php file
if (file_exists(__DIR__ . $path . '.php')) {
    include __DIR__ . $path . '.php';
    exit;
}

// Try index.html in directory
if (is_dir(__DIR__ . $path) && file_exists(__DIR__ . $path . '/index.html')) {
    include __DIR__ . $path . '/index.html';
    exit;
}

// 404
http_response_code(404);
echo '404 Not Found';
