<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $sql = "DELETE FROM task_list WHERE id='$task_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}
?>
