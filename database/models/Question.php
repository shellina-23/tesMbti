<?php

class question{
    private $conn;
    private $table_name = "question";

    public $id;
    public $question;
    public $type;

    public function __construct($db) {
        $this->conn = $db->getConnection();  // Use the getConnection method of Database
    }

    // Create question
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (question, type) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("ss", $this->question, $this->type); // "ss" means two strings
        
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all questions
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);

        return $result;
    }

    // Update question
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET question = ?, type = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssi", $this->question, $this->type, $this->id); // "ssi" means two strings and one integer
        
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete question
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bind_param("i", $this->id); // "i" means integer
        
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}