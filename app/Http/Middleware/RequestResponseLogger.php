<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequestResponseLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Process the request and get the response
        $response = $next($request);

        // Log the details, but wrap in a try-catch to prevent logging failures from crashing the app
        try {
            $this->log($request, $response);
        } catch (\Throwable $e) {
            Log::channel('support_log')->error('Failed to log request/response', ['error' => $e->getMessage()]);
        }

        return $response;
    }

    /**
     * Logs the request and response.
     */
    protected function log(Request $request, Response $response): void
    {
        $data = [
            'request' => [
                'method' => $request->getMethod(),
                'url' => $request->getUri(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'body' => $this->hidePasswords($request->all()),
            ],
            'response' => [
                'status_code' => $response->getStatusCode(),
                'content' => $this->getResponseContent($response),
            ],
            'user' => $request->user() ? ['id' => $request->user()->id, 'email' => $request->user()->email] : null,
        ];

        Log::channel('support_log')->info('HTTP Request-Response', $data);
    }

    /**
     * Formats the response content for logging.
     */
    protected function getResponseContent(Response $response)
    {
        // For redirects, just log the target URL
        if ($response->isRedirection()) {
            return 'Redirecting to ' . $response->headers->get('Location');
        }

        // THE FIX: Check the Content-Type header for 'json'
        if (str_contains($response->headers->get('Content-Type', ''), 'json')) {
            $content = $response->getContent();
            return $this->hidePasswords($content);
        }

        // For all other responses (HTML, binary, etc.), don't log the content
        return '[Content not logged]';
    }

    /**
     * Recursively hides passwords in an array or JSON string.
     */
    protected function hidePasswords($data)
    {
        // If it's a JSON string, decode it first
        if (is_string($data)) {
            $decoded = json_decode($data, true);
            // only overwrite if json is valid
            if (json_last_error() === JSON_ERROR_NONE) {
                $data = $decoded;
            }
        }

        if (!is_array($data)) {
            return $data;
        }

        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $value = $this->hidePasswords($value);
            } elseif (is_string($key) && stripos($key, 'password') !== false) {
                $value = '[********]';
            }
        }
        
        unset($value); // Unset the reference to the last element

        return $data;
    }
}
