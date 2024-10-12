<?php
namespace Phlask\Core;

// Define the Template class responsible for rendering view templates.
class Template
{
    // The template file name to be rendered (e.g., 'home.php').
    private $template;

    // The data array that will be passed to the template for rendering.
    private $data;

    // The path to the views directory where template files are stored.
    private static $viewsPath;

    /**
     * Constructor for the Template class.
     *
     * @param string $template The template file name (relative to the views path).
     * @param array $data The associative array of data to be extracted into the template.
     *
     * Initializes the template file and the data array that will be used for rendering.
     */
    public function __construct($template, $data = [])
    {
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * Set the path to the views directory.
     *
     * @param string $path The full path to the directory where template files are located.
     *
     * This static method sets the base directory where template files are stored.
     * It ensures the path ends with a forward or backslash.
     */
    public static function setViewsPath($path)
    {
        // Set the views path and ensure it has a trailing slash.
        self::$viewsPath = rtrim($path, '/\\') . '/';
    }

    /**
     * Render the template and return the output.
     *
     * @return string The rendered content of the template.
     *
     * This method extracts the data array into individual variables, loads the
     * specified template file, processes any static asset placeholders (like CSS/JS),
     * and returns the final content.
     *
     * @throws \RuntimeException If the template file is not found.
     */
    public function render()
    {
        // Extract the data array to individual variables.
        extract($this->data);
        
        // Construct the full path to the template file.
        $fullPath = self::$viewsPath . $this->template;
        
        // Check if the template file exists.
        if (!file_exists($fullPath)) {
            // Throw an exception if the file is missing.
            throw new \RuntimeException("Template file not found: {$fullPath}");
        }

        // Start output buffering and include the template file.
        ob_start();
        include $fullPath;
        
        // Get the content from the output buffer and clear it.
        $content = ob_get_clean();

        // Process static asset placeholders (like {{ asset('...') }}).
        $content = $this->processStaticAssets($content);
        
        // Return the final processed content.
        return $content;
    }

    /**
     * Process static asset placeholders in the template content.
     *
     * @param string $content The rendered template content before processing assets.
     * @return string The content after replacing asset placeholders.
     *
     * This method looks for specific placeholders (e.g., {{ asset('...') }}, {{ css('...') }}) 
     * in the template and replaces them with the corresponding asset URLs using helper functions.
     */
    private function processStaticAssets($content)
    {
        // Define patterns to match asset placeholders and map them to their corresponding helper functions.
        $patterns = [
            '/\{\{\s*asset\((.*?)\)\s*\}\}/' => function($matches) { return Helper::asset(trim($matches[1], "'\""));  },
            '/\{\{\s*css\((.*?)\)\s*\}\}/'   => function($matches) { return Helper::css(trim($matches[1], "'\""));    },
            '/\{\{\s*js\((.*?)\)\s*\}\}/'    => function($matches) { return Helper::js(trim($matches[1], "'\""));     },
            '/\{\{\s*image\((.*?)\)\s*\}\}/' => function($matches) { return Helper::image(trim($matches[1], "'\""));  }
        ];

        // Use `preg_replace_callback_array` to process and replace the placeholders with actual values.
        return preg_replace_callback_array($patterns, $content);
    }

    /**
     * Create and render a template, returning a Response object.
     *
     * @param string $template The template file name (relative to the views path).
     * @param array $data The associative array of data to pass to the template.
     * @return Response A Response object containing the rendered template content.
     *
     * This static method provides a convenient way to create a Template object,
     * render it, and immediately return the result as a Response object.
     */
    public static function make($template, $data = [])
    {
        // Create a new Template object with the specified template and data.
        $templateObj = new self($template, $data);
        
        // Render the template and return it wrapped in a Response object.
        return new Response($templateObj->render());
    }
}
