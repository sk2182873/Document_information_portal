<?php
include "../src/connection.php";
session_start();

if (isset($_GET["mail"])) {

    $email = $_GET["mail"];

    if (isset($_POST["change"])) {
        $newpass = mysqli_escape_string($conn, $_POST["newpassword"]);
        $conpass = mysqli_escape_string($conn, $_POST["confirmpassword"]);

        if ($newpass == $conpass) {
            $newPassword = md5($newpass);
            $confirmPassword = md5($conpass);

            $query = "UPDATE user_credentials set user_password = '{$confirmPassword}' WHERE user_mail = '{$email}'";
            $result = mysqli_query($conn, $query) or die("Didnot update Password due to sql error");
            if ($result) {
                $_SESSION['passsuccess'] = '<p class="alert alert-success py-1" role="alert">Password Changed.</p>';
            } else {
            }
        } else {
            $_SESSION['matchmsg'] = '<p class="alert alert-danger py-1" role="alert">Password does not match.</p>';
        }
    }
} else {
    $_SESSION['emailnotfound'] = '<p class="alert alert-danger py-1" role="alert">Email does not found.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/style.css">
    <style>
        .row {
            padding: 0;
        }

        .col-12 {
            width: 100%;
            height: 100vh;
            background-color: #191A19;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .col-12 .box {
            width: 450px;
            height: 500px;
            background-color: #fff;
            box-shadow: 2px 5px 2px 2px rgba(45, 45, 45, 0.5);
        }

        .box .form1 {
            width: 100%;
            height: fit-content;
            text-align: center;
            padding: 20px 10px;
        }

        .form1 form div {
            text-align: left;
            padding: 20px 30px;
        }

        .form1 form div label {
            font-size: 18px;
        }

        .form1 form div input {
            border: 1px solid gray;
            border-radius: 5px;
            display: block;
            width: 100%;
            height: 40px;
        }

        form div input:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row g-3 my-2">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-warning">DOCUMENT INFORMATION PORTAL</h1>
                    <h4 style="color:#B9F8D3;">Update Password</h4>
                </div>

                <div class="box">
                    <div class="form1">
                        <div class="w-100 p-3 text-center">
                            <?php
                            if (isset($_SESSION['passsuccess'])) {
                                echo $_SESSION['passsuccess'];
                            }
                            if (isset($_SESSION['matchmsg'])) {
                                echo  $_SESSION['matchmsg'];
                                unset($_SESSION['matchmsg']);
                            }
                            if (isset($_SESSION['emailnotfound'])) {
                                echo $_SESSION['emailnotfound'];
                                unset($_SESSION['emailnotfound']);
                            }
                            ?>
                        </div>

                        <?php if (isset($_SESSION['passsuccess'])) { ?>
                            <div class="w-100 py-1 text-left">
                                <a href="../src/userlogin.php" class="text-primary fs-5">Login</a>
                            </div>
                        <?php
                            unset($_SESSION['passsuccess']);
                        } ?>

                        <form action="" method="post">
                            <div>
                                <label for="password">New Password</label>
                                <input type="password" name="newpassword" required>
                            </div>
                            <div>
                                <label for="password">Confirm Password</label>
                                <input type="password" name="confirmpassword" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="change">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>