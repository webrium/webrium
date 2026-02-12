<?php
namespace App\Controllers;

class IndexController
{

  public function index()
  {
    return view('page_loaders/welcomeLoader.php');
  }

}
