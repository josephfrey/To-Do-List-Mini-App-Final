<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $task = mysqli_real_escape_string($conn, $_POST["task"]);
    $queryCheckTask = "SELECT * FROM task_list WHERE user_id = '$user_id' AND task = '$task'";
    $resultCheckTask = mysqli_query($conn, $queryCheckTask);

    $queryInsertTask = "INSERT INTO task_list (user_id, task) VALUES ('$user_id', '$task')";

    if (mysqli_query($conn, $queryInsertTask)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
