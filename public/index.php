<?php

use Delique\Api\Database as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

session_start();

app('rate-limiter');

DB::config('sqlite:' . __DIR__ . '/../data/database.sqlite');

app('routes');