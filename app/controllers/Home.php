<?php

class Home extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['username']) && !isset($_SESSION['token'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }
    $data['title'] = 'homepage'; // title tab
    $data['user'] = unserialize($_SESSION['user']);
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}
