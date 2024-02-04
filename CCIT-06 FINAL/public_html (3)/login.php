
<?php
  session_start();
  include("db.php");
  $username=$_POST['username'];
  $password=md5($_POST['password']); 

  $select=mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' ");
  $row=mysqli_fetch_assoc($select);
  $check=mysqli_num_rows($select);

  if($check > 0){
    $_SESSION['userid']=$row['id'];
    header("Location: home.php");
  }
  else{
    $_SESSION['message']="Invalid Credentials!!";
    header("Location: index.php");
  }
?>