<?php

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;

  private $dbh;
  private $stmt;

  public function __construct()
  {
    $this->dbh = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

    if ($this->dbh->connect_error) {
      die("Connection failed: " . $this->dbh->connect_error);
    }
  }

  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  public function bind(...$params)
  {
    $types = "";
    foreach ($params as $param) {
      if (is_int($param)) {
        $types = $types . 'i';
      } else if (is_float($param)) {
        $types = $types . 'd';
      } else if (is_string($param)) {
        $types = $types . 's';
      }
    }
    $this->stmt->bind_param($types, ...$params);
  }

  public function execute()
  {
    $this->stmt->execute();
  }

  public function resultSet()
  {
    $this->stmt->execute();
    $result = $this->stmt->get_result();
    return $result->fetch_assoc();
  }

  public function escapeString($str)
  {
    return $this->dbh->real_escape_string($str);
  }

  public function rowCount()
  {
    return $this->stmt->affected_rows;
  }
}

