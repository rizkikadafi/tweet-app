<?php

class Http
{
  private $apiUrl;
  public $client;

  public function __construct($apiUrl)
  {
    $this->apiUrl = $apiUrl;
    $this->client = new GuzzleHttp\Client();
  }
}
