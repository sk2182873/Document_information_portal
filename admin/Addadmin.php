<?php include '../admin/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../admin/css/setting.css">
    <style>
        .home-section .container {
            height: 550px;
            margin-top: 30px;
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
                $folder = "C:/xamp/htdocs/DIP/admin/admindata/" . $profile;

                $query = "INSERT INTO admin_credentials(admin_name,password,date,mail,admin_profile) VALUES('$user','$pass','$date','$email','{$profile}')";

                $result = mysqli_query($conn, $query) or die("Query Failed");
                if ($result) {
                    move_uploaded_file($tempname, $folder);
                    echo '<div class="alert alert-success py-0 px-5 m-0" role="alert" style="height:30px;">
                            Admin Successfully Created.
                        </div>';
                } else {
                    echo '<div class="alert alert-danger py-0 px-5 m-0" role="alert" style="height:30px;">
                        Do not Create. Please try again.
                        </div>';
                }
            } ?>
        <div class="container">
            
            <div class="adduser card">
                <div class="alert alert-info" role="alert">
                    Create a new admin.
                </div>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                    <div class="row1">
                        <label for="user" class="form-control">Admin name</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="row1">
                        <label for="user" class="form-control">Choose Image</label>
                        <input type="file" name="profile" class="form-control" required>
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

                    <div class="row2">
                        <input type="submit" name="adduser" class="btn btn-secondary form-control">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>