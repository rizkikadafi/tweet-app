<?php

class User_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUser($email)
  {
    $sql = "SELECT * from user WHERE email = ?";
    $this->db->query($sql);
    $this->db->bind($email);
    $result = $this->db->resultSet();
    return $result;
  }

  public function getUserByKeyword($keyword)
  {
    $sql = "SELECT * FROM user WHERE 
            username LIKE '%$keyword%' OR
            fullname LIKE '%$keyword%';";

    $this->db->query($sql);
    $result = $this->db->resultAllSet();
    return $result;
  }

  public function getUserByUsername($username)
  {
    $sql = "SELECT * FROM user WHERE username = ?";
    $this->db->query($sql);
    $this->db->bind($username);
    $result = $this->db->resultSet();
    return $result;
  }

  public function getUserById($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultSet();
    return $result;
  }

  public function getUserIdByUsername($data)
  {
    $sql = "SELECT user_id from user WHERE username = ?";
    $this->db->query($sql);
    $this->db->bind($data);
    $result = $this->db->resultSet();
    return $result;
  }

  public function addUserViaGoogle($data)
  {
    $sql = "SELECT * from user ORDER BY user_id DESC LIMIT 1";
    $this->db->query($sql);
    $result = $this->db->resultSet();
    $last_id = $result['user_id'];

    $username = $this->generateUsername($last_id);

    $sql = "INSERT INTO user (fullname, username, email, picture) VALUES (?, ?, ?, ?)";
    $this->db->query($sql);
    $this->db->bind($data['name'], $username, $data['email'], $data['picture']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function addUser($data)
  {
    if ($this->isExist($data)) {
      return 0;
    } else {
      $sql = "SELECT * from user ORDER BY user_id DESC LIMIT 1";
      $this->db->query($sql);
      $result = $this->db->resultSet();
      $last_id = $result['user_id'];

      $username = $this->generateUsername($last_id);

      $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
      $password = $this->db->escapeString($data['password']);
      $this->db->query($sql);
      $this->db->bind($username, $data['email'], password_hash($password, PASSWORD_DEFAULT));
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function isExist($data)
  {
    $sql = "SELECT * FROM user WHERE email = ?";
    $this->db->query($sql);
    $this->db->bind($data['email']);

    $result = $this->db->resultSet();

    if ($result) return $result;
    else return false;
  }

  public function authWithGoogle($data)
  {
    $result = $this->isExist($data);
    if ($result) {
      return 1;
    } else {
      return 0;
    }
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
      return -1;
    }
  }

  public function editUser($data)
  {
    $sql = "UPDATE user SET
            fullname = ?,
            username = ?,
            description = ?
            WHERE user_id = ?";
    $this->db->query($sql);
    $this->db->bind($data['fullname'], $data['username'], $data['description'], $data['id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  private function generateUsername($userId)
  {
    $randomNumber = mt_rand(1000, 9999);
    $username = "user" . $randomNumber . ($userId + 1);
    return $username;
  }
}
