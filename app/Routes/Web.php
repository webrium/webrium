<?php
use App\Controllers\IndexController;
use Webrium\Route;

Route::get('/',[IndexController::class, 'index']);

