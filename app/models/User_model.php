<?php

use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;

class User_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllUser()
  {
    $sql = "SELECT * FROM user ORDER BY email ASC";
    $this->db->query($sql);
    $result = $this->db->resultAllSet();
    return $result;
  }

  public function getUser($email)
  {
    $sql = "SELECT * FROM user WHERE email = ?";
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

  public function updateUser($data)
  {
    $sql = "UPDATE user SET email = ?, password = ? WHERE user_id = ?";
    $passHash = password_hash($data['inpPassword'], PASSWORD_DEFAULT);
    $this->db->query($sql);
    $this->db->bind($data['inpEmail'], $passHash, $data['user_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteUser($data)
  {
    $sql = "DELETE FROM user WHERE user_id = ?";
    $this->db->query($sql);
    $this->db->bind($data['id_user']);
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

      $sql = "INSERT INTO user (username, email, password, picture) VALUES (?, ?, ?, ?)";
      $password = $this->db->escapeString($data['password']);
      $this->db->query($sql);
      $this->db->bind($username, $data['email'], password_hash($password, PASSWORD_DEFAULT), "https://res.cloudinary.com/dk0kmgvb7/image/upload/v1704043566/profile_thumbnail.jpg");
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
        if ($data['val1'] + $data['val2'] != $data['captcha']) {
          return -2;
        }
        return 1;
      } else {
        return 0;
      }
    } else {
      return -1;
    }
  }

  public function uploadProfilePicture($file)
  {
    if (isset($file['profile-img'])) {

      $file = $file['profile-img'];
      $config = Configuration::instance([
        'cloud' => [
          'cloud_name' => IMAGE_HOST_CLOUD_NAME,
          'api_key' => IMAGE_HOST_API_KEY,
          'api_secret' => IMAGE_HOST_API_SECRET
        ],
        'url' => [
          'secure' => true
        ]
      ]);

      $cloudinary = new Cloudinary($config);

      $result = $cloudinary->uploadApi()->upload($file['tmp_name'], ['public_id' => $file['name']]);
      return $result;
    }
  }

  public function editUser($data, $file)
  {
    if ($file['profile-img']['name']) {
      $result = $this->uploadProfilePicture($file);
    } else {
      $result['secure_url'] = $this->getUserById($data['id'])['picture'];
    }

    $sql = "UPDATE user SET
            fullname = ?,
            username = ?,
            description = ?,
            picture = ?
            WHERE user_id = ?";

    $this->db->query($sql);
    $this->db->bind($data['fullname'], $data['username'], $data['description'], $result['secure_url'], $data['id']);
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
