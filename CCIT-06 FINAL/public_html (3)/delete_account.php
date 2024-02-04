<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting account: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method or missing user ID.";
}
?>
