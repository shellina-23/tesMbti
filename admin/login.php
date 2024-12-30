<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: admin/dashboard.php");  // Redirect if already logged in
    exit();
}

include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get the database connection
    $database = Database::getInstance();
    $conn = $database->getConnection();

    // Prepare SQL statement to check if the user exists
    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists
        $user = $result->fetch_assoc();

        // Check if the password is correct
        if (password_verify($password, $user['password'])) {
            // Check if the user is an admin
            if ($user['role'] === 'admin') {
                // Create session variables for the user
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                // Redirect to admin dashboard
                header("Location: admin/dashboard.php");
                exit();
            } else {
                $error = "Access Denied. You must be an admin.";
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1
