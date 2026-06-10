<?php

use Foxdb\DB;
use Foxdb\Config;


DB::addConnection([
    'driver' => Config::MYSQL,
    'fetch' => Config::FETCH_OBJ,
    'throw_exceptions' => true,
    'host' => env('host', 'localhost'),
    'port' => env('port', 3306),
    'database' => env('database', 'test'),
    'username' => env('username', 'root'),
    'password' => env('password', '1234'),
]);