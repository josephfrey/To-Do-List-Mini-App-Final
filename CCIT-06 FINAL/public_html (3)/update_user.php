<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    
    $password = !empty($_POST['password']) ? md5($_POST['password']) : null;

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', username='$username'";

    if (!is_null($password)) {
        $sql .= ", password='$password'";
    }

    $sql .= " WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href = 'home.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
