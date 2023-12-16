<?php 

$client = new Google\Client();

$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRETE);

$redirect_uri = BASEURL . '/authentication/login';
$client->setRedirectUri($redirect_uri);
$client->addScope("profile");
$client->addScope("email");

