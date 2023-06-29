<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Webrium\App;
use Webrium\Debug;
use Webrium\File;
use Webrium\Directory;
use Webrium\Route;

// init index path
App::root(__DIR__.'/..');


Debug::displayErrors(true);

// Load default directory structure
Directory::initDefaultStructure();

// Load config
File::source('config',['Config.php','DB.php']);

// load routes
Route::source(['Web.php']);
Route::run();