<?php
// Example Usage:

use App\SessionRateLimiter;

$limiter = new SessionRateLimiter(60, 60); // 60 requests per 60 seconds

if ($limiter->allowRequest()) {
    // echo "Request allowed. Remaining attempts: " . $limiter->getRemainingAttempts() . "\n";
    // Process the request
} else {
    echo "Rate limit exceeded. Please wait " . $limiter->getTimeUntilReset() . " seconds.\n";
    // Handle the rate limit, e.g., return a 429 Too Many Requests status
    http_response_code(429);
    exit();
}