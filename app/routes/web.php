<?php
use webrium\core\Route;


Route::get('','controllers@indexController->index');


Route::notFound();
