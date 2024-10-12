<?php
// src/Core/App.php

namespace Phlask\Core;

// The App class acts as the central point for handling HTTP requests and routing them to appropriate callbacks.
class App {
    // Router instance used to manage routes and dispatch requests.
    private $router;

    /**
     * Constructor for the App class.
     *
     * Initializes a new instance of the Router class to handle routing of incoming HTTP requests.
     */
    public function __construct() {
        // Initialize a Router instance.
        $this->router = new Router();
    }

    /**
     * Register a GET route with a corresponding callback.
     *
     * @param string $route The URI pattern to match for the GET request.
     * @param callable $callback The callback function to execute when the route is matched.
     *
     * This method allows registering a route that listens for GET requests on a specific URI.
     */
    public function get($route, $callback) {
        // Add the GET route to the router.
        $this->router->addRoute('GET', $route, $callback);
    }

    /**
     * Register a POST route with a corresponding callback.
     *
     * @param string $route The URI pattern to match for the POST request.
     * @param callable $callback The callback function to execute when the route is matched.
     *
     * This method allows registering a route that listens for POST requests on a specific URI.
     */
    public function post($route, $callback) {
        // Add the POST route to the router.
        $this->router->addRoute('POST', $route, $callback);
    }

    /**
     * Run the application by dispatching the current request.
     *
     * This method creates a new Request instance to capture the incoming HTTP request, 
     * dispatches the request to the appropriate route via the Router, and sends the response to the client.
     */
    public function run() {
        // Create a new Request instance to capture the current request data (method, URI, etc.).
        $request = new Request();
        
        // Dispatch the request through the router to get the appropriate response.
        $response = $this->router->dispatch($request);
        
        // Send the response back to the client.
        $response->send();
    }
}
