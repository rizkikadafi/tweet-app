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
    $data['styles'] = ['theme.css', 'like.css', 'comment.css'];
    $data['scripts'] = ['search_user.js', 'like.js'];

    // $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['cur_user'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['posts'] = $this->model('Post_model')->getAllPost();
    foreach ($data['posts'] as &$post) {
      $intervalTime = $this->model('Post_model')->formatRelativeTime($post['updated_at']);
      $post['user'] = $this->model('User_model')->getUserById($post['user_id']);
      $post['like_count'] = $this->model('Post_model')->getPostLikes($post['post_id']);
      $post['cur_user_liked'] = $this->model('Post_model')->likeStatus($data['cur_user']['user_id'], $post['post_id']);
      $post['interval_time'] = $intervalTime;
    }

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer', $data);
  }
}
