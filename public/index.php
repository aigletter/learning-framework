<?php

$routes = [
    'shop',
    'user',
    'order'
];

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if (!in_array($path, $routes)) {
    http_response_code(404);
    die();
}

echo 'Hello world';