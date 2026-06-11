<div align="center">
  <img src="https://repository-images.githubusercontent.com/267562756/9e8d4739-edc9-4d3e-a3e7-c9c209f9cf15" alt="Webrium Framework" />

  # Webrium
  ### Fast, Lightweight PHP Framework for Modern Web Applications

  [![Latest Stable Version](https://poser.pugx.org/webrium/webrium/v)](https://packagist.org/packages/webrium/webrium)
  [![Total Downloads](https://poser.pugx.org/webrium/webrium/downloads)](https://packagist.org/packages/webrium/webrium)
  [![License](https://poser.pugx.org/webrium/webrium/license)](https://packagist.org/packages/webrium/webrium)

  **Fast · Modular · Elegant**
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
        return view('users/index.php', compact('users'));
    }

    public function show($id)
    {
        return view('users/show.php', ['user' => User::find($id)]);
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

> **Documentation is currently being written.**  
> The full docs site is under construction. In the meantime, you can find the available references below.

### Getting Started
| Topic | Description |
|---|---|
| [Views](https://github.com/webrium/view) | Rendering views and templating syntax: loops, conditions, layouts |

### Routing & Request
| Topic | Description |
|---|---|
| [Routing](https://github.com/webrium/core/wiki/Route) | Define routes, groups, middleware, named routes |
| [Helper Functions](https://github.com/webrium/core/wiki/Helpers) | Global shortcuts: `url()`, `redirect()`, `input()`, `respond()`, `env()` and more |
| [URL Utilities](https://github.com/webrium/core/wiki/Url) | Generate and manipulate URLs |
| [Header Management](https://github.com/webrium/core/wiki/Header) | Control HTTP response headers |
| [HTTP Client](https://github.com/webrium/core/wiki/HttpClient) | Make outgoing HTTP requests with a fluent API |

### Security & Validation
| Topic | Description |
|---|---|
| [Form Validation](https://github.com/webrium/core/wiki/From-Validator) | Validate and sanitize user input |
| [Hash & Password](https://github.com/webrium/core/wiki/Hash) | Secure password hashing, HMAC, tokens, and UUIDs |
| [JWT](https://github.com/webrium/core/wiki/JWT-Documentation) | Issue and verify JSON Web Tokens for API authentication |

### Database
| Topic | Description |
|---|---|
| [FoxDB — Query Builder](https://github.com/webrium/foxdb) | Fluent query builder and ORM for database operations |

### Files & Storage
| Topic | Description |
|---|---|
| [File Manager](https://github.com/webrium/core/wiki/File) | Read, write, stream, and download files |
| [File Upload](https://github.com/webrium/core/wiki/Upload) | Handle multipart file uploads safely |
| [Session Manager](https://github.com/webrium/core/wiki/Session) | Session data, flash messages, and counters |

### Advanced
| Topic | Description |
|---|---|
| [Console](https://github.com/webrium/console) | CLI commands and task automation |

---

## Core Library

Webrium is powered by **[webrium/core](https://github.com/webrium/core)** — a standalone PHP component library that can be used independently in any project.

---

## What's new in v4.0.0

- `Kernel` class introduced as the application execution core
- Controller dispatch decoupled from `File` and `Directory`
- `Header::respond()` as the canonical HTTP response method
- `Url::input()` handles all request body parsing
- `Route::source()` supports custom directory paths
- Class-based middleware support (`Middleware@handle` or `Middleware::class`)
- Middleware failure returns `403` instead of falling through to the next route
- Both string (`'Controller@method'`) and array (`[Controller::class, 'method']`) route syntax supported
- `boot()` and `teardown()` controller lifecycle hooks
- `Event::once()` fixed
- `declare(strict_types=1)` across all source files
- `Mail` stub removed

---

## License

Webrium is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
