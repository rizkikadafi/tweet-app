<?php

class Google_oauth
{
  public static $client;
  public static $oauth;
  public static $auth_url;

  public static function setClient($client_id, $client_secrete, $redirect_uri, $scope)
  {
    Google_oauth::$client = new Google\Client();
    Google_oauth::$client->setClientId($client_id);
    Google_oauth::$client->setClientSecret($client_secrete);
    Google_oauth::$client->setRedirectUri($redirect_uri);

    foreach ($scope as $s) {
      Google_oauth::$client->addScope($s);
    }

    Google_oauth::$auth_url = Google_oauth::$client->createAuthUrl();

    Google_oauth::$oauth = new Google\Service\Oauth2(Google_oauth::$client);
  }

  public static function getToken($code)
  {
    $token = Google_oauth::$client->fetchAccessTokenWithAuthCode($code);
    return $token;
  }

  public static function getUserInfo()
  {
    return Google_oauth::$oauth->userinfo->get();
  }


  public static function revokeToken()
  {
    Google_oauth::$client = new Google\Client();
    Google_oauth::$client->setAccessToken($_SESSION['token']);
    Google_oauth::$client->revokeToken();
  }
}
