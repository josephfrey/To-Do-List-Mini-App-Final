<?php
include("db.php");

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$queryUsername = "SELECT * FROM users WHERE username = '$username'";
$resultUsername = mysqli_query($conn, $queryUsername);

if (mysqli_num_rows($resultUsername) > 0) {
    echo "<script>alert('Username already exists! Please choose a different username.'); window.location.href = 'index.php';</script>";
} else {
    $queryPassword = "SELECT * FROM users WHERE password = '$password'";
    $resultPassword = mysqli_query($conn, $queryPassword);

    if (mysqli_num_rows($resultPassword) > 0) {
        echo "<script>alert('Password already exists! Please choose a different password.'); window.location.href = 'index.php';</script>";
    } else {
        $sql = "INSERT INTO users (first_name, last_name, username, password) VALUES ('$first_name', '$last_name', '$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful!'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
    