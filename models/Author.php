<?php 
class Author {

    private $conn;

    // Declares author variables
    private $table = 'authors';
    public $id;
    public $author;

    // Databse construnctor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {
        
        // Creates SQL Query
        $query = 'SELECT
        id,
        author
        From
        ' . $this->table;
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Executes SQL query
        $stmt->execute();
        return $stmt;
    }
    
    public function read_single() {
        
        // Creates SQL Query
        $query = 'SELECT
        id,
        author
        From
        ' . $this->table . '
        WHERE 
        id = ?
        LIMIT 0,1';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Binds parameter to specified variable
        $stmt->bindParam(1, $this->id);
        
        // Executes SQL query
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Set properties
        $this->id = $row['id'];
        $this->author = $row['author'];
    }
    
    public function create() {
        
        // Creates SQL Query
        $query = 'INSERT INTO ' . $this->table . '
        SET
        author = :author';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);

        // Sanitizes the string
        $this->author = htmlspecialchars(strip_tags($this->author));
        
        // Binds parameter to specified variable
        $stmt->bindParam(':author', $this->author);
        
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
        author = :author
        WHERE
        id = :id';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);

        // Sanitizes the string
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->author = htmlspecialchars(strip_tags($this->author));
        
        // Binds parameters to specified variable
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author', $this->author);
        
        // If SQL query executes returns true else returns false
        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
    
    public function delete() {
        
        // Creates SQL Query
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