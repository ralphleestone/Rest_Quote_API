<?php
class Quote {
    
    private $conn;
    
    // Declares quote variables
    private $table = 'quotes';
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;
    
    // Database constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {
        
        // Creates SQL Query
        $query = 'SELECT
        q.id,
        q.quote,
        a.author,
        c.category
        From
        ' . $this->table . ' q
        LEFT JOIN authors a 
        ON
        q.authorId = a.id
        LEFT JOIN categories c
        ON
        q.categoryId = c.id';

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
        q.id,
        q.quote,
        a.author,
        c.category
        From
        ' . $this->table . ' q
        LEFT JOIN authors a 
        ON
        q.authorId = a.id
        LEFT JOIN categories c
        ON
        q.categoryId = c.id
        WHERE 
        q.id = :id';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Binds parameter to specified variable
        $stmt->bindParam(':id', $this->id);
        
        // Executes SQL query
        $stmt->execute();
        
        // Fetch a row from a result set
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Sets properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
    }
    
    public function getQuotesByAuthorID() {
        
        // Creates SQL Query
        $query = 'SELECT 
        q.id,
        q.quote,
        a.author,
        c.category
        From
        ' . $this->table . ' q
        LEFT JOIN authors a 
        ON
        q.authorId = a.id
        LEFT JOIN categories c
        ON
        q.categoryId = c.id
        WHERE 
        q.authorId = :authorId';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);

        // Binds parameter to specified variable
        $stmt->bindParam(':authorId', $this->authorId);
        
        // Executes SQL query
        $stmt->execute();    
        return $stmt;
    }
    
    public function getQuotesByCategoryId() {
        
        // Creates SQL Query
        $query = 'SELECT 
        q.id,
        q.quote,
        a.author,
        c.category
        FROM
        ' . $this->table . ' q
        LEFT JOIN authors a
        ON 
        q.authorId = a.id 
        LEFT JOIN categories c ON  
        q.categoryId = c.id
        WHERE
        q.categoryId = :categoryId';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Binds parameter to specified variable
        $stmt->bindParam(':categoryId', $this->categoryId);
        
        // Executes SQL query
        $stmt->execute();
        
        // Returns $stmt result
        return $stmt;
    }
    
    public function getQuotesByAuthorIdAndCategoryId() {
        
        // Creates SQL Query
        $query = 'SELECT 
        q.id,
        q.quote,
        a.author,
        c.category
        FROM
        ' . $this->table . ' q
        LEFT JOIN authors a 
        ON
        q.authorId = a.id
        LEFT JOIN
        categories c
        ON
        q.categoryId = c.id
        WHERE
        q.authorId = :authorId && q.categoryId = :categoryId' ;
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Binds parameters to specified variable
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        
        // Executes SQL query
        $stmt->execute();
        
        // Returns $stmt result
        return $stmt;
    }
    
    public function create() {
        
        // Creates SQL Query
        $query = 'INSERT INTO ' . 
        $this->table . '
        SET
        quote = :quote,
        authorId = :authorId,
        categoryId = :categoryId';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitizes the string
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        // Binds parameters to specified variable
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        
        // If SQL query executes returns true else returns false
        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
    
    public function update() {
        
        // Creates SQL Query
        $query = 'UPDATE ' . 
        $this->table . '
        SET
        id = :id,
        quote = :quote,
        authorId = :authorId,
        categoryId = :categoryId
        WHERE 
        id = :id';
        
        // Prepares SQL query statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitizes the string
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        // Binds parameters to specified variable
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        
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