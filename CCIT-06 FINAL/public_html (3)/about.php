<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>About Us</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
</head>

<body>
<body class="bg-white">
        <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-list mr-auto"></i> TO DO-LIST</h5>
                        <div class="action-icons ml-auto">
                            <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateUserModal">Profile</a>
                                <a class="dropdown-item" href="home.php">Home</a>
                                <a class="dropdown-item" href="about.php">About Us</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete your account?') ? window.location.href = 'delete_account.php?id=<?php echo $_SESSION['userid'] ?>' : false;">Delete My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">About Us</h3>
                            </div>
                            <div class="card-body text-justify">
                                <p class="card-text">
                                    A To-Do list app system is a digital tool designed to help users organize their tasks and responsibilities. It typically allows users to create a list of tasks that they need to complete, often organized in order of priority.
                                </p>
                                <p class="card-text">
                                    These apps can offer various features such as reminders, notifications, and categorization to help users manage their tasks more efficiently. Some apps provide intelligent and personalized suggestions to update your daily or weekly to-do list, helping you set yourself up for success.
                                </p>
                                <p class="card-text">
                                    As BSIT students, we are happy to have this kind of mini application to be used by some professionals and other users that have an interest in the field of technology.
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <h5 class="text-center">Developers</h5>
                                <ul class="list-unstyled text-center">
                                    <li>Joseph Frey R. Diocades <i class="fas fa-code"></i></li>
                                    <li>Angela Mae Alberto <i class="fas fa-code"></i></li>
                                    <li>Kenneth Galleniro <i class="fas fa-code"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
