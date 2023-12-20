<?php

class Home extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'homepage'; // title tab
    $data['styles'] = ['theme.css'];
    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');

    // if (isset($_SESSION['token'])) {
    //   $data['title'] = 'homepage'; // title tab
    //   $data['user'] = unserialize($_SESSION['user']);
    //   $this->view('templates/header', $data);
    //   $this->view('home/index', $data);
    //   $this->view('templates/footer');
    // } else if (isset($_SESSION['email'])) {
    //   $data['title'] = 'homepage'; // title tab
    //   $this->view('templates/header', $data);
    //   $this->view('home/index');
    //   $this->view('templates/footer');
    // }
  }
}
