<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Webrium\App;
use Webrium\Route;
use Webrium\Directory;
use Webrium\Session;
use Webrium\Debug;
use Webrium\Kernel;
use Webrium\Vite;
use Webrium\View\Engine;


/*
|--------------------------------------------------------------------------
| Initialize the Application
|--------------------------------------------------------------------------
|
| Bootstrap the core application instance and bind the root path so that
| all path helpers resolve correctly throughout the request lifecycle.
|
*/

App::initialize(__DIR__ . '/..');

/*
|--------------------------------------------------------------------------
| Register Directory Structure
|--------------------------------------------------------------------------
|
| Set up the default directory structure used by the framework for views,
| sessions, logs, compiled templates, and other runtime artifacts.
|
*/

Directory::initDefaultStructure();

/*
|--------------------------------------------------------------------------
| Configure Error Handling
|--------------------------------------------------------------------------
|
| Enable or disable error display and logging based on environment settings.
| In production, errors should be logged but never exposed to the client.
|
*/

Debug::enableErrorDisplay(env('APP_DEBUG', false));
Debug::enableErrorLogging(env('APP_LOG_ERRORS', true));

/*
|--------------------------------------------------------------------------
| Configure the Template Engine
|--------------------------------------------------------------------------
|
| Register the directories used by the view engine: the source templates,
| the compiled PHP output, and the static cache for hybrid rendering.
|
*/

Engine::setViewDir(Directory::path('views'));
Engine::setCompiledDir(Directory::path('render_views'));
Engine::setStaticDir(Directory::path('static_views'));

/*
|--------------------------------------------------------------------------
| Configure Session Storage
|--------------------------------------------------------------------------
|
| Point the session handler to the application's designated sessions
| directory so that session files are stored in a consistent location.
|
*/

Session::setSavePath(Directory::path('sessions'));

/*
|--------------------------------------------------------------------------
| Register the Error Page Renderer
|--------------------------------------------------------------------------
|
| Plug the template engine into the debug system so that error pages are
| rendered through the standard view pipeline instead of plain HTML output.
|
*/

Debug::setErrorRenderer(function (array $data): string {
    return Engine::render('errors/debug', $data);
});

/*
|--------------------------------------------------------------------------
| Load Configuration Files
|--------------------------------------------------------------------------
|
| Load application config files through the kernel. These files are sourced
| from the config directory and run before routes are registered.
|
*/

Kernel::source('config', ['DB.php']);

/*
|--------------------------------------------------------------------------
| Register Application Routes
|--------------------------------------------------------------------------
|
| Load the route definitions that map incoming HTTP requests to their
| corresponding controllers and handlers.
|
*/

Route::source(['Web.php']);


/*
|--------------------------------------------------------------------------
| Configure Vite Asset Bundler
|--------------------------------------------------------------------------
|
| Register the application root path with the Vite integration so that
| asset manifests and compiled bundles are resolved from the correct
| location during both development and production builds.
|
*/

Vite::getInstance()->setBasePath(App::getRootPath());


/*
|--------------------------------------------------------------------------
| Run the Application
|--------------------------------------------------------------------------
|
| Hand control to the application to dispatch the current request through
| the router and return the response to the client.
|
*/

App::run();