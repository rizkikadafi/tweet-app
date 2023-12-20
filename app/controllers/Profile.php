<?php

class Profile extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Profile'; // title tab
    $data['styles'] = ['theme.css'];
    $data['user'] = $_SESSION['user'];
    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer');
  }
}
