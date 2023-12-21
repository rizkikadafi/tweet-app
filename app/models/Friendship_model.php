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
      'following_users' => $this->getFollowingUsers($userId),
      'followed_users' => $this->getFollowedUsers($userId),
      'mutual_friends' => $this->getMutualFriends($userId),
      'following_users_count' => $this->getFollowingCount($userId),
      'followed_users_count' => $this->getFollowedCount($userId),
      'mutual_friends_count' => $this->getMutualFriends($userId),
    ];
    return $result;
  }

  // Function to get all users FOLLOWING the current user
  public function getFollowingUsers($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id IN (SELECT user_id FROM friendship WHERE friend_id = ? AND status = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING');
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get all users FOLLOWED by the current user
  public function getFollowedUsers($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id IN (SELECT friend_id FROM friendship WHERE user_id = ? AND status = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING');
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get all mutual friends
  public function getMutualFriends($userId)
  {
    $sql = "SELECT * FROM user WHERE user_id IN (
                    SELECT friend_id FROM friendship 
                    WHERE user_id = ? AND status = ? AND friend_id IN (
                        SELECT user_id FROM friendship 
                        WHERE friend_id = ? AND status = ?))";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING', $userId, 'FOLLOWING');
    $result = $this->db->resultAllSet();
    return $result;
  }

  // Function to get the number of users FOLLOWING the current user 
  public function getFollowingCount($userId)
  {
    $sql = "SELECT COUNT(*) AS following_count FROM friendship WHERE user_id = ? AND status = ?";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING');
    $result = $this->db->resultSet();
    return $result['following_count'];
  }

  // Function to get the number of users FOLLOWED by the current user
  public function getFollowedCount($userId)
  {
    $sql = "SELECT COUNT(*) AS followed_count FROM friendship WHERE friend_id = ? AND status = ?";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING');
    $result = $this->db->resultSet();
    return $result['followed_count'];
  }

  // Function to get the number of mutual friends
  public function getMutualFriendsCount($userId)
  {
    $sql = "SELECT COUNT(*) AS mutual_count
                FROM friendship 
                WHERE (user_id = ? AND status = ?) 
                AND friend_id IN (
                    SELECT user_id 
                    FROM friendship 
                    WHERE friend_id = ? AND status = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, 'FOLLOWING', $userId, 'FOLLOWING');
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

  // Function to follow another user
  public function followUser($userId, $friendId)
  {
    $sql = "INSERT INTO friendship (user_id, friend_id, status) VALUES (?, ?, ?), (?, ?, ?)";


    $this->db->query($sql);
    $this->db->bind($userId, $friendId, 'FOLLOWING', $friendId, $userId, 'FOLLOWED');
    $this->db->execute();
    return $this->db->rowCount();
  }

  // Function to unfollow another user
  public function unfollowUser($userId, $friendId)
  {
    $sql = "DELETE FROM friendship WHERE (user_id = ? AND friend_id = ? AND status = ?) OR (user_id = ? AND friend_id = ? AND status = ?)";

    $this->db->query($sql);
    $this->db->bind($userId, $friendId, 'FOLLOWING', $friendId, $userId, 'FOLLOWED');
    $this->db->execute();
    return $this->db->rowCount();
  }
}
