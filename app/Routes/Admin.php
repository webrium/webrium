<?php
use Webrium\Route;




// Dashboard
Route::get('/admin', 'AdminController@index');

// Statistics
// Route::get('/admin/statistics', [AdminController::class, 'statistics']);

// // Posts Management
// Route::get('/admin/posts', [AdminController::class, 'posts']);
// Route::get('/admin/posts/create', [AdminController::class, 'createPost']);

// // Categories
// Route::get('/admin/categories', [AdminController::class, 'categories']);

// // E-Commerce
// Route::get('/admin/products', [AdminController::class, 'products']);
// Route::get('/admin/orders', [AdminController::class, 'orders']);
// Route::get('/admin/customers', [AdminController::class, 'customers']);

// // Pages & Media
// Route::get('/admin/pages', [AdminController::class, 'pages']);
// Route::get('/admin/media', [AdminController::class, 'media']);

// // System
// Route::get('/admin/settings', [AdminController::class, 'settings']);
// Route::get('/admin/users', [AdminController::class, 'users']);

// // Authentication
// Route::get('/admin/logout', [AdminController::class, 'logout']);





// List all categories
Route::get('/admin/categories', 'CategoriesController@index');
Route::post('/admin/categories', 'CategoriesController@indexData');

// Show create form
Route::get('/admin/categories/create', 'CategoriesController@create');

// Store new category
Route::post('/admin/categories', 'CategoriesController@store');

// Show edit form
Route::get('/admin/categories/edit/{id}', 'CategoriesController@edit');

// Update category
Route::put('/admin/categories/{id}', 'CategoriesController@update');
Route::post('/admin/categories/{id}/update', 'CategoriesController@update'); // Alternative for form submission

// Delete category
Route::delete('/admin/categories/{id}', 'CategoriesController@delete');
Route::post('/admin/categories/{id}/delete', 'CategoriesController@delete'); // Alternative for form submission

// Bulk actions
Route::post('/admin/categories/bulk-action', 'CategoriesController@bulkAction');

// Get category tree (AJAX)
Route::get('/admin/categories/tree', 'CategoriesController@tree');