<?php

namespace App\Controllers;

/**
 * Default controller for the application's home page.
 *
 * Mapped to "/" in your route file (e.g. app/Routes/web.php). This is the
 * landing controller you get on a fresh install — replace its body with
 * your own logic once you start building.
 */
class IndexController
{
  /**
   * Handle GET / and render the welcome screen.
   *
   * Returns the output of the view loader, which Webrium sends back as
   * the HTTP response.
   *
   * @return mixed The rendered "welcome" view.
   */
  public function index()
  {
    
    // Render the default welcome page shipped with the starter template.
    return view('loaders/WelcomeLoader');
  }
}