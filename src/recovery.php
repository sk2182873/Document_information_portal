<?php
error_reporting(E_ALL ^ E_WARNING); 
include "../src/connection.php";

if (isset($_POST["verify"])) {
    $email = $_POST["mail"];
    $query = "SELECT * FROM user_credentials WHERE user_mail = '{$email}'";
    $res = mysqli_query($conn, $query) or die("Query Failed.");

    if ($res) {
        $row = mysqli_fetch_assoc($res);

            if (strtolower($email) == strtolower($row["user_mail"])) {
                $username = $row["user_name"];
                $to_email = $email;
                $subject = "Password Reset";
                $body =  "Hi! $username.  Click this link to reset your password  http://localhost/DIP/src/passwordchange.php?mail=$email";
                $Sendermail = "FROM: sk2182873@gmail.com";

                if (mail($to_email, $subject, $body, $Sendermail)) {
                    $_SESSION["mailfound"] = ' <p class="alert alert-success py-1" role="alert">Recovery Email Successfully send to your Gmail Id.<br> Please Check.</p>';
                } else {
                    $_SESSION["mailnotfound"] = ' <p class="alert alert-danger py-1" role="alert">Email not Send due to technical issue. Please try after some time.</p>';
                }
            } else {
                $_SESSION["mailnotfound"] = ' <p class="alert alert-danger py-1" role="alert">Email not registered.</p>';
            }
    }
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
                    <h4 style="color:#B9F8D3;">Recovery Password</h4>
                </div>

                <div class="box">
                    <div class="form1">
                        <h6 class="text-success fs-5">Please Enter Your Email Id.</h6>
                        <div class="w-100 p-3 text-center">
                            <?php
                            if (isset($_SESSION["mailfound"])) {
                                echo $_SESSION["mailfound"];
                                unset($_SESSION["mailfound"]);
                            }
                            if (isset($_SESSION["mailnotfound"])) {
                                echo $_SESSION["mailnotfound"];
                                unset($_SESSION["mailnotfound"]);
                            }
                            ?>
                        </div>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <div>
                                <i class="fas fa-envelope fs-5"></i>
                                <label for="email">Email</label>
                                <input type="email" name="mail" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="verify">Verify</button>
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