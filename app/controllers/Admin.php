<?php

class Admin extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['admin'])) {
      header('Location: ' . BASEURL . '/admin/login');
      exit;
    }

    $data['title'] = 'homepage admin'; // title tab
    $data['styles'] = ['theme.css', 'like.css'];
    $data['scripts'] = ['search_user.js', 'like.js'];

    $data['user'] = $this->model('User_model')->getAllUser();

    $this->view('templates/header', $data);
    $this->view('templates/navbar_admin', $data);
    $this->view('admin/index', $data);
    $this->view('templates/footer', $data);
  }

  public function login()
  {
    $admin_username = 'tweet-app-admin';
    $admin_password = 'tweet-app-admin';

    $data['title'] = 'Admin Login'; // tab title
    $data['captcha'] = [rand(0, 9), rand(0, 9)];

    if (isset($_POST['submit'])) {
      if ($_POST['username'] == $admin_username && $_POST['password'] == $admin_password) {
        if ($_POST['val1'] + $_POST['val2'] != $_POST['captcha']) {
          Flasher::setFlash("captcha salah", "warning");
          header('Location: ' . BASEURL . '/admin/login');
          exit;
        }
        $_SESSION['admin'] = $admin_username;
        header('Location: ' . BASEURL . '/admin');
        exit;
      } else {
        Flasher::setFlash("username atau password salah!", "warning");
        header('Location: ' . BASEURL . '/admin/login');
        exit;
      }
    } else {
      $this->view('templates/header', $data);
      $this->view('admin/login', $data);
      $this->view('templates/footer', $data);
    }
  }

  public function edit($userId)
  {
    if (!isset($_SESSION['admin'])) {
      header('Location: ' . BASEURL . '/admin/login');
      exit;
    }

    $data['title'] = 'homepage admin'; // title tab
    $data['styles'] = ['theme.css', 'like.css'];
    $data['scripts'] = ['search_user.js', 'like.js'];

    $data['user_current'] = $this->model('User_model')->getUserById($userId);

    $this->view('templates/header', $data);
    $this->view('templates/navbar_admin', $data);
    $this->view('admin/edit_user', $data);
    $this->view('templates/footer', $data);
  }

  public function updateUser()
  {
    if (isset($_POST["edit_user"])) {
      if ($this->model('User_model')->updateUser($_POST) > 0) {
        header('Location: ' . BASEURL . '/admin');
        exit;
      }
    } else {
      if (!isset($_SESSION['admin'])) {
        header('Location: ' . BASEURL . '/admin/login');
        exit;
      }

      $data['title'] = 'Edit Data for Admin'; // tab title
      $data['styles'] = ['theme.css'];
      $data['scripts'] = ['search_user.js'];

      $data['user'] = $this->model('User_model')->getAllUser();

      $this->view('templates/header', $data);
      $this->view('templates/navbar_admin', $data);
      $this->view('admin/index', $data);
      $this->view('templates/footer', $data);
    }
  }

  public function deleteUser()
  {
    if (isset($_POST["del_btn"])) {
      if ($this->model('User_model')->deleteUser($_POST) > 0) {
        header('Location: ' . BASEURL . '/admin');
        exit;
      }
    } else {
      if (!isset($_SESSION['admin'])) {
        header('Location: ' . BASEURL . '/admin/login');
        exit;
      }

      $data['title'] = 'Edit Data for Admin'; // tab title
      $data['styles'] = ['theme.css'];
      $data['scripts'] = ['search_user.js'];

      $data['user'] = $this->model('User_model')->getAllUser();

      $this->view('templates/header', $data);
      $this->view('templates/navbar_admin', $data);
      $this->view('admin/index', $data);
      $this->view('templates/footer', $data);
    }
  }
}
