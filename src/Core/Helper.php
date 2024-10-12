<?php
namespace Phlask\Core;

// The Helper class provides utility functions to generate asset URLs for different types of static resources.
class Helper
{
    /**
     * Generate a URL for a static asset.
     *
     * @param string $path The relative path to the asset file (e.g., 'js/app.js', 'css/style.css').
     * @return string The full URL to the static asset.
     *
     * This method returns a URL string that points to a static asset located in the `/static/` directory.
     * It is the base function for generating asset URLs and is used by other methods like `css()`, `js()`, and `image()`.
     */
    public static function asset($path)
    {
        // Return the URL to the asset by prepending the /static/ directory to the path.
        return "/static/{$path}";
    }

    /**
     * Generate a URL for a CSS file.
     *
     * @param string $file The CSS file name (e.g., 'style.css').
     * @return string The full URL to the CSS file.
     *
     * This method generates the URL for a CSS file located in the `/static/css/` directory.
     * It internally calls the `asset()` method, appending the 'css/' prefix to the provided file name.
     */
    public static function css($file)
    {
        // Return the URL to the CSS file by using the asset() method and prepending 'css/' to the file name.
        return self::asset("css/{$file}");
    }

    /**
     * Generate a URL for a JavaScript file.
     *
     * @param string $file The JavaScript file name (e.g., 'app.js').
     * @return string The full URL to the JavaScript file.
     *
     * This method generates the URL for a JavaScript file located in the `/static/js/` directory.
     * It internally calls the `asset()` method, appending the 'js/' prefix to the provided file name.
     */
    public static function js($file)
    {
        // Return the URL to the JavaScript file by using the asset() method and prepending 'js/' to the file name.
        return self::asset("js/{$file}");
    }

    /**
     * Generate a URL for an image file.
     *
     * @param string $file The image file name (e.g., 'logo.png').
     * @return string The full URL to the image file.
     *
     * This method generates the URL for an image file located in the `/static/images/` directory.
     * It internally calls the `asset()` method, appending the 'images/' prefix to the provided file name.
     */
    public static function image($file)
    {
        // Return the URL to the image file by using the asset() method and prepending 'images/' to the file name.
        return self::asset("images/{$file}");
    }
}
