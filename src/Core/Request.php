<?php
// src/Core/Request.php

// Declare the namespace for the Request class.
namespace Phlask\Core;

// Define the Request class.
class Request {
    /**
     * Get the HTTP method used in the request.
     *
     * @return string The request method (e.g., GET, POST).
     *
     * This method retrieves the HTTP method from the global `$_SERVER` array.
     */
    public function getMethod() {
        // Return the HTTP method (e.g., GET, POST) from the global $_SERVER superglobal.
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get the URI from the request.
     *
     * @return string The request URI (e.g., /home, /about).
     *
     * This method retrieves the request URI from the global `$_SERVER` array.
     */
    public function getUri() {
        // Return the request URI from the global $_SERVER superglobal.
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Retrieve a parameter from the request.
     *
     * @param string $key The parameter key (name) to retrieve.
     * @param mixed $default The default value to return if the parameter is not found.
     * @return mixed The value of the request parameter, or the default if not found.
     *
     * This method attempts to retrieve a parameter from the GET or POST data.
     * If the parameter is not found in either, it returns the provided default value.
     */
    public function getParam($key, $default = null) {
        // Check if the key exists in the GET or POST array, or return the default value.
        return $_GET[$key] ?? $_POST[$key] ?? $default;
    }
}
