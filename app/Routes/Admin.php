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






// ===== VIEW ROUTES (GET) =====

// List categories page
Route::get('/admin/categories', 'CategoriesController@index');

// Create form page
Route::get('/admin/categories/create', 'CategoriesController@create');

// Edit form page
Route::get('/admin/categories/edit/{id}', 'CategoriesController@edit');


// ===== API ROUTES (POST) =====

// Get all categories data (API)
Route::post('/admin/categories', 'CategoriesController@indexData');

// Get parent categories (API)
Route::post('/admin/categories/parents', 'CategoriesController@getParents');

// Get single category (API)
Route::post('/admin/categories/{id}', 'CategoriesController@show');

// Store new category (API)
Route::post('/admin/categories/store', 'CategoriesController@store');

// Update category (API)
Route::post('/admin/categories/{id}/update', 'CategoriesController@update');

// Delete category (API)
Route::post('/admin/categories/{id}/delete', 'CategoriesController@delete');

// Bulk actions (API)
Route::post('/admin/categories/bulk-action', 'CategoriesController@bulkAction');

// Get category tree (API)
Route::post('/admin/categories/tree', 'CategoriesController@tree');