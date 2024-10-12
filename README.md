# Phlask - A Lightweight PHP Microframework

Phlask is a lightweight, Flask-inspired microframework for PHP, designed to provide a simple and flexible way to build web applications. With an easy-to-understand structure, Phlask handles routing, request processing, templating, and database interaction, making it ideal for small to medium-sized applications.

## Features

- **Routing**: Define routes for GET and POST requests with ease.
- **Request Handling**: Simple request object to access method, URI, and parameters.
- **Response Handling**: Easily send responses with status codes.
- **Templating**: Render dynamic HTML views using the built-in templating system.
- **Database Interaction**: Basic database interaction using PDO with support for singleton pattern.
- **Static Assets**: Helper methods to handle static assets like CSS, JS, and images.

## Installation

### Requirements
- PHP 7.4 or higher
- Composer (for dependency management)
- MySQL (or any PDO-compatible database)

### Step-by-Step Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/phlask.git
   cd phlask
   ```

2. **Configure the database**:
   In the `src/Config/config.php` file, add your database credentials:
   ```php
   return [
       'host' => 'localhost',
       'database' => 'your_database_name',
       'username' => 'your_username',
       'password' => 'your_password',
   ];
   ```

3. **Run your application**:
   Start your local development server using PHP:
   ```bash
   php -S localhost:8000 -t public/
   ```
   Visit `http://localhost:8000` in your browser to see the app in action.

## Usage

### Defining Routes

Phlask allows you to define routes for both GET and POST requests.

```php
// Initialize the app
$app = new Phlask\Core\App();

// Define a GET route for the home page
$app->get('/', function($request) {
    return new Phlask\Core\Response('Welcome to Phlask!');
});

// Define a POST route
$app->post('/submit', function($request) {
    $name = $request->getParam('name');
    return new Phlask\Core\Response("Hello, {$name}");
});

// Run the app
$app->run();
```

### Working with Requests

The `Request` class provides access to the incoming request's method, URI, and parameters:

```php
$request->getMethod(); // GET or POST
$request->getUri();    // URI of the request
$request->getParam('name'); // Retrieves GET or POST parameter 'name'
```

### Sending Responses

Use the `Response` class to send responses back to the client:

```php
return new Phlask\Core\Response('Hello, World!', 200);
```

You can set custom status codes like `404` or `500`:

```php
return new Phlask\Core\Response('Not Found', 404);
```

### Templating

Phlask includes a simple templating engine to render views. Set your views directory with `Template::setViewsPath()` and use `Template::make()` to render a template:

```php
Phlask\Core\Template::setViewsPath(__DIR__ . '/views');

$app->get('/about', function() {
    return Phlask\Core\Template::make('about.php', ['name' => 'Phlask']);
});
```

In the view file (e.g., `about.php`):
```php
<h1>Welcome to <?= $name; ?></h1>
```

### Static Asset Management

Phlask provides helper methods for managing static assets like CSS, JS, and images. You can use these helper functions in your templates to correctly link your static files:

```php
<link rel="stylesheet" href="<?= Phlask\Core\Helper::css('style.css'); ?>">
<script src="<?= Phlask\Core\Helper::js('app.js'); ?>"></script>
<img src="<?= Phlask\Core\Helper::image('logo.png'); ?>" alt="Logo">
```

### Database Interaction

Phlask comes with a simple ORM-like structure using the `Model` class. Define your models by extending `Phlask\Core\Model` and specify the `$table` and `$fillable` properties:

```php
class User extends Phlask\Core\Model {
    protected static $table = 'users';
    protected static $fillable = ['name', 'email'];
}
```

You can perform database queries like:
```php
$users = User::all(); // Retrieve all users
$user = User::find(1); // Find a user by ID
User::create(['name' => 'John Doe', 'email' => 'john@example.com']); // Insert a new user
```

## Directory Structure

```
/src
  /Config
    config.php          # Database configuration
  /Core
    App.php             # Main application class
    Router.php          # Routing logic
    Request.php         # Request handling
    Response.php        # Response handling
    Template.php        # Templating engine
    Model.php           # Base model for database interaction
    Database.php        # PDO database connection
    Helper.php          # Static asset helper functions
/public
  index.php             # Entry point for the application
  /static
    /css                # CSS files
    /js                 # JavaScript files
    /images             # Image files
/views
  about.php             # Example view file
```

## Contributing

Contributions are welcome! If you'd like to contribute to Phlask, please follow these steps:

1. Fork the repository.
2. Create a new feature branch.
3. Make your changes and commit them.
4. Submit a pull request.

Please make sure your code follows PSR standards.

## License

Phlask is open-source and available under the [MIT License](LICENSE).

---

### Conclusion

This README gives a full overview of your Phlask framework, including installation, usage, and the main components of the framework. Feel free to customize it further to fit any additional features or details you might want to highlight.
