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
        Flasher::setFlash("email sudah digunakan!", "warning");
        header('Location: ' . BASEURL . '/authentication/register');
        exit;
      }
    } else {
      $data['title'] = 'Register'; // tab title
      $data['auth_url'] = Google_oauth::$auth_url;

      $this->view('templates/header', $data);
      $this->view('authentication/register', $data);
      $this->view('templates/footer', $data);
    }
  }

  public function login()
  {
    if (isset($_GET['code'])) {
      $token = Google_oauth::getToken($_GET['code']);
      if (isset($token['error'])) {
        unset($_GET['code']);
        header('Location: ' . BASEURL . '/authentication/login');
        exit;
      }

      $user_info = Google_oauth::getUserInfo();
      // var_dump($user_info['email']);
      $result = $this->model('User_model')->authWithGoogle($user_info);

      if ($result > 0) {
        $_SESSION['user'] = $this->model('User_model')->getUser($user_info['email']);
        $_SESSION['token'] = $token;
        header('Location: ' . BASEURL . '/home');
        exit;
      } else {
        $result = $this->model('User_model')->addUserViaGoogle($user_info);
        if ($result) {
          $_SESSION['user'] = $this->model('User_model')->getUser($user_info['email']);
          $_SESSION['token'] = $token;
          header('Location: ' . BASEURL . '/home');
          exit;
        } else {
          header('Location: ' . BASEURL . '/login');
          exit;
        }
      }
    } else if (isset($_POST['submit'])) {
      $result = $this->model('User_model')->auth($_POST);
      if ($result > 0) {
        $_SESSION['user'] = $this->model('User_model')->getUser($_POST['email']);
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
