<?php

class Friends extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['email'])) {
            header('Location: ' . BASEURL . '/authentication/login');
            exit;
        }

        $data['title'] = 'Friendship'; // title tab
        $data['styles'] = ['theme.css', 'friends.css'];
        $data['scripts'] = ['test.js'];

        $data['user'] = $this->model('User_model')->getUser($_SESSION['email']);
        $data['friends'] = $this->model('Friendship_model')->getMutualFriends($data['user']['user_id']);
        $data['following'] = $this->model('Friendship_model')->getFollowingUsers($data['user']['user_id']);
        $data['followed'] = $this->model('Friendship_model')->getFollowedUsers($data['user']['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('friends/index', $data);
        $this->view('templates/footer', $data);
    }
}