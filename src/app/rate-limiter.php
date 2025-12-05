<?php
// Example Usage:

use Delique\Api\SessionRateLimiter;

$limiter = new SessionRateLimiter(5, 60); // 2 requests per 60 seconds

if ($limiter->allowRequest()) {
    echo "Request allowed. Remaining attempts: " . $limiter->getRemainingAttempts() . "\n";
    // Process the request
} else {
    echo "Rate limit exceeded. Please wait " . $limiter->getTimeUntilReset() . " seconds.\n";
    // Handle the rate limit, e.g., return a 429 Too Many Requests status
    http_response_code(429);
    exit();
}