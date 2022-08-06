<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link rel="stylesheet" href="../src/setting.css">
    <link rel="stylesheet" href="../src/sidebar.css">
    <style>
        #userloginpage .login {
            width: 400px;
            height: 600px;
            border-radius: 5px;
            margin: 0 auto;
            padding: 30px;
        }

        .div .tag {
            font-size: 30px;
        }

        @media screen and (max-width:576px) {
            #userloginpage .login {
                width: 270px;
                margin-left: auto;
                height: fit-content;
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
    <section id="userloginpage">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center" style="height: 100vh;background-color:#F9F9F9;">

                    <div class="div">
                        <h3 class="text-center my-2 text-secondary" style="font-family: Arial, Helvetica, sans-serif;"><i class="fas fa-user text-secondary mx-2"></i>User Login</h3>
                        <h5 class="text-secondary tag">DOCUMENT INFORMATION PORTAL</h5><br>

                        <div class="w-100 text-center">
                            <p id="loginerror" class="alert alert-danger py-2" role="alert">
                                <?php if (isset($_SESSION["loginerror"])) {
                                    echo $_SESSION["loginerror"];
                                    unset($_SESSION["loginerror"]);
                                } ?>
                            </p>
                        </div>
                        <?php

                        include "../src/connection.php";

                        if (isset($_POST['login'])) {
                            $umail = mysqli_real_escape_string($conn, $_POST['email']);
                            $password = mysqli_real_escape_string($conn, $_POST['password']);
                            $upass = md5($password);

                            $query = "SELECT * FROM user_credentials WHERE user_mail = '$umail'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                if ($row = mysqli_fetch_assoc($result)) {

                                    if ($row["user_status"] != "suspended") {

                                        if ($umail == $row["user_mail"] && $upass == $row["user_password"]) {
                                            session_start();
                                            $_SESSION['userid'] = $row["user_id"];
                                            $_SESSION['username'] = $row["user_name"];
                                            header("location:../src/userdashboard.php");
                                        } else {
                                            echo '<script>
                                                document.getElementById("loginerror").innerHTML = "Username or Password not matched.";
                                                </script>';
                                        }
                                    } else {
                                        echo '<script>
                                            document.getElementById("loginerror").innerHTML = "Your account suspended. Contact to Administrator.";
                                            </script>';
                                    }
                                }
                            } else {
                                echo '<script>
                                    document.getElementById("loginerror").innerHTML = "Email not registered.";
                                    </script>';
                            }
                        }
                        ?>
                        <div class="login">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="form2Example1" class="form-control" name="email" />
                                    <label class="form-label" for="form2Example1">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form2Example2" class="form-control" name="password" />
                                    <label class="form-label" for="form2Example2">Password</label>
                                </div>

                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                        <!-- Checkbox -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="form2Example34" checked />
                                            <label class="form-check-label" for="form2Example34"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <!-- Simple link -->
                                        <a href="../src/recovery.php">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-secondary btn-block mb-4" name="login">Sign in</button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Not a member? <a href="#!">Register</a></p>
                                    <p>or sign up with:</p>
                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>