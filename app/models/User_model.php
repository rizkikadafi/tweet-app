<?php 

class User_model {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function addUser($data) {
    $sql = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
    $this->db->query($sql);
    $this->db->bind($data['email'], $data['username'], password_hash($data['password'], PASSWORD_DEFAULT));

    $this->db->execute();

    return $this->db->rowCount();
  }
}