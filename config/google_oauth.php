<?php 

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv -> load();

$client = new Google\Client();

$client->setClientId($_ENV["CLIENT_ID"]);
$client->setClientSecret($_ENV["CLIENT_SECRET"]);

$redirect_uri = BASEURL . '/authentication/login';
$client->setRedirectUri($redirect_uri);
$client->addScope("profile");
$client->addScope("email");

