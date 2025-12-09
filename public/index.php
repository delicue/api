<?php

use App\Database as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

exec('npx tailwindcss -i ./views/css/tailwindstyles.css -o ./public/css/main.css --minify');

session_start();

DB::config('sqlite:' . __DIR__ . '/../data/database.sqlite');

app([
    'rate-limiter',
    'routes',
    // 'middleware',
]);