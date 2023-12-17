<?php

class Home extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }
    $data['title'] = 'homepage'; // title tab
    $this->view('templates/header', $data);
    $this->view('home/index');
    $this->view('templates/footer');
  }
}

