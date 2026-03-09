<?php

// Force PHP to display any and all errors, no matter what
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Wrap the entire application bootstrap in a try-catch block
try {
    define('LARAVEL_START', microtime(true));

    // Determine if the application is in maintenance mode...
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader...
    require __DIR__.'/../vendor/autoload.php';

    // Bootstrap Laravel and handle the request...
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $app->handleRequest(Request::capture());

} catch (Throwable $e) {
    // If a fatal error is caught, stop everything and print it out.
    // This will override the generic "500 Internal Server Error" page.
    http_response_code(500);
    echo '<pre style="font-family: monospace; background-color: #fcebeb; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px;">';
    echo "<h2 style='color: #721c24;'>Fatal Application Error</h2>";
    echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "\n\n";
    echo "<strong>File:</strong> " . htmlspecialchars($e->getFile()) . "\n";
    echo "<strong>Line:</strong> " . htmlspecialchars($e->getLine()) . "\n\n";
    echo "<strong>Stack Trace:</strong>\n" . htmlspecialchars($e->getTraceAsString());
    echo '</pre>';
}
