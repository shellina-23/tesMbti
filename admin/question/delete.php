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

if (isset($_GET['id'])) {
    $question->id = $_GET['id'];

    if ($question->delete()) {
        echo "Question deleted successfully.";
    } else {
        echo "Unable to delete question.";
    }
}
?>
