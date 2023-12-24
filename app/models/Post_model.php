<?php

class Post_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addPost($data)
  {
    $sql = "INSERT INTO post (title, content, user_id) VALUES (?, ?, ?)";
    $this->db->query($sql);
    $this->db->bind($data['title'], $data['content'], $data['user_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getPostByUserId($userId)
  {
    $sql = "SELECT * FROM post WHERE user_id = ?";
    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultAllSet();
    return $result;
  }

  public function getAllPost()
  {
    $sql = "SELECT * FROM post ORDER BY created_at DESC";
    $this->db->query($sql);
    $result = $this->db->resultAllSet();
    return $result;
  }

  public function getUserIdByPostId($postId)
  {
    $sql = "SELECT user_id FROM post WHERE post_id = ?";
    $this->db->query($sql);
    $this->db->bind($postId);
    $result = $this->db->resultSet();
    return $result['user_id'];
  }
}
