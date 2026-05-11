<div align="center">
  <img src="https://repository-images.githubusercontent.com/267562756/f844fe22-c086-4bfd-a20e-ee0e111ceb28" alt="Webrium Framework" />

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

Create a new project using Composer:

```bash
composer create-project webrium/webrium my-app
```

Install frontend dependencies:

```bash
cd my-app && npm install
```

### Start the Development Server

```bash
npm run dev
```

Then open your browser at:

```
http://localhost:8000
```

---



## Documentation

### 🚀 Getting Started
| Topic | Description |
|---|---|
| [Views](https://github.com/webrium/view) | Rendering views and Templating syntax : loops, conditions, layouts |

### 🌐 Routing & Request
| Topic | Description |
|---|---|
| [Routing](https://github.com/webrium/core/wiki/Route) | Define GET, POST, PUT, DELETE routes, groups, middleware, named routes |
| [Helper Functions](https://github.com/webrium/core/wiki/Helpers) | Global shortcuts: `url()`, `redirect()`, `input()`, `env()`, and more |
| [URL Utilities](https://github.com/webrium/core/wiki/Url) | Generate and manipulate URLs |
| [Header Management](https://github.com/webrium/core/wiki/Header) | Control HTTP response headers |
| [HTTP Client](https://github.com/webrium/core/wiki/HttpClient) | Make outgoing HTTP requests with a fluent API |

### 🛡️ Security & Validation
| Topic | Description |
|---|---|
| [Form Validation](https://github.com/webrium/core/wiki/From-Validator) | Validate and sanitize user input |
| [Hash & Password](https://github.com/webrium/core/wiki/Hash) | Secure password hashing, HMAC, tokens, and UUIDs |
| [JWT](https://github.com/webrium/core/wiki/JWT-Documentation) | Issue and verify JSON Web Tokens for API auth |

### 🗄️ Database
| Topic | Description |
|---|---|
| [FoxDB — Query Builder](https://github.com/webrium/foxdb) | Fluent query builder and ORM for database operations |

### 🛠️ Files & Storage
| Topic | Description |
|---|---|
| [File Manager](https://github.com/webrium/core/wiki/File) | Read, write, stream, download files and manage directories |
| [File Upload](https://github.com/webrium/core/wiki/Upload) | Handle multipart file uploads safely |
| [Session Manager](https://github.com/webrium/core/wiki/Session) | Session data, flash messages, and counters |

### ⚙️ Advanced
| Topic | Description |
|---|---|
| [Email](https://github.com/webrium/core/wiki/Email-Documentation) | Send emails from your application |
| [Console](https://github.com/webrium/console) | CLI commands and task automation |

---

## Quick Example

**routes/web.php**
```php
use Webrium\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/api', 'middleware' => 'AuthMiddleware@handle'], function () {
    Route::get('/users', 'UserController@index');
    Route::post('/users', 'UserController@store');
    Route::get('/users/{id}', 'UserController@show');
});
```

**app/Controllers/UserController.php**
```php
class UserController
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
}
```

---

## Core Library

Webrium is powered by **[webrium/core](https://github.com/webrium/core)** — a standalone PHP component library that can also be used independently in any project.

---

## License

Webrium is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
