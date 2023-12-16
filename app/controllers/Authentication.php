<?php 

class Authentication extends Controller {
  // default method
  public function index() {
    $this->register();
  }

  public function register() {
    $data['title'] = 'Register'; // tab title
    $this->view('templates/header', $data);
    $this->view('authentication/register');
    $this->view('templates/footer', $data);
  }

  public function login() {
    $data['title'] = 'Login'; // tab title
    $this->view('templates/header', $data);
    $this->view('authentication/login');
    $this->view('templates/footer', $data);
  }
}