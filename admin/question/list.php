<?php
session_start();
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php"); // Redirect to login if not admin
    exit();
}

include_once '../../database/Database.php';
include_once '../../database/Question.php';

$database = Database::getInstance(); // Use the singleton pattern
$question = new Question($database);

$result = $question->read();
?>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['question']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
