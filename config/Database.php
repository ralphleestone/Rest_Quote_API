<?php

class Database {
  public function connect() {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    
    // Sets hostname
    $hostname = $dbparts['host'];
    // Sets username
    $username = $dbparts['user'];
    // Sets password
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
    try {
      $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    return $this->conn;
  }
}
?>