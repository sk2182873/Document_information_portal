<?php include "../admin/sidebar.php"; ?>
<?php

include "../src/connection.php";
$query = "SELECT * FROM admin_credentials WHERE admin_name = '{$_SESSION["adminname"]}'";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["mail"] = $row["mail"];
    $_SESSION["date"] = $row["date"];
    $_SESSION["password"] = $row["password"];
    $_SESSION["profile"] = "../admin/admindata/".$row["admin_profile"];
}
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
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
        .home-section {
            background-color: #fff;
        }

        .home-section .container {
            width: 100%;
            display: flex;
            justify-content: center;
            height: 90vh;
            margin: 0 auto;
            padding: 0;
        }

        .home-section .container .outerdiv {
            width: 70%;
            margin: 30px auto;
            padding: 0;
            height: fit-content;
            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: center;
            box-shadow: 0px 4px 4px 2px rgba(0, 0, 0, .3);
        }

        .container .outerdiv .left,
        .right {
            height: 500px;
            box-sizing: border-box;
        }

        .container .outerdiv .left {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: linear-gradient(to right, #2b48ff 60%, white 0%);
            border: 10px solid #2b48ff;
            border-right: none;
        }

        .container .outerdiv .left img {
            width: 360px;
            height: 360px;
            border-radius: 50%;
            border: 10px solid #2b48ff;
        }

        .container .outerdiv .left a {
            width: 360px;
            background-color: #D9D7F1;
            text-align: center;
            color: green;
            font-size: 20px;
        }

        .container .outerdiv .right {
            background-color: #fff;
            display: flex;
            align-items: left;
            justify-content: center;
            flex-direction: column;
            border: 10px solid #2b48ff;
            border-left: none;
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

            .home-section .container {
                height: fit-content;
                display: flex;
                align-items: center;
            }

            .home-section .container .outerdiv {
                width: 100%;
                height: fit-content;
                margin: 0px 10px;
                border-radius: 12px;
            }

            .container .outerdiv .left img {
                width: 300px;
                border-radius: 50%;
                border: 5px solid white;
            }

            .container .outerdiv .left {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background: #2b48ff;
                height: 400px;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
                padding: 20px;
                border: 10px solid #2b48ff;
            }

            .container .outerdiv .right {
                padding: 20px;
                background-color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                height: 400px;
                border: 10px solid #2b48ff;
            }

            .container .outerdiv .right .contact {
                font-size: 25px;
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

            .home-section .container {
                height: 80vh;
                display: flex;
                align-items: center;
            }

            .home-section .container .outerdiv {
                width: 100%;
                height: fit-content;
                margin: 30px 10px;
                border-radius: 12px;
            }

            .container .outerdiv .left img {
                width: 200px;
                border-radius: 50%;
                border: 5px solid white;
            }

            .container .outerdiv .left {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background: #2b48ff;
                height: 250px;
                padding: 20px;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
                border: 10px solid #2b48ff;
            }

            .container .outerdiv .right {
                padding: 20px;
                background-color: #fff;
                display: flex;
                justify-content: right;
                align-items: center;
                flex-direction: column;
                height: 250px;
                border: 10px solid #2b48ff;
            }

            .container .outerdiv .right .contact {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <section class="home-section">
    <?php
        if (isset($_SESSION["refreshmsg"])) {
            echo $_SESSION["refreshmsg"];
            unset($_SESSION["refreshmsg"]);
        }
        ?>
        <div class="container">
        
            <div class="outerdiv row">
                <div class="left col-lg-6">
                    <img src="<?php echo $_SESSION["profile"]; ?>" alt="Profile_Image">
                </div>

                <div class="right col-lg-6">
                    <div class="name text-dark">
                        <h1><?php echo $_SESSION["adminname"]; ?></h1>
                    </div>
                    <div class="contact">
                        <i class="fas fa-envelope"></i><span class="text-primary"> <?php echo  $_SESSION["mail"]; ?></span>
                    </div>
                    <div class="contact">
                        <span>Role : <span class="text-primary">Admin</span></span>
                    </div>
                    <div class="contact">
                        <span>Registered Date : <span class="text-primary"><?php echo  $_SESSION["date"]; ?> </span></span>
                    </div>
                    <div class="contact">
                        <span>Update Image : <a href='../admin/updateimage.php'>Click here</a></span>
                    </div>
                    <div class="contact">
                        <span>Change Password : <a href="../admin/forgotpassword.php">Click here</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function hidebar(){
            let status = document.getElementById("alertbar");
            status.style.display = "none";
        }
    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>