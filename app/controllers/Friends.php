<?php

class Friends extends Controller
{
  public function index($username = '', $action = 'mutual')
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Friendship'; // title tab
    $data['styles'] = ['theme.css', 'friends.css'];
    $data['scripts'] = ['search_user.js'];

    $data['cur_user'] = $this->model('User_model')->getUser($_SESSION['email']);
    if ($username !== '') {
      $data['user'] = $this->model('User_model')->getUserByUsername($username);
      $data['email'] = $data['user']['email'];
      $data['friendship_info'] = $this->model('Friendship_model')->getFriendshipInfo($data['user']['user_id']);
    } else {
      $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
      $data['email'] = $_SESSION['email'];
      $data['friendship_info'] = $this->model('Friendship_model')->getFriendshipInfo($data['user']['user_id']);
    }

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    if ($action === 'mutual') {
      $this->view('friends/index', $data);
    } else if ($action === 'following') {
      $this->view('friends/following', $data);
    } else {
      $this->view('friends/followers', $data);
    }
    $this->view('templates/footer', $data);
  }

  public function follow()
  {
    $this->model('Friendship_model')->followUser($_POST['userId'], $_POST['friendId']);

    // $result  = [
    //   'followers_count' => $this->model('Friendship_model')->getFollowersCount($_POST['userId']),
    //   'following_count' => $this->model('Friendship_model')->getFollowingCount($_POST['userId']),
    //   'followers_target_count' => $this->model('Friendship_model')->getFollowersCount($_POST['friendId']),
    //   'following_target_count' => $this->model('Friendship_model')->getFollowingCount($_POST['friendId']),
    // ];

    // echo json_encode($result);

    $result = ['status' => 'oke'];
    echo json_encode($result);
  }

  public function unfollow()
  {
    $this->model('Friendship_model')->unfollowUser($_POST['userId'], $_POST['friendId']);

    // $result  = [
    //   'followers_count' => $this->model('Friendship_model')->getFollowersCount($_POST['userId']),
    //   'following_count' => $this->model('Friendship_model')->getFollowingCount($_POST['userId']),
    //   'followers_target_count' => $this->model('Friendship_model')->getFollowersCount($_POST['friendId']),
    //   'following_target_count' => $this->model('Friendship_model')->getFollowingCount($_POST['friendId']),
    // ];

    // echo json_encode($result);

    $result = ['status' => 'oke'];
    echo json_encode($result);
  }
}
