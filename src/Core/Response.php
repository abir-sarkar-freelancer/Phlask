<?php
// src/Core/Response.php

// Declare the namespace for the Response class.
namespace Phlask\Core;

// Define the Response class.
class Response {
    // The content of the HTTP response (e.g., HTML, JSON, etc.).
    private $content;

    // The HTTP status code of the response (e.g., 200, 404, 500).
    private $statusCode;

    /**
     * Constructor for the Response class.
     *
     * @param string $content The body of the response, defaults to an empty string.
     * @param int $statusCode The HTTP status code, defaults to 200 (OK).
     *
     * This constructor initializes the response content and status code.
     */
    public function __construct($content = '', $statusCode = 200) {
        // Initialize the response content.
        $this->content = $content;

        // Initialize the HTTP status code.
        $this->statusCode = $statusCode;
    }

    /**
     * Send the HTTP response to the client.
     *
     * This method sets the HTTP status code and outputs the content.
     * It uses the PHP `http_response_code()` function to set the status,
     * and the `echo` statement to output the response content to the client.
     */
    public function send() {
        // Set the HTTP response code.
        http_response_code($this->statusCode);

        // Output the response content.
        echo $this->content;
    }
}
