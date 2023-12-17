<?php

class User_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function addUser($data)
  {
    if ($this->isExist($data)) {
      return 0;
    } else {
      $sql = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
      $password = $this->db->escapeString($data['password']);
      $this->db->query($sql);
      $this->db->bind($data['email'], $data['username'], password_hash($password, PASSWORD_DEFAULT));

      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function isExist($data)
  {
    $sql = "SELECT * FROM user WHERE username = ?";
    $this->db->query($sql);
    $this->db->bind($data['username']);

    $result = $this->db->resultSet();

    if ($result) return $result;
    else return false;
  }

  public function auth($data)
  {
    $result = $this->isExist($data);
    $password = $this->db->escapeString($data['password']);

    if ($result) {
      if (password_verify($password, $result["password"])) {
        return 1;
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }
}
