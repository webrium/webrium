<?php

use Foxdb\DB;
use Foxdb\Config;
use Webrium\App;


DB::addConnection('main', [
    'host'=>'localhost',
    'port'=>'3306',

    'database'=> App::env('database', 'test'),
    'username'=> App::env('username', 'root'),
    'password'=> App::env('password', '1234'),

    'charset'=>Config::UTF8MB4,
    'collation'=>Config::UTF8MB4_GENERAL_CI,
    'fetch'=>Config::FETCH_CLASS
]);