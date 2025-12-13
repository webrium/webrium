<?php
namespace App\Controllers;

class IndexController
{

  public function index()
  {
    return view('Welcome.php' , [ 'name' => 'Webrium Framework Version 3' ] );
  }

}
