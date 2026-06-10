<?php

/**
 * Web Routes
 *
 * Register your application's web routes here.
 * Each route is mapped to a controller action.
 */

use App\Controllers\IndexController;
use Webrium\Route;

Route::get('/', [IndexController::class, 'index']);