<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Webrium\App;
use Webrium\Debug;
use Webrium\File;
use Webrium\Directory;
use Webrium\Route;
use Zog\Zog;

/**
 * -------------------------------------------------------------
 *  Application Bootstrap
 * -------------------------------------------------------------
 *  Sets application paths, loads configuration files,
 *  initializes directory structure, and registers routes.
 */

// Enable error display for debugging
Debug::enableErrorDisplay(true);

// Disable error logging to file
Debug::enableErrorLogging(false);

// Set application root path
App::initialize(__DIR__.'/..');

// Initialize default directory structure (storage, logs, cache, etc.)
Directory::initDefaultStructure();


// Load configuration files
File::source('config', ['DB.php', 'Config.php']);


// Load route definitions
Route::source(['Web.php']);


// Run the routing engine
App::run();
