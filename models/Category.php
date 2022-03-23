<?php
class Category {

  private $conn;
  
  // Declares category variables
  private $table = 'categories';
  public $id;
  public $category;

  // Datbase constructor
  public function __construct($db) {
    $this->conn = $db;
  }
  
  public function read() {
    
    // Creates SQL Query
    $query = 'SELECT 
    id,
    category
    From 
    ' . $this->table;
    
    // Prepares SQL query statement
    $stmt = $this->conn->prepare($query);

    // Executes SQL query
    $stmt->execute();
    
    // Returns $stmt result
    return $stmt;
  }
  
  public function read_single() {
    
    // Creates SQL Query
    $query = 'SELECT
    id,
    category
    FROM 
    ' . $this->table . '
    WHERE
    id = ?
    LIMIT 0,1';
    
    // Prepares SQL query statement
    $stmt = $this->conn->prepare($query);
    
    // Binds parameter to specified variable
    $stmt->bindParam(1, $this->id);
    
    // Binds parameter to specified variable
    $stmt->execute();
    
    // Fetch a row from a result set
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Sets properties
    $this->id = $row['id'];
    $this->category = $row['category'];
  }
    
    public function create() {
      
      // Creates SQL Query
      $query = 'INSERT INTO ' . $this->table . '
      SET
      category = :category';
      
      // Prepares SQL query statement
      $stmt = $this->conn->prepare($query);
      
      // Sanitizes the string
      $this->category = htmlspecialchars(strip_tags($this->category));
      
      // Binds parameter to specified variable
      $stmt->bindParam(':category', $this->category);
      
      // If SQL query executes returns true else returns false
      if($stmt->execute()) {
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
    
    public function update() {
      
      // Creates SQL Query
      $query = 'UPDATE ' . $this->table . '
      SET
      id = :id,
      category = :category
      WHERE id = :id';
      
      // Prepares SQL query statement
      $stmt = $this->conn->prepare($query);
      
      // Sanitizes the string
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->category = htmlspecialchars(strip_tags($this->category));
      
      // Binds parameters to specified variable
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':category', $this->category);
      
      // If SQL query executes returns true else returns false
      if($stmt->execute()) {
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
    
    public function delete() {
      
      // Creates SQL query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      
       // Prepares SQL query statement
      $stmt = $this->conn->prepare($query);
      
      // Sanitizes the string
      $this->id = htmlspecialchars(strip_tags($this->id));
      
      // Binds parameter to specified variable
      $stmt->bindParam(':id', $this->id);
      
      // If SQL query executes returns true else returns false
      if($stmt->execute()) {
        return true;
      } 
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
  }
?>