<?php
// src/Core/Router.php

// Declare the namespace for the Router class.
// The namespace groups this class into the "Phlask\Core" namespace.
namespace Phlask\Core;

// Define the Router class.
class Router {
    // This private property holds the routes added to the router.
    // It is an associative array where the method (GET, POST, etc.) 
    // and the route URI are mapped to a callback function.
    private $routes = [];

    /**
     * Add a route to the router.
     *
     * @param string $method The HTTP method (e.g., GET, POST).
     * @param string $route The URI route (e.g., /home, /about).
     * @param callable $callback A function to handle the request for this route.
     *
     * This method stores the provided route and its corresponding callback
     * function into the $routes array, categorized by the HTTP method.
     */
    public function addRoute($method, $route, $callback) {
        // Adds the route and its callback to the $routes array under the specific HTTP method.
        $this->routes[$method][$route] = $callback;
    }

    /**
     * Dispatch the request to the appropriate route handler.
     *
     * @param object $request The request object which contains method and URI data.
     * @return object A response object after handling the request.
     *
     * This method checks the request method (GET, POST, etc.) and the URI 
     * from the request object. If a matching route is found, the corresponding 
     * callback function is executed, passing the request as a parameter.
     * If no route matches, it returns a 'Not Found' response with a 404 status code.
     */
    public function dispatch($request) {
        // Get the HTTP method (e.g., GET, POST) from the request object.
        $method = $request->getMethod();
        
        // Get the URI (e.g., /home, /about) from the request object.
        $uri = $request->getUri();

        // Check if the route exists for the given method and URI.
        if (isset($this->routes[$method][$uri])) {
            // Retrieve the callback function associated with the route.
            $callback = $this->routes[$method][$uri];
            
            // Execute the callback, passing the request object as an argument.
            $response = call_user_func($callback, $request);
            
            // Return the response generated by the callback.
            return $response;
        }

        // If no route matches, return a 404 'Not Found' response.
        return new Response('Not Found', 404);
    }
}