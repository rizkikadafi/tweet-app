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

  public function getPostById($postId)
  {
    $sql = "SELECT * FROM post WHERE post_id = ?";
    $this->db->query($sql);
    $this->db->bind($postId);
    $result = $this->db->resultAllSet();
    return $result;
  }

  public function getPostByUserId($userId)
  {
    $sql = "SELECT * FROM post WHERE user_id = ? ORDER BY created_at DESC";
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

  public function formatRelativeTime($timestamp)
  {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestampDateTime = new DateTime($timestamp, new DateTimeZone('Asia/Jakarta'));
    $timeDifference = $currentDateTime->diff($timestampDateTime);

    if ($timeDifference->y > 0) {
      return $timeDifference->y . ' year' . ($timeDifference->y > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference->m > 0) {
      return $timeDifference->m . ' month' . ($timeDifference->m > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference->d > 0) {
      return $timeDifference->d . ' day' . ($timeDifference->d > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference->h > 0) {
      return $timeDifference->h . ' hour' . ($timeDifference->h > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference->i > 0) {
      return $timeDifference->i . ' minute' . ($timeDifference->i > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference->s >= 0) {
      return 'now';
    } else {
      return 'unknown'; // Menangani jika waktu di masa depan
    }
  }

  public function getUserIdByPostId($postId)
  {
    $sql = "SELECT user_id FROM post WHERE post_id = ?";
    $this->db->query($sql);
    $this->db->bind($postId);
    $result = $this->db->resultSet();
    return $result['user_id'];
  }

  public function getPostLikes($postId)
  {
    $sql = "SELECT COUNT(*) AS like_count
            FROM likes WHERE post_id = ?;";

    $this->db->query($sql);
    $this->db->bind($postId);
    $result = $this->db->resultSet();
    return $result['like_count'];
  }

  public function likeStatus($userId, $postId)
  {
    $sql = "SELECT COUNT(*) AS like_count FROM likes WHERE user_id = ? AND post_id = ?";
    $this->db->query($sql);
    $this->db->bind($userId, $postId);
    $result = $this->db->resultSet();
    if ($result['like_count'] > 0) {
      return true;
    }
    return false;
  }

  public function likePost($userId, $postId)
  {
    $sql = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
    $this->db->query($sql);
    $this->db->bind($userId, $postId);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function unlikePost($postId)
  {
    $sql = "DELETE FROM likes WHERE post_id = ?";
    $this->db->query($sql);
    $this->db->bind($postId);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
