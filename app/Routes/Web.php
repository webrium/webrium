<?php
use webrium\core\Route;

Route::get('','IndexController->index');


Route::notFound();
