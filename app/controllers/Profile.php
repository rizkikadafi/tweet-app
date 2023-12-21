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

    $data['curUser'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['email'] = $_SESSION['email'];

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

  public function other($email) 
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Profile'; // title tab
    $data['styles'] = ['theme.css'];

    $data['curUser'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['user'] = $this->model('User_model')->getUser($email);
    $data['email'] = $email;

    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer');
  }
}
