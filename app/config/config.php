<?php
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

define('BASEURL', 'http://localhost/tweet-app/public');

// database
define('DB_HOST', $_ENV["DB_HOST"]);
define('DB_USER', $_ENV["DB_USER"]);
define('DB_PASS', $_ENV["DB_PASS"]);
define('DB_NAME', $_ENV["DB_NAME"]);
define('DB_PORT', $_ENV["DB_PORT"]);

// google oauth
define('CLIENT_ID', $_ENV["CLIENT_ID"]);
define('CLIENT_SECRET', $_ENV["CLIENT_SECRET"]);

// image host
define('IMAGE_HOST_CLOUD_NAME', $_ENV["IMAGE_HOST_CLOUD_NAME"]);
define('IMAGE_HOST_API_KEY', $_ENV["IMAGE_HOST_API_KEY"]);
define('IMAGE_HOST_API_SECRET', $_ENV["IMAGE_HOST_API_SECRET"]);
