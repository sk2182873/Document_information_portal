<?php include "../admin/sidebar.php"; ?>
<?php
if (isset($_POST["upload"])) {
    $imagetitle = $_POST["title"];
    $adminmail = $_POST["adminmail"];
    $image = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];

    $imgsize = $_FILES["image"]["size"];
    $adminid = $_SESSION["adminname"];

    $extension = ["png", "jpg", "jpeg"];
    $img = explode(".", $image);


    $imgex = strtolower(end($img));

    if (!in_array($imgex, $extension)) {
        echo '
                <script>
                    alert("Invalid Image Extension. File type not Supported");
                </script>
            ';
    } else if ($imgsize > 1000000) {
        echo '
            <script>
                alert("File Size too long.");
            </script>
        ';
    } else {
        $query = "UPDATE admin_credentials SET admin_profile = '$image'  WHERE admin_name = '{$adminid}'";
        $result = mysqli_query($conn, $query);
        $_SESSION["refreshmsg"] = '<div class="alert alert-success py-0 px-5" role="alert"  id="alertbar" style="width:100%;height:fit-content;">Profile Successfully updated.
        <i class="bx bxs-x-circle py-1" style="font-size: 20px;" onclick="hidebar();"></i>
    </div>';

        if ($result) {
            move_uploaded_file($tempname, "C:/xamp/htdocs/DIP/admin/admindata/" . $image);
            header("Location:../admin/admin_profile.php");
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
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
            width: 400px;
            margin: 30px auto;
            padding: 0;
            height: 600px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            box-shadow: 0px 4px 4px 2px rgba(0, 0, 0, .3);
        }

        .container .outerdiv .bar {
            width: 99.9%;
            height: 40px;
            margin: 0;
            padding: 0;
        }

        .outerdiv .bar h5 {
            color: #041C32;
        }

        .container .outerdiv .left {
            position: absolute;
            height: 550px;
            margin-top: 40px;
            margin-left: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }

        .container .outerdiv .left img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            margin: 0;
            padding: 0;
        }

        .container .outerdiv .left form #imglabel {
            padding: 5px 80px;
            border: 1px dashed #069A8E;
            cursor: pointer;
            width: 300px;
            height: 40px;
            margin: 5px 0px;
        }



        @media screen and (max-width: 1210px) {
            .sidebar {
                width: 60px;
            }


            .home-section {
                width: calc(100% - 60px);
                left: 60px;
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

            .container .outerdiv .left {
                position: absolute;
                height: 550px;
                margin-left: 0px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: row;
            }

        }
    </style>
</head>

<body>
    <section class="home-section">
        <div class="w-100 back text-end"><a href="/DIP/admin/admin_profile.php" class="text-danger mx-5">Back</a></div>
        <div class="container">

            <div class="outerdiv row col-lg-12">

                <div class="bar"><a href="#" tabindex="-1" class="btn btn-secondary disabled placeholder col-12 m-0" aria-hidden="true">Update Profile</a></div>

                <div class="left col-lg-12">
                    <img src="<?php echo $_SESSION["profile"]; ?>" class="img-thumbnail" alt="Profile_Image"><br>

                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                        <div>
                            <label for="imginput" class="alert alert-success form-label my-2" id="imglabel">Choose Profile</label>
                            <input type="file" class="form-control" name="image" id="imginput" hidden required onchange="readInput()" accept=".jpg, .jpeg, .png"><br>
                            <input type="text" class="form-control my-2" name="title" id="title" value="">
                        </div>

                        <div class="form-outline">
                            <input type="text" class="form-control my-2" name="adminname" value="<?php echo $_SESSION["adminname"]; ?>" />
                            <label class="form-label" for="typeText">Name</label>
                        </div>

                        <div class="form-outline">
                            <input type="email" id="typeEmail" class="form-control my-2" name="adminmail" value="<?php echo $_SESSION["mail"]; ?>" />
                            <label class="form-label" for="typeEmail">Email input</label>
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                            <button class="btn btn-success" name="upload" type="submit">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function readInput() {

            let input = document.getElementById("imginput");
            let para = document.getElementById("title");
            if (input.value) {
                para.value = input.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                para.style.color = "blue";
            }
        }
    </script>
    <script src="../admin/script/script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
</body>

</html>