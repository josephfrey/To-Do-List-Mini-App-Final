<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();

    if(!isset($_SESSION['userid'])) {
        header("Location: index.php"); 
        exit();
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Home Page</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 15px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            margin-top: 20px;
        }

        .list-group-scrollable {
            max-height: 75vh; 
            overflow-y: auto;
            position: relative;
            margin-top: 6px; 
            margin-left: 6px; 
            margin-right: 6px;
        }

        .list-group-scrollable:before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 12px;
            background-color: transparent;
            z-index: 1;
        }

        .list-group-scrollable::-webkit-scrollbar {
            width: 0;
        }

        .list-group-scrollable::-webkit-scrollbar-thumb {
            width: 0;
            height: 0;
            background-color: transparent;
        }

        .list-group-item {
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .full-width-textarea {
            width: 100%;
        }
    </style>
</head>

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
        <div class="form-group m-2">
            <input type="text" id="searchInput" class="form-control" onkeyup="filterTasks()" placeholder="Search...">
          </div>
        <?php
        include("db.php");
        $user_id = $_SESSION['userid'];
        $queryFetchTasks = "SELECT id, task FROM task_list WHERE user_id = '$user_id'";
        $resultFetchTasks = mysqli_query($conn, $queryFetchTasks);

        if (mysqli_num_rows($resultFetchTasks) > 0) {
            echo '<ul class="list-group list-group-scrollable">';

            while ($row = mysqli_fetch_assoc($resultFetchTasks)) {
                echo '<li class="list-group-item border">
                    <div style="height: 28px; width: 92%; overflow: hidden; float: left;" data-toggle="modal" data-target="#updateTaskModal'.$row['id'].'">
                        <b>' . htmlspecialchars($row['task']) . '</b>
                    </div>
                    <a onclick="return confirm(\'Are you sure you want to delete this task?\') ? window.location.href = \'delete_task.php?id='.$row['id'].'\' : false;">
                        <i style="float: right;" class="fas fa-trash text-danger"></i>
                    </a>
                </li>';
        
                echo '<div class="modal fade" id="updateTaskModal'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="updateTask" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateTask"><i class="fas fa-list"></i> Update List</h5><br>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="task_update.php" method="POST">
                                        <div class="form-group">
                                            <input type="hidden" name="userid" value="'.$user_id.'">
                                            <input type="hidden" name="taskid" value="'.$row['id'].'">
                                            <textarea style="width: 100%;" rows="18" name="task" placeholder="Task..." autocomplete="off" required>'
                                            . htmlspecialchars($row['task']) .
                                            '</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
            }

            echo '</ul>';
        } 
        ?>

        <div class="fixed-bottom w-100 text-center mb-2">
            <button class="btn btn-primary" style="border-radius: 50%;" type="button"  data-toggle="modal" data-target="#addTaskModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        
    </div>
    <script>
            function filterTasks() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                ul = document.querySelector(".list-group-scrollable");
                li = ul.getElementsByTagName("li");

                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("b")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
          </script>
    <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel"><i class="fas fa-user"></i> Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update_user.php" method="POST">
                        <?php
                        include("db.php");

                        $user_id = $_SESSION['userid'];
                        $query = "SELECT * FROM users WHERE id = '$user_id'";
                        $result = mysqli_query($conn, $query);

                        if ($row = mysqli_fetch_assoc($result)) {
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $username = $row['username'];
                        }
                        ?>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="<?php echo $first_name; ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="<?php echo $last_name; ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="*****" autocomplete="off">
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-user-plus"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="AddTask" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddTask"><i class="fas fa-list"></i> New List</h5><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="task_submit.php" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <textarea style="width: 100%;" rows="18" name="task" placeholder="Task..." autocomplete="off" required></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
</body>

</html>
