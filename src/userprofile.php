<?php include_once "../src/sidebar_nav.php" ?>
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
        body {
            font-family: "Ubuntu", sans-serif;
        }

        #username {
            display: block;
            font-size: 30px;
            font-family: 'Ubuntu', sans-serif;
        }

        @media screen and (max-width: 950px) {

            .profile1 {
                text-align: center;
                margin: 0px auto;
            }
        }

        @media screen and (max-width: 700px) {

            .profile1 {
                margin: 0px auto;
            }

            #username {
                display: block;
                font-size: 30px;
            }
        }

        @media screen and (max-width: 500px) {
            .profile1 {
                text-align: left;
                margin: 0px auto;
            }

            #username {
                display: block;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row mt-3">
            <div class="w-100">
                <?php
                if (isset($_SESSION["filesuccess"])) {
                    echo  $_SESSION["filesuccess"];
                    unset($_SESSION["filesuccess"]);
                }
                if (isset($_SESSION["filetypeerror"])) {
                    echo  $_SESSION["filetypeerror"];
                    unset($_SESSION["filetypeerror"]);
                }
                ?>
            </div>
            <div class="col text-center" style="background: url('../picture/bg3.png');background-repeat:no-repeat;border-radius:10px;">
                <h1 class="ms-5 text-white" style="font-size: 40px;font-family:'Ubuntu',sans-serif;">User Profile</h1>
            </div>
        </div>
        <?php
        $userid =  $_SESSION['userid'];
        $sql = "SELECT * FROM user_credentials WHERE user_id = '$userid'";
        $result = mysqli_query($conn, $sql) or die("Failed");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profile = basename($row["user_profile"]);
                if ($profile != "") {
                    $path = "../externaluserdata/" . $profile; ?>
                    <div class="row  my-3">
                        <div class="col p-2 bg-white" style="box-shadow: 0px 5px 10px 2px rgba(45,45,45,0.5);border-radius:10px;">
                            <div class="row g-3 my-2 bg-white">
                                <div class="col-lg-3 text-center image">

                                    <img src="<?php echo $path; ?>" alt="Profile" title="Profile" width="150px" height="150px" style="border:1px solid gray;">
                                    <span class="text-dark fw-bold ms-2" id="username"><?php echo $row["user_name"]; ?></span>
                                    <a href="../src/updateprofile.php" class="btn btn-secondary mb-5 ms-2">Click to Update</a>
                                </div>
                                <div class="col-lg-3 profile1">
                                    <div>
                                        <h4 class="ps-5 text-info">Profile Details</h4>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold"><i class="fas fa-person-half-dress"></i>Gender:</h6>
                                        <span>Male</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold"><i class="fas fa-cake-candles"></i>Birth Date:</h6>
                                        <span>15 Feb, 1998</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Address:</h6>
                                        <span class="d-block">329/p-2</span>
                                        <span class="d-block">Sector-15, Rohini</span>
                                        <span class="d-block">Delhi-110085</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 profile1">
                                    <div>
                                        <h4 class="ps-5 text-info">Contact Details</h4>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Phone:</h6>
                                        <span>+91 - 9856123653</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Email:</h6>
                                        <span><?php echo $row["user_mail"]; ?></span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Social Links:</h6>
                                        <span class="d-block">Linkedin : <p class="text-primary"> https://www/linkedin.com/?id=shivak2182 </p> </span>
                                        <span class="d-block">Twitter : <p class="text-primary"> https://www/twitter.com/?id=shivak2182 </p> </span>
                                    </div>
                                </div>
                            </div>


                        <?php  } else { ?>
                            <div class="row g-3 my-2 bg-white">
                                <div class="col-lg-3 text-center image">

                                    <img src="../picture/userprofile.png" alt="Profile" title="Profile" width="150px" height="150px" style="border:1px solid gray;">
                                    <span class="text-dark fw-bold ms-2" id="username"><?php echo $row["user_name"]; ?></span>
                                    <a href="../src/updateprofile.php" class="btn btn-secondary mb-5 ms-2">Click to Update</a>
                                </div>
                                <div class="col-lg-3 profile1">
                                    <div>
                                        <h4 class="ps-5 text-info">Profile Details</h4>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold"><i class="fas fa-person-half-dress"></i>Gender:</h6>
                                        <span>Male</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold"><i class="fas fa-cake-candles"></i>Birth Date:</h6>
                                        <span>15 Feb, 1998</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Address:</h6>
                                        <span class="d-block">329/p-2</span>
                                        <span class="d-block">Sector-15, Rohini</span>
                                        <span class="d-block">Delhi-110085</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 profile1">
                                    <div>
                                        <h4 class="ps-5 text-info">Contact Details</h4>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Phone:</h6>
                                        <span>+91 - 9856123653</span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Email:</h6>
                                        <span><?php echo $row["user_mail"]; ?></span>
                                    </div>
                                    <div class="my-3 ps-5">
                                        <h6 class="text-dark fw-bold">Social Links:</h6>
                                        <span class="d-block">Linkedin : <p class="text-primary"> https://www/linkedin.com/?id=shivak2182 </p> </span>
                                        <span class="d-block">Twitter : <p class="text-primary"> https://www/twitter.com/?id=shivak2182 </p> </span>
                                    </div>
                                </div>
                            </div>
                <?php  }
                }
            } ?>
                        </div>
                    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var togglebtn = document.getElementById("menu-toggle");

        togglebtn.onclick = function() {
            el.classList.toggle("toggled");
        }
    </script>
</body>

</html>