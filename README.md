# Phlask - A Lightweight PHP Microframework

Phlask is a lightweight, Flask-inspired microframework for PHP, designed to provide a simple and flexible way to build web applications and APIs. With an easy-to-understand structure, Phlask handles routing, request processing, templating, API development, and static asset management, making it ideal for small to medium-sized applications.

## Features

- **Routing**: Define routes for GET, POST, PUT, and DELETE requests with ease.
- **Request Handling**: Simple request object to access method, URI, parameters, and JSON data.
- **Response Handling**: Easily send HTML or JSON responses with status codes.
- **Templating**: Render dynamic HTML views using the built-in templating system.
- **API Support**: Create RESTful APIs with JSON responses.
- **Static Asset Management**: Helper methods to handle static assets like CSS, JS, and images.

## Installation

### Requirements
- PHP 8.2 or higher
- Composer (for dependency management)

### Step-by-Step Setup

1. **Create a new project directory**:
   ```bash
   mkdir my-phlask-project
   cd my-phlask-project
   ```

2. **Initialize Composer**:
   ```bash
   composer init
   ```

3. **Install Phlask** (Note: This step is hypothetical as Phlask is not actually published):
   ```bash
   composer require your-vendor/phlask
   ```

4. **Create the project structure**:
   ```
   my-phlask-project/
   ├── public/
   │   ├── index.php
   │   └── .htaccess
   ├── src/
   │   └── Views/
   │       └── home.php
   └── vendor/
   ```

5. **Configure your web server**:
   Ensure that your web server is configured to use the `public` directory as the document root.

6. **Run your application**:
   Start your local development server using PHP:
   ```bash
   php -S localhost:8000 -t public/
   ```
   Visit `http://localhost:8000` in your browser to see the app in action.

## Usage

### Defining Routes

```php
// Initialize the app
$app = new Phlask\Core\App();

// Define a GET route
$app->get('/', function(Phlask\Core\Request $request) {
    return Phlask\Core\Template::make('home.php', ['title' => 'Welcome to Phlask']);
});

// Define an API route
$app->api('/api/v1', function($api) {
    $api->get('/users', function(Phlask\Core\Request $request) {
        $users = [['id' => 1, 'name' => 'John Doe']];
        return new Phlask\Core\JsonResponse($users);
    });
});

// Run the app
$app->run();
```

### Working with Requests

```php
$request->getMethod();  // GET, POST, PUT, DELETE
$request->getUri();     // URI of the request
$request->getParam('name');  // Retrieves GET or POST parameter 'name'
$request->getJsonData();  // Retrieves JSON data from request body
```

### Sending Responses

```php
// HTML Response
return new Phlask\Core\Response('Hello, World!', 200);

// JSON Response
return new Phlask\Core\JsonResponse(['message' => 'Hello, World!'], 200);
```

### Templating

```php
Phlask\Core\Template::setViewsPath(__DIR__ . '/../src/Views');

return Phlask\Core\Template::make('home.php', ['title' => 'Phlask']);
```

In the view file (e.g., `home.php`):
```php
<h1><?= htmlspecialchars($title) ?></h1>
<link rel="stylesheet" href="{{ css('styles.css') }}">
<script src="{{ js('app.js') }}"></script>
<img src="{{ image('logo.png') }}" alt="Logo">
```

## Directory Structure

```
my-phlask-project/
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── static/
│       ├── css/
│       ├── js/
│       └── images/
├── src/
│   ├── Core/  (provided by Phlask)
│   │   ├── App.php
│   │   ├── Router.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── JsonResponse.php
│   │   ├── Template.php
│   │   ├── Helper.php
│   │   └── ApiGroup.php
│   └── Views/
│       └── home.php
└── vendor/
```

## Contributing

Contributions to Phlask are welcome! Please submit pull requests or open issues on the GitHub repository.

## License

Phlask is open-source software licensed under the MIT license.
