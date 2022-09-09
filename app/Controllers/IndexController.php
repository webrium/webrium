<?php
namespace app\controllers;

class indexController
{

  public function index()
  {
    return view('Welcome' , [ 'name' => 'Webrium Framework' ] );
  }

}
