<?php

class User{
    private $conn;
    private $table_name = "user";

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
        $query = "INSERT INTO " . $this->table_name . " ( `name`, `email`, `password`) VALUES ('$this->name','$this->email','$this->password')";
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function login() {
        // Define the query with placeholders
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? AND password = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->conn->error));
        }
        
        // Bind the parameters (s = string, s = string for email and password)
        $stmt->bind_param("ss", $this->email, $this->password);
    
        // Execute the statement
        $stmt->execute();
    
        // Fetch the result
        $result = $stmt->get_result()->fetch_assoc();
    
        // Close the statement
        $stmt->close();
    
        return $result;
    }
    
    
}