<?php

class Post extends Controller
{
  public function index($postId = "")
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Post'; // tab title
    $data['styles'] = ['theme.css'];
    $data['scripts'] = ['search_user.js'];

    $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['post'] = $this->model('Post_model')->getPostByUserId($data['user']['user_id']);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    if ($postId == "") {
      foreach ($data['post'] as &$post) {
        $intervalTime = $this->model('Post_model')->formatRelativeTime($post['created_at']);
        $post['user'] = $data['user'];
        $post['interval_time'] = $intervalTime;
      }
      $this->view('post/index', $data);
      $this->view('templates/footer', $data);
    } else {
      $data['post'] = $this->model('Post_model')->getPostById($postId);
      foreach ($data['post'] as &$post) {
        $intervalTime = $this->model('Post_model')->formatRelativeTime($post['created_at']);
        $post['user'] = $data['user'];
        $post['interval_time'] = $intervalTime;
      }
      $this->view('post/thread', $data);
    }
    $this->view('templates/footer', $data);
  }

  public function new()
  {
    if (isset($_POST["post"])) {
      if ($this->model('Post_model')->addPost($_POST) > 0) {
        header('Location: ' . BASEURL . '/home');
        exit;
      }
    } else {
      if (!isset($_SESSION['email'])) {
        header('Location: ' . BASEURL . '/authentication/login');
        exit;
      }

      $data['title'] = 'Post'; // tab title
      $data['styles'] = ['theme.css'];
      $data['scripts'] = ['search_user.js'];

      $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);

      $this->view('templates/header', $data);
      $this->view('post/new_post', $data);
      $this->view('templates/footer', $data);
    }
  }
}
