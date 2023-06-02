<?php

use Foxdb\DB;
use Foxdb\Config;
use Webrium\App;


DB::addConnection('main', [
    'host'=> env('host', 'localhost'),
    'port'=> env('port', 3306),

    'database'=> env('database', 'test'),
    'username'=> env('username', 'root'),
    'password'=> env('password', '1234'),

    'charset'=>Config::UTF8MB4,
    'collation'=>Config::UTF8MB4_UNICODE_CI,
    'fetch'=>Config::FETCH_CLASS
]);