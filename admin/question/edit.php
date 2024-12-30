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

    // Fetch the current question
    $result = $question->read();
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $question->question = $_POST['question'];
        $question->type = $_POST['type'];

        if ($question->update()) {
            echo "Question updated successfully.";
        } else {
            echo "Unable to update question.";
        }
    }
}
?>

<form method="POST">
    Question: <input type="text" name="question" value="<?php echo $row['question']; ?>" required><br>
    Type: <input type="text" name="type" value="<?php echo $row['type']; ?>" required><br>
    <button type="submit">Update Question</button>
</form>
