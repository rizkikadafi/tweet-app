<?php

class Friendship_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getFriendshipInfo($userId)
  {
    $result = [
      'followers' => $this->getFollowers($userId),
      'following' => $this->getFollowing($userId),
      'mutual' => $this->getMutual($userId),
      'followers_count' => $this->getFollowersCount($userId),
      'following_count' => $this->getFollowingCount($userId),
      'mutual_count' => $this->getMutualCount($userId),
    ];
    return $result;
  }

  // Function to get all users FOLLOWING the current user
  public function getFollowers($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id IN (SELECT user_id FROM friendship WHERE friend_id = ?)";

    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get all users FOLLOWED by the current user
  public function getFollowing($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id IN (SELECT friend_id FROM friendship WHERE user_id = ?)";

    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get all mutual friends
  public function getMutual($userId)
  {
    // $sql = "SELECT * FROM user WHERE user_id IN (
    //                 SELECT friend_id FROM friendship 
    //                 WHERE user_id = ? AND status = ? AND friend_id IN (
    //                     SELECT user_id FROM friendship 
    //                     WHERE friend_id = ? AND status = ?))";

    // $sql = "SELECT * FROM user WHERE user_id IN (
    // SELECT user_id FROM friendship WHERE friend_id = ? INTERSECT
    // SELECT friend_id FROM friendship WHERE user_id = ?
    // )";

    $sql = "SELECT u.*
            FROM user u
            INNER JOIN friendship f1 ON u.user_id = f1.user_id
            INNER JOIN friendship f2 ON u.user_id = f2.friend_id
            WHERE f1.friend_id = ? AND f2.user_id = ?;";

    $this->db->query($sql);
    $this->db->bind($userId, $userId);
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get the number of users FOLLOWING the current user 
  public function getFollowersCount($userId)
  {
    // $sql = "SELECT COUNT(*) AS following_count FROM friendship WHERE user_id = ? AND status = ?";
    $sql = "SELECT COUNT(*) AS followers_count FROM friendship WHERE friend_id = ?";

    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultSet();
    return $result['followers_count'];
  }

  // Function to get the number of users FOLLOWED by the current user
  public function getFollowingCount($userId)
  {
    // $sql = "SELECT COUNT(*) AS followed_count FROM friendship WHERE friend_id = ? AND status = ?";
    $sql = "SELECT COUNT(*) AS following_count FROM friendship WHERE user_id = ?";

    $this->db->query($sql);
    $this->db->bind($userId);
    $result = $this->db->resultSet();
    return $result['following_count'];
  }

  // Function to get the number of mutual friends
  public function getMutualCount($userId)
  {
    $sql = "SELECT COUNT(*) AS mutual_count
                FROM friendship 
                WHERE (user_id = ?) 
                AND friend_id IN (
                    SELECT user_id 
                    FROM friendship 
                    WHERE friend_id = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, $userId);
    $result = $this->db->resultSet();
    return $result['mutual_count'];
  }

  // Function to get other user's profile (Connected to other model?)
  public function getOtherUserProfile($userId)
  {
    // Implement the logic to fetch user profile from the database based on $userId
    // Return user profile data
  }

  // Function to get posts from users that the current user is FOLLOWING (Connected to other model?)
  public function getFollowingUserPosts($userId)
  {
    // Implement the logic to fetch posts from users that the current user is FOLLOWING
    // Sort the posts by upload time (newest at the top)
    // Return posts data
  }

  // Function to search for users by username
  public function searchUsersByUsername($username)
  {
    $sql = "SELECT * FROM user WHERE username LIKE ?";

    $this->db->query($sql);
    $this->db->bind($username);
    $result = $this->db->resultSet();
    return $result;
  }

  public function getStatus($userId, $friendId)
  {
    $sql = "SELECT * FROM friendship WHERE user_id = ? AND friend_id = ?";

    $this->db->query($sql);
    $this->db->bind($userId, $friendId);
    $result = $this->db->resultAllSet();

    if ($result) {
      return 'FOLLOWING';
    }

    return 'NOT_FOLLOWING';
  }

  // Function to follow another user
  public function followUser($userId, $friendId)
  {
    $sql = "INSERT INTO friendship (user_id, friend_id) VALUES (?, ?)";

    $this->db->query($sql);
    $this->db->bind($userId, $friendId);
    $this->db->execute();
    return $this->db->rowCount();
  }

  // Function to unfollow another user
  public function unfollowUser($userId, $friendId)
  {
    $sql = "DELETE FROM friendship WHERE (user_id = ? AND friend_id = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, $friendId);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
