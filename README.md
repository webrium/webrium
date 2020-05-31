# Webrium

### install
```
composer create-project webrium/webrium
```


Basic Controller
```php
<?php
namespace app\controllers;

class indexController
{


  public function index()
  {
    return view('welcome' , [ 'name' => 'Webrium Framework' ] );
  }

}

```

