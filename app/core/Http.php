<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Http
{
  private $apiUrl;
  private $client;

  public function __construct($apiUrl)
  {
    $this->apiUrl = $apiUrl;
    $this->client = new Client();
  }

  public function get($endpoint, $params = [])
  {
    try {
      $response = $this->client->request('GET', $this->apiUrl . $endpoint, [
        'query' => $params,
      ]);

      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleError($e);
    }
  }

  public function post($endpoint, $data = [])
  {
    try {
      $response = $this->client->request('POST', $this->apiUrl . $endpoint, [
        'form_params' => $data,
      ]);

      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleError($e);
    }
  }

  // Tambahan metode untuk menangani response dan error
  private function handleResponse($response)
  {
    $statusCode = $response->getStatusCode();
    $data = $response->getBody()->getContents();

    return [
      'status_code' => $statusCode,
      'data' => $data,
    ];
  }

  private function handleError($exception)
  {
    $statusCode = $exception->getResponse()->getStatusCode();
    $errorMessage = $exception->getMessage();

    return [
      'status_code' => $statusCode,
      'error' => $errorMessage,
    ];
  }
}

// Contoh penggunaan:
$apiUrl = 'https://api.example.com';
$http = new Http($apiUrl);

// Request GET
$resultGet = $http->get('/data', ['param1' => 'value1', 'param2' => 'value2']);
print_r($resultGet);

// Request POST
$resultPost = $http->post('/submit', ['key' => 'value']);
print_r($resultPost);

