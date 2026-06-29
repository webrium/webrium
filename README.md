<div align="center">
  <img src="https://repository-images.githubusercontent.com/267562756/9e8d4739-edc9-4d3e-a3e7-c9c209f9cf15" alt="Webrium Framework" />

  # Webrium
  ### Fast, Lightweight PHP Framework for Modern Web Applications

  [![Latest Stable Version](https://poser.pugx.org/webrium/webrium/v)](https://packagist.org/packages/webrium/webrium)
  [![Total Downloads](https://poser.pugx.org/webrium/webrium/downloads)](https://packagist.org/packages/webrium/webrium)
  [![License](https://poser.pugx.org/webrium/webrium/license)](https://packagist.org/packages/webrium/webrium)

  **Fast · Modular · Elegant**

  [**webrium.dev**](https://webrium.dev) · [Documentation](https://webrium.dev/docs/v5/getting-started/introduction) · [GitHub](https://github.com/webrium)
</div>

---

## About Webrium

**Webrium** is a PHP web application framework built for developers who value simplicity, speed, and clean structure. It provides everything you need to build web applications and REST APIs without unnecessary complexity.

✔ Fast and lightweight  
✔ MVC architecture  
✔ Powerful routing system  
✔ Blade-compatible templating  
✔ Built-in database query builder (FoxDB)  
✔ Vite + TailwindCSS configured out of the box  

---

## Installation

```bash
composer create-project webrium/webrium my-app
cd my-app && npm install
npm run dev
```

Then open your browser at `http://localhost:8000`

---

## Routing

Webrium's routing API will feel immediately familiar if you've used Laravel.

```php
use Webrium\Route;

Route::get('/', function () {
    return 'Hello, World!';
});

Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::get('/users/{id}', 'UserController@show');

Route::group(['prefix' => '/api', 'middleware' => 'AuthMiddleware@handle'], function () {
    Route::get('/profile', 'ProfileController@index');
});
```

---

## Controllers

```php
<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        return view('users.show', ['user' => User::find($id)]);
    }

    public function store()
    {
        User::create(input());
        return ['status' => 'created'];
    }
}
```

---

## Documentation

The full documentation lives at **[webrium.dev/docs](https://webrium.dev/docs/v5/getting-started/introduction)**, organized into five sections:

- **[Getting Started](https://webrium.dev/docs/v5/getting-started/introduction)** — installation, configuration, request lifecycle
- **[Core](https://webrium.dev/docs/v5/core/introduction)** — routing, controllers, requests/responses, sessions, validation, uploads, HTTP client, JWT, hashing, events, filesystem, localization, error handling
- **[Database](https://webrium.dev/docs/v5/database/introduction)** — query builder, ORM, relationships, migrations, seeders
- **[Template Engine](https://webrium.dev/docs/v5/template-engine/introduction)** — syntax, layouts, components, hybrid caching
- **[Console](https://webrium.dev/docs/v5/console/introduction)** — the `webrium` CLI: scaffolding, migrations, plugins

The same documentation is also maintained as plain Markdown in the **[webrium/docs](https://github.com/webrium/docs)** repository — useful for offline reading, contributing fixes, or integrating with AI assistants (an `llms.txt` and a Claude `.skill` package are bundled there).

---

## Core Library

Webrium is powered by **[webrium/core](https://github.com/webrium/core)** — a standalone PHP component library that can be used independently in any project.

---

## License

Webrium is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
