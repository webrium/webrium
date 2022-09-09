<?php
namespace App\Controllers;

class IndexController
{

  public function index()
  {
    return view('Welcome' , [ 'name' => 'Webrium Framework' ] );
  }

}
