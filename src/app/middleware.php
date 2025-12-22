<?php

use App\Database;
use App\Models\User;
use App\Session;

Session::register('joe', 'password123');
Session::login('joe', 'password123');