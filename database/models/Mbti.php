<?php

class Mbti
{
    private $conn;
    private $table_name = "mbti";

    public $mbtiId;
    public $e;
    public $i;
    public $s;
    public $n;
    public $t;
    public $f;
    public $j;
    public $p;
    public $userId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOneByUser($userId) {
        // Prepare the SQL query with a placeholder
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->conn->error));
        }
    
        // Bind the parameter using bind_param
        $stmt->bind_param("i", $userId);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result and fetch as an associative array
        $result = $stmt->get_result()->fetch_assoc();
    
        // Close the statement
        $stmt->close();
    
        return $result;
    }
    

    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE mbtiId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->mbtiId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function create() {
        // Define the SQL query with placeholders
        $query = "INSERT INTO " . $this->table_name . " (e, i, s, n, t, f, j, p, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->conn->error));
        }
    
        // Bind all parameters in a single bind_param call
        $stmt->bind_param("iiiiiiiii", $this->e, $this->i, $this->s, $this->n, $this->t, $this->f, $this->j, $this->p, $this->userId);
    
        // Execute the statement
        if($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    

}