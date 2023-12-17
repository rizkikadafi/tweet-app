<?php

class Logout extends Controller
{
  public function index()
  {
    Google_oauth::revokeToken();
    session_destroy();
    header('Location: ' . BASEURL . '/authentication/login');
  }
}
