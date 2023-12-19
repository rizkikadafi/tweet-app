<?php

class Authentication extends Controller
{
  private $redirect_uri = BASEURL . '/authentication/login';

  public function __construct()
  {
    Google_oauth::setClient(CLIENT_ID, CLIENT_SECRETE, $this->redirect_uri, ['email', 'profile']);
  }

  // default method
  public function index()
  {
    $this->register();
  }

  public function register()
  {
    if (isset($_POST['submit'])) {
      if ($this->model('User_model')->addUser($_POST) > 0) {
        $_SESSION['username'] = $_POST['username'];
        header('Location: ' . BASEURL . '/home');
        exit;
      } else {
        Flasher::setFlash("Username sudah digunakan!", "warning");
        header('Location: ' . BASEURL . '/authentication/register');
        exit;
      }
    } else {
      $data['title'] = 'Register'; // tab title
      $this->view('templates/header', $data);
      $this->view('authentication/register');
      $this->view('templates/footer', $data);
    }
  }

  public function login()
  {
    if (isset($_GET['code'])) {
      var_dump($_GET);
      $token = Google_oauth::getToken($_GET['code']);
      var_dump($token);
      if (isset($token['error'])) {
        unset($_GET['code']);
        header('Location: ' . BASEURL . '/authentication/login');
        exit;
      }

      $_SESSION['token'] = $token;
      $_SESSION['user'] = serialize(Google_oauth::getUserInfo());
      header('Location: ' . BASEURL . '/home');
      exit;
    } else if (isset($_POST['submit'])) {
      $result = $this->model('User_model')->auth($_POST);
      if ($result > 0) {
        $_SESSION['email'] = $_POST['email'];
        header('Location: ' . BASEURL . '/home');
        exit;
      } else if ($result == -1) {
        Flasher::setFlash("Anda belum terdaftar!", "warning");
        header('Location: ' . BASEURL . '/authentication/login');
        exit;
      } else {
        Flasher::setFlash("Username atau password salah!", "warning");
        header('Location: ' . BASEURL . '/authentication/login');
        exit;
      }
    } else {
      $data['title'] = 'Login'; // tab title
      $data['auth_url'] = Google_oauth::$auth_url;

      $this->view('templates/header', $data);
      $this->view('authentication/login', $data);
      $this->view('templates/footer', $data);
    }
  }
}
