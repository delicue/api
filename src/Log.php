<?php 

namespace App;

class Log {
    public static function info($message) {
        error_log(message: "[INFO] $message");
    }

    public static function error($message) {
        error_log(message: "[ERROR] $message");
    }
}
