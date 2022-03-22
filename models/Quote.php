<?php
class Quote {
    private $conn;
    private $table = 'quotes';
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;
    
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
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
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
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':authorId', $this->authorId);
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
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->execute();
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
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->execute();
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
        
        $stmt = $this->conn->prepare($query);
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        
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
        
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        
        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
    public function delete() {
        
        // Creates SQL Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}
?>