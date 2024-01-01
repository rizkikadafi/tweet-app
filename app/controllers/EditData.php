<?php

class EditData extends Controller
{
  public function index($userId = "")
  {
    // if (!isset($_SESSION['email'])) {
    //   header('Location: ' . BASEURL . '/authentication/login');
    //   exit;
    // }

    $data['title'] = 'homepage admin'; // title tab
    $data['styles'] = ['theme.css', 'like.css'];
    $data['scripts'] = ['search_user.js', 'like.js'];

    $data['user_current'] = $this->model('User_model')->getUserById($userId);
    // $data['cur_user'] = $this->model('User_model')->getUser($_SESSION['email']);
    // $data['posts'] = $this->model('Post_model')->getAllPost();
    // foreach ($data['posts'] as &$post) {
    //   $intervalTime = $this->model('Post_model')->formatRelativeTime($post['updated_at']);
    //   $post['user'] = $this->model('User_model')->getUserById($post['user_id']);
    //   $post['like_count'] = $this->model('Post_model')->getPostLikes($post['post_id']);
    //   $post['cur_user_liked'] = $this->model('Post_model')->likeStatus($data['cur_user']['user_id'], $post['post_id']);
    //   $post['interval_time'] = $intervalTime;
    // }

    $this->view('templates/header', $data);
    $this->view('templates/navbar_admin', $data);
    $this->view('edit_data/index', $data);
    $this->view('templates/footer', $data);
  }


  public function user_update()
  {
    if (isset($_POST["edit_user"])) {
        if ($this->model('User_model')->updateUser($_POST) > 0) {
          header('Location: ' . BASEURL . '/homeadmin');
          exit;
        }
      } else {
        // if (!isset($_SESSION['email'])) {
        //   header('Location: ' . BASEURL . '/authentication/login');
        //   exit;
        // }
  
        $data['title'] = 'Edit Data for Admin'; // tab title
        $data['styles'] = ['theme.css'];
        $data['scripts'] = ['search_user.js'];
  
        $data['user'] = $this->model('User_model')->getAllUser();
  
        $this->view('templates/header', $data);
        $this->view('templates/navbaradmin', $data);
        $this->view('homeadmin/index', $data);
        $this->view('templates/footer', $data);
      }

  }

  public function del_user()
  {
    if (isset($_POST["del_btn"])) {
      if ($this->model('User_model')->deleteUser($_POST) > 0) {
        header('Location: ' . BASEURL . '/homeadmin');
        exit;
      }
    } else {
      // if (!isset($_SESSION['email'])) {
      //   header('Location: ' . BASEURL . '/authentication/login');
      //   exit;
      // }

      $data['title'] = 'Edit Data for Admin'; // tab title
      $data['styles'] = ['theme.css'];
      $data['scripts'] = ['search_user.js'];

      $data['user'] = $this->model('User_model')->getAllUser();

      $this->view('templates/header', $data);
      $this->view('templates/navbaradmin', $data);
      $this->view('homeadmin/index', $data);
      $this->view('templates/footer', $data);
    }
    
  }

}
