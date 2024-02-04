<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST["taskid"];
    $user_id = $_POST["userid"];
    $updated_task = mysqli_real_escape_string($conn, $_POST["task"]);

    $queryUpdateTask = "UPDATE task_list SET task = '$updated_task' WHERE id = '$task_id' AND user_id = '$user_id'";

    if (mysqli_query($conn, $queryUpdateTask)) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
