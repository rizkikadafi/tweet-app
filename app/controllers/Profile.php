<?php

class Profile extends Controller
{
  public function index($username = '')
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Profile'; // title tab
    $data['styles'] = ['theme.css'];
    $data['scripts'] = ['follow.js', 'search_user.js'];

    $data['cur_user'] = $this->model('User_model')->getUser($_SESSION['email']);
    if ($username !== '') {
      $data['user'] = $this->model('User_model')->getUserByUsername($username);
      $data['status'] = $this->model('Friendship_model')->getStatus($data['cur_user']['user_id'], $data['user']['user_id']);
      $data['email'] = $data['user']['email'];
      $data['friendship_info'] = $this->model('Friendship_model')->getFriendshipInfo($data['user']['user_id']);
    } else {
      $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
      $data['email'] = $_SESSION['email'];
      $data['friendship_info'] = $this->model('Friendship_model')->getFriendshipInfo($data['user']['user_id']);
    }

    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer', $data);
  }

  public function edit()
  {
    $this->model('User_model')->editUser($_POST);
    header('Location: ' . BASEURL . '/profile');
    exit;
  }

  public function other($email)
  {
    if (!isset($_SESSION['email'])) {
      header('Location: ' . BASEURL . '/authentication/login');
      exit;
    }

    $data['title'] = 'Profile'; // title tab
    $data['styles'] = ['theme.css'];

    $data['curUser'] = $this->model('User_model')->getUser($_SESSION['email']);
    $data['user'] = $this->model('User_model')->getUser($email);
    $data['email'] = $email;

    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer', $data);
  }

  public function search()
  {
    $data = $this->model('User_model')->getUserByKeyword($_POST['keyword']);

    foreach ($data as $user) {
      echo '
        <li class="list-group-item">
          <div class="user">
            <div class="row align-items-center">
              <div class="col-1 me-3">
                <img class="rounded-circle" width="40" height="40" src="' . ($user['picture'] ?? BASEURL . "/img/profile.jpeg") . '">
              </div>
              <div class="col">
                <span class="d-block text-white fw-bold">' . ($user['fullname'] ?? $user['username']) . '</span>
                <a href="' . BASEURL . "/profile/" . $user['username'] . '" class="link-underline link-underline-opacity-0 text-secondary">@' . $user['username'] . '</a>
              </div>
            </div>
          </div>
        </li>
      ';
    }
  }
}
