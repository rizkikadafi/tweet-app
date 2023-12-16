<?php 

class Authentication extends Controller {
  // default method
  public function index() {
    $this->register();
  }

  public function register() {
    if(isset($_POST['submit'])) {
      if($this->model('User_model')->addUser($_POST) > 0) {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header('Location: ' . BASEURL . '/home');
        exit;
      }
    } else {
      $data['title'] = 'Register'; // tab title
      $this->view('templates/header', $data);
      $this->view('authentication/register');
      $this->view('templates/footer', $data);
    }
  }

  public function login() {
    if(isset($_POST['submit'])) {
      header('Location: ' . BASEURL . '/home');
      session_start();
      $_SESSION['user'] = "test";
      exit;
    } else {
      $data['title'] = 'Login'; // tab title
      $this->view('templates/header', $data);
      $this->view('authentication/login');
      $this->view('templates/footer', $data);
    }
  }
}