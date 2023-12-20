<?php

class Profile extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Profile'; // title tab
    $data['styles'] = ['theme.css'];
    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer');
  }

  public function edit()
  {
    $this->model('User_model')->editUser($_POST);
    header('Location: ' . BASEURL . '/profile');
    exit;
  }
}
