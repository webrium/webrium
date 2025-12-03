<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Webrium\App;
use Webrium\Debug;
use Webrium\File;
use Webrium\Directory;
use Webrium\Route;

/**
 * -------------------------------------------------------------
 *  Application Bootstrap
 * -------------------------------------------------------------
 *  Sets application paths, loads configuration files,
 *  initializes directory structure, and registers routes.
 */

// Set the application root directory
App::root(__DIR__ . '/..');

// Enable error display (development mode)
Debug::displayErrors(true);

// Initialize default directory structure (storage, logs, cache, etc.)
Directory::initDefaultStructure();

// Load configuration files
File::source('config', ['DB.php', 'Config.php']);

// Load route definitions
Route::source(['Web.php']);

// Run the routing engine
Route::run();
