<?php

class Logout extends Controller
{
  public function index()
  {
    if (isset($_SESSION['token'])) {
      Google_oauth::revokeToken();
    }

    if (isset($_SESSION['admin'])) {
      $keepAdminSession = $_SESSION['admin'];
    }
    session_destroy();
    session_start();
    $_SESSION['admin'] = $keepAdminSession;
    header('Location: ' . BASEURL . '/authentication/login');
    exit;
  }

  public function admin()
  {
    unset($_SESSION['admin']);
    header('Location: ' . BASEURL . '/admin/login');
    exit;
  }
}
