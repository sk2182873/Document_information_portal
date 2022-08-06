<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../picture/DIP.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../admin/css/login.css">
    <script src="https://kit.fontawesome.com/50458f73e2.js" crossorigin="anonymous"></script>
    <title>Document Information Portal</title>
    <style>
        #adminloginpage .login {
            width: 500px;
            height: 400px;
            border: 2px solid #22577E;
            border-radius: 5px;
        }

        .div .tag {
            font-size: 30px;
        }

        @media screen and (max-width:576px) {
            #adminloginpage .login {
                width: 270px;
                margin-left: auto;
                height: 400px;
                border: 2px solid #22577E;
                border-radius: 5px;
            }

            .div .tag {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php

    include '../src/connection.php';

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($pass);

        $query = "SELECT * FROM admin_credentials Where admin_name = '{$username}'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['admin_name'] == $username && $row['password'] == $password) {
                    session_start();
                    $_SESSION["adminname"] = $username;
                    $_SESSION["adminid"] = $row["admin_id"];
                    $_SESSION["mail"] = $row["mail"];
                    echo '<div class="alert alert-success">Successfully Login</div>';
                    header("Location:../admin/admindashboard.php");
                } else {
                    echo '<div class="alert alert-danger m-0">Username or password does not matched.</div>';
                    echo '<a href="../admin/forgotpassword.php" style="background-color:#10141c;width:100%;display:block;padding:15px;color:white;">Forgot Password</a>';
                }
            }
        } else {
            echo '<div class="alert alert-danger m-0">You cannot login. Please check your username and password.</div>';
        }
    }
    ?>
    <section id="adminloginpage">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center" style="height: 100vh;background-color:#10141c;">

                    <div class="div">
                        <h3 class="text-center my-5 text-white" style="font-family: Arial, Helvetica, sans-serif;"><i class="fas fa-user text-white mx-2"></i>Admin Login</h3>
                        <h5 class="text-warning tag">DOCUMENT INFORMATION PORTAL</h5><br>
                        <div class="login">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="p-5">
                                <div class="form-outline">
                                    <label class="form-label text-white" for="typeText">Username</label>
                                    <input type="text" id="typeText" class="form-control" required name="username" />
                                </div>

                                <div class="form-outline">
                                    <label class="form-label text-white" for="typePassword">Password</label>
                                    <input type="password" id="typePassword" class="form-control" required name="password" />
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary col-12" data-mdb-ripple-color="dark" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../src/app.js"></script>
</body>

</html>