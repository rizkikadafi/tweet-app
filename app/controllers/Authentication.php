<?php 

class Authentication extends Controller {
  // default method
  public function index() {
    $this->login();
  }

  public function register() {
    $data['title'] = 'Register'; // tab title
    $data['styles'] = ['register.css']; // css
    $this->view('templates/header', $data);
    $this->view('authentication/register');
    $this->view('templates/footer', $data);
  }

  public function login() {
    $this->view('authentication/login');
  }
}