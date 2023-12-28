<?php
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

define('BASEURL', 'http://localhost/uas-project/public');

// database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tweet');

// google oauth
define('CLIENT_ID', $_ENV["CLIENT_ID"]);
define('CLIENT_SECRET', $_ENV["CLIENT_SECRET"]);

// image host
define('IMAGE_HOST_CLOUD_NAME', $_ENV["IMAGE_HOST_CLOUD_NAME"]);
define('IMAGE_HOST_API_KEY', $_ENV["IMAGE_HOST_API_KEY"]);
define('IMAGE_HOST_API_SECRET', $_ENV["IMAGE_HOST_API_SECRET"]);








