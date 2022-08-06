<?php include '../admin/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../admin/css/setting.css">
    <style>
        .home-section .container {
            height: 550px;
            margin-top: 0px;
            background-color: #F9F9F9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container .adduser {
            width: 500px;
            height: 500px;
            padding: 10px;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, .5);
            background-color: #fff;
        }

        .container .adduser .alert {
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0px;
            font-style: italic;
        }

        .container .adduser .row1,
        .row2 {
            border: none;
            width: 100%;
        }

        .container .adduser .row1 label {
            border: none;
        }

        .container .adduser .btn {
            width: 100px;
            margin: 50px auto;
        }

        .container .adduser .row2 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media screen and (max-width: 1210px) {
            .sidebar {
                width: 60px;
            }

            .sidebar.active {
                width: 220px;
            }

            .home-section {
                width: calc(100% - 60px);
                left: 60px;
            }

            .sidebar.active~.home-section {
                width: calc(100% - 220px);
                left: 200px;
            }

            .home-section nav {
                width: 100%;
                left: 60px;
            }

            .home-section nav .profile-details {
                display: flex;
                align-items: center;
                height: 50px;
                min-width: 50px;
                padding: 0 15px 0 2px;
            }

            .sidebar-button .dashboard {
                display: none;
            }

            .profile-details .admin_name {
                display: none;
            }

            .logo {
                display: none;
            }

        }

        @media screen and (max-width: 450px) {

            .sidebar {
                width: 0px;
            }

            .sidebar.active {
                width: 60px;
            }

            .home-section {
                width: calc(100% - 0px);
                left: 0px;
            }

            .sidebar.active~.home-section {
                width: calc(100% - 60px);
                left: 60px;
            }
        }
    </style>
</head>

<body>
    <section class="home-section">
        <?php
        include '../src/connection.php';

        if (isset($_POST['adduser'])) {
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $date = $_POST['date'];
            $email = $_POST['email'];
            $profile = $_FILES['profile']['name'];
            $tempname = $_FILES['profile']['tmp_name'];
            $folder = "C:/xamp/htdocs/DIP/externaluserdata/" . $profile;
            $flag = 0;

            $query1 = "SELECT * FROM user_credentials";
            $res = mysqli_query($conn, $query1) or die("Query Failed");
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if (strtolower($row["user_mail"]) == strtolower($email)) {
                        $flag = 1;
                        break;
                    } else {
                        $flag = 0;
                    }
                }
                if ($flag != 1) {
                    if ($profile != "") {
                        $query = "INSERT INTO user_credentials(user_name,user_password,create_date,user_mail,user_profile,user_status) VALUES('$user','$pass','$date','$email','{$folder}','Active')";

                        $result = mysqli_query($conn, $query) or die("Query Failed");
                        if ($result) {
                            move_uploaded_file($tempname, $folder);
                            echo '<div class="alert alert-success" role="alert" style="height:fit-content;">
                                    Successfully Create.
                                </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert" style="height:fit-content;">
                                Do not Create. Please try again.
                                </div>';
                        }
                    }else{
                        $query = "INSERT INTO user_credentials(user_name,user_password,create_date,user_mail,user_status) VALUES('$user','$pass','$date','$email','Active')";

                        $result = mysqli_query($conn, $query) or die("Query Failed");
                        if ($result) {
                            echo '<div class="alert alert-success" role="alert" style="height:fit-content;">
                                    Successfully Create.
                                </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert" style="height:fit-content;">
                                Do not Create. Please try again.
                                </div>';
                        }
                    }
                } else {
                    echo '<div class="alert alert-info" role="alert" style="height:fit-content;">
                                Email already exists.
                                </div>';
                }
            }
        } ?>
        <div class="container">
            <div class="adduser card">
                <div class="alert alert-primary" role="alert">
                    Create a new user.
                </div>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                    <div class="row1">
                        <label for="user" class="form-control">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="row1">
                        <label for="pass" class="form-control">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="row1">
                        <label for="mail" class="form-control">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="row1">
                        <label for="mail" class="form-control">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="row1">
                        <label for="mail" class="form-control">Choose Profile</label>
                        <input type="file" name="profile" class="form-control">
                    </div>

                    <div class="row2">
                        <input type="submit" name="adduser" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src="../admin/script/script.js"></script>
</body>

</html>