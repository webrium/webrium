<?php

use Foxdb\DB;
use Foxdb\Config;


DB::addConnection([
    'driver' => Config::MYSQL,
    'fetch' => Config::FETCH_OBJ,
    'throw_exceptions' => true,
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', 3306),
    'database' => env('DB_DATABASE', 'test'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', '1234'),
]);