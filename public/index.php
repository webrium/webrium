<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Webrium\App;
use Webrium\Route;
use Webrium\Directory;
use Webrium\Session;
use Webrium\Debug;
use Webrium\Kernel;
use Webrium\View\Engine;

App::initialize(__DIR__ . '/..');

Directory::initDefaultStructure();

Debug::enableErrorDisplay(env('APP_DEBUG', false));
Debug::enableErrorLogging(env('APP_LOG_ERRORS', true));

Engine::setViewDir(Directory::path('views'));
Engine::setCompiledDir(Directory::path('render_views'));
Engine::setStaticDir(Directory::path('static_views'));

Session::setSavePath(Directory::path('sessions'));

Debug::setErrorRenderer(function (array $data): string {
    return Engine::render('errors/debug', $data);
});

Kernel::source('config', ['DB.php']);

Route::source(['Web.php']);

App::run();