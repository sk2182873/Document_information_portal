<?php

include '../src/connection.php';

if (isset($_POST['register'])) {
    $mail = $_POST['mail'];

    $selectquery = "SELECT * FROM admin_credentials WHERE mail = '{$mail}'";
    $result = mysqli_query($conn, $selectquery) or die("Didn't get data due to query failed.");

    if (mysqli_num_rows($result) > 0) {

        $userdata = mysqli_fetch_assoc($result);
        $usermail = $userdata['mail'];
        $username = $userdata['admin_name'];

        if ($usermail == $mail) {

            $to_email = $mail;
            $subject = "Password Reset";
            $body =  "Hi! $username.  Click this link to reset your password  http://localhost/DIP/admin/resetpassword.php?email=$mail";
            $Sendermail = "FROM: ".$userdata["mail"];

            if (mail($to_email, $subject, $body, $Sendermail)) {
                $_SESSION['msg'] = '<div class="alert alert-success py-1 text-center" role="alert" style="width:100%;border-radius:0px;">Recovery Email successfully send to your Gmail Id. Please check</div>';
            } else {
                $_SESSION['msg'] = '<div class="alert alert-warning py-1 text-center" role="alert" style="width:100%;border-radius:0px;">Email does not send.</div>';
            }
        }
    }else{
        $_SESSION['errormsg'] = '<div class="alert alert-danger py-1 text-center" role="alert" style="width:100%;border-radius:0px;">Email does not exists.</div>';
    }
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
            height: 400px;
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
                            <p class="text-warning p-4">Forgot Password</p>


                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="px-5 col-12">
                                <?php if (isset($_SESSION['msg'])) { ?>
                                    <p class="text-warning "><?php echo $_SESSION['msg']; ?></p>
                                <?php } else { ?>
                                    <p class="text-warning "></p>
                                <?php } ?>
                                <?php if (isset($_SESSION['errormsg'])) { ?>
                                    <p class="text-warning "><?php echo $_SESSION['errormsg']; ?></p>
                                <?php } else { ?>
                                    <p class="text-warning "></p>
                                <?php } ?>

        
                                <div class="form-outline">
                                    <label class="form-label text-white" for="typeEmail">Email</label>
                                    <input type="email" id="typeEmail" class="form-control" name="mail" required />
                                </div>
                                <button type="submit" class="btn btn-primary col-12 my-4" data-mdb-ripple-color="dark" name="register">Submit</button>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>