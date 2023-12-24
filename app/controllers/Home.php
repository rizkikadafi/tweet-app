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
    $data['scripts'] = ['search_user.js'];

    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['posts'] = $this->model('Post_model')->getAllPost();
    foreach ($data['posts'] as &$post) {
      $userId = $post['user_id'];
      $userInfo = $this->model('User_model')->getUserById($userId);
      $post['user'] = $userInfo;
    }

    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer', $data);
  }
}
