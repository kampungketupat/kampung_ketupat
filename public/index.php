<?php

session_start();

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '');
// Debug aktif (opsional, nanti matikan kalau sudah selesai)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load core
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';

// Router
$router = new Router();

// Routes
require_once BASE_PATH . '/routes/web.php';

// Run
$router->dispatch();
