<?php 
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv -> load();

define('BASEURL', 'http://localhost/uas-project/public');

// database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tweet');

// google oauth
define('CLIENT_ID', $_ENV["CLIENT_ID"]);
define('CLIENT_SECRETE', $_ENV["CLIENT_SECRET"]);