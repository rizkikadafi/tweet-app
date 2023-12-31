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
    $data['cur_user'] = $data['user'];
    $data['post'] = $this->model('Post_model')->getPostByUserId($data['user']['user_id']);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    if ($postId == "") {
      foreach ($data['post'] as &$post) {
        $intervalTime = $this->model('Post_model')->formatRelativeTime($post['created_at']);
        $post['user'] = $data['user'];
        $post['cur_user_liked'] = $this->model('Post_model')->likeStatus($data['cur_user']['user_id'], $post['post_id']);
        $post['like_count'] = $this->model('Post_model')->getPostLikes($post['post_id']);
        $post['interval_time'] = $intervalTime;
      }
      $this->view('post/index', $data);
      $this->view('templates/footer', $data);
    } else {
      $data['post'] = $this->model('Post_model')->getPostById($postId);
      foreach ($data['post'] as &$post) {
        $intervalTime = $this->model('Post_model')->formatRelativeTime($post['created_at']);
        $post['user'] = $data['user'];
        $post['cur_user_liked'] = $this->model('Post_model')->likeStatus($data['cur_user']['user_id'], $post['post_id']);
        $post['like_count'] = $this->model('Post_model')->getPostLikes($post['post_id']);
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

  public function like()
  {
    $this->model('Post_model')->likePost($_POST['userId'], $_POST['postId']);

    $result = ['status' => 'oke'];
    echo json_encode($result);
  }

  public function unlike()
  {
    $this->model('Post_model')->unlikePost($_POST['postId']);

    $result = ['status' => 'oke'];
    echo json_encode($result);
  }
}
