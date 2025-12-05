<?php

namespace Delique\Api;

class SessionRateLimiter {
    private $limit;
    private $window; // in seconds
    private $sessionKey;

    public function __construct($limit, $window, $sessionKey = 'rate_limit_data') {
        $this->limit = $limit;
        $this->window = $window;
        $this->sessionKey = $sessionKey;

        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    public function allowRequest() {
        $currentTime = time();
        $requests = &$_SESSION[$this->sessionKey];

        // Remove requests older than the window
        $requests = array_filter($requests, function($timestamp) use ($currentTime) {
            return ($currentTime - $timestamp) < $this->window;
        });

        // Check if the limit is exceeded
        if (count($requests) >= $this->limit) {
            return false; // Rate limit exceeded
        }

        // Add the current request timestamp
        $requests[] = $currentTime;
        return true; // Request allowed
    }

    public function getRemainingAttempts() {
        $currentTime = time();
        $requests = &$_SESSION[$this->sessionKey];

        // Remove requests older than the window (re-filtering for accuracy if allowRequest wasn't just called)
        $requests = array_filter($requests, function($timestamp) use ($currentTime) {
            return ($currentTime - $timestamp) < $this->window;
        });

        return max(0, $this->limit - count($requests));
    }

    public function getTimeUntilReset() {
        $requests = &$_SESSION[$this->sessionKey];
        if (empty($requests)) {
            return 0;
        }
        $oldestRequestTime = min($requests);
        $resetTime = $oldestRequestTime + $this->window;
        return max(0, $resetTime - time());
    }
}
?>