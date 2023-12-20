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
}
