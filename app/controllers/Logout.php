<?php

class Logout extends Controller
{
  public function index()
  {
    if (isset($_SESSION['token'])) {
      Google_oauth::revokeToken();
    }
    session_destroy();
    header('Location: ' . BASEURL . '/authentication/login');
  }
}
