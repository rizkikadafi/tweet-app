<?php

class Friends extends Controller
{
  public function index($username, $action = 'mutual')
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Friendship'; // title tab
    $data['styles'] = ['theme.css', 'friends.css'];
    $data['scripts'] = ['test.js'];

    $cur_user = $this->model('User_model')->getUserIdByUsername($username);
    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    
    $data['friendship_info'] = $this->model('Friendship_model')->getFriendshipInfo($cur_user['user_id']);

    $this->view('templates/header', $data);
    if($action === 'mutual') {
      $this->view('friends/index', $data);
    } else if ($action === 'following') {
      $this->view('friends/following', $data);
    } else {
      $this->view('friends/followers', $data);
    }
    $this->view('templates/footer', $data);
  }
}

