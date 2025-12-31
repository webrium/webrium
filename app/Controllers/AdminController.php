<?php
namespace App\Controllers;

use Zog\Zog;

class AdminController
{
  /**
   * Display admin dashboard
   */
  public function index()
  {
    return Zog::render('page_loaders/admin/dashboard_loader.php');
  }

  /**
   * Display statistics page
   */
  public function statistics()
  {
    return Zog::render('page_loaders/admin/statistics_loader.php');
  }

  /**
   * Display all posts
   */
  public function posts()
  {
    return Zog::render('page_loaders/admin/posts_loader.php');
  }

  /**
   * Display create post form
   */
  public function createPost()
  {
    return Zog::render('page_loaders/admin/post_create_loader.php');
  }

  /**
   * Display categories
   */
  public function categories()
  {
    return Zog::render('page_loaders/admin/categories_loader.php');
  }

  /**
   * Display all products
   */
  public function products()
  {
    return Zog::render('page_loaders/admin/products_loader.php');
  }

  /**
   * Display all orders
   */
  public function orders()
  {
    return Zog::render('page_loaders/admin/orders_loader.php');
  }

  /**
   * Display customers
   */
  public function customers()
  {
    return Zog::render('page_loaders/admin/customers_loader.php');
  }

  /**
   * Display custom pages
   */
  public function pages()
  {
    return Zog::render('page_loaders/admin/pages_loader.php');
  }

  /**
   * Display media library
   */
  public function media()
  {
    return Zog::render('page_loaders/admin/media_loader.php');
  }

  /**
   * Display settings
   */
  public function settings()
  {
    return Zog::render('page_loaders/admin/settings_loader.php');
  }

  /**
   * Display users management
   */
  public function users()
  {
    return Zog::render('page_loaders/admin/users_loader.php');
  }

  /**
   * Handle logout
   */
  public function logout()
  {
    // Clear session and redirect to login
    session_destroy();
    header('Location: /admin/login');
    exit;
  }
}