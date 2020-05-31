<?php

require_once __DIR__ . '/../vendor/autoload.php';

use webrium\core\App;
use webrium\core\Debug;
use webrium\core\File;
use webrium\core\Directory;

// init index path
App::root(__DIR__.'/..');


Debug::displayErrors(true);

// load default directory structure
Directory::initDefaultStructure();

// load config
File::source('config',['db.php']);

// load routes
File::source('routes',['web.php']);
