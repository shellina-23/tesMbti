<?php
session_start();
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php"); // Redirect to login if not admin
    exit();
}

include_once '../../config/database.php';
include_once '../../objects/question.php';

$database = Database::getInstance(); // Use the singleton pattern
$question = new Question($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question->question = $_POST['question'];
    $question->type = $_POST['type'];

    if ($question->create()) {
        echo "Question created successfully.";
    } else {
        echo "Unable to create question.";
    }
}
?>

<form method="POST">
    Question: <input type="text" name="question" required><br>
    Type: <input type="text" name="type" required><br>
    <button type="submit">Create Question</button>
</form>
