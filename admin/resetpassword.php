<?php

include '../src/connection.php';

if (isset($_GET['email'])) {

    
    $mail = $_GET['email'];

    if (isset($_POST['reset'])) {


        $newpass = md5($_POST['newpassword']);
        $confirmpass = md5($_POST['confirmpassword']);


        if ($newpass === $confirmpass) {

            $query = "UPDATE admin_credentials set password = '{$confirmpass}' WHERE mail = '{$mail}'";
            $result = mysqli_query($conn, $query) or die("Didnot update Password due to sql error");
            if ($result) {
                $_SESSION['success'] = '<div class="alert alert-success py-0" role="alert" style="width:100%;height:30px;border-radius:0px;">Password Changed.</div>';
            }
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger py-0" role="alert" style="width:100%;height:30px;border-radius:0px;">Password does not match.</div>';
        }
    }
} else {
    $_SESSION['errormsg'] = '<div class="alert alert-danger py-0" role="alert" style="width:100%;height:30px;border-radius:0px;">Email does not found.</div>';
}
?>

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
        #registerpage .login {
            width: 500px;
            height: 500px;
            border: 2px solid #22577E;
            border-radius: 5px;
        }

        .div .tag {
            font-size: 30px;
        }

        @media screen and (max-width:576px) {
            #registerpage .login {
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



    <section id="registerpage">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center" style="height: 100vh;background-color:#10141c;">
                    <div class="div">
                        <div class="login m-5">
                            <form action="" method="post" class="px-5 col-12 mt-5">
                                <p class="text-warning ">Reset Password</p>

                                <?php if (isset($_SESSION['msg'])) { ?>
                                    <p class="text-warning "><?php echo $_SESSION['msg']; ?></p>
                                <?php } else { ?>
                                    <p class="text-warning "></p>
                                <?php } ?>

                                <?php if (isset($_SESSION['success'])) { ?>
                                    <p class="text-warning "><?php echo $_SESSION['success']; ?></p>
                                    <a href="../admin/Adminlogin.php" class="text-white">Login</a>
                                <?php } else { ?>
                                    <p class="text-warning "></p>
                                <?php } ?>

                                <?php if (isset($_SESSION['errormsg'])) { ?>
                                    <p class="text-warning "><?php echo $_SESSION['errormsg']; ?></p>
                                <?php } else { ?>
                                    <p class="text-warning "></p>
                                <?php } ?>

                                <div class="form-outline">
                                    <label class="form-label text-white" for="typePassword">New Password</label>
                                    <input type="password" id="typePassword" class="form-control" required name="newpassword" />
                                </div>

                                <div class="form-outline mt-3">
                                    <label class="form-label text-white" for="typePassword">Confirm Password</label>
                                    <input type="password" id="typePassword" class="form-control" required name="confirmpassword" />
                                </div>

                                <br><br>
                                <button type="submit" class="btn btn-primary col-12" data-mdb-ripple-color="dark" name="reset">Update Password</button>


                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>