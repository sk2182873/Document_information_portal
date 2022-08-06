<?php
include '../src/connection.php';
session_start();
if (isset($_SESSION["adminname"])) {

    $query = "SELECT admin_name,admin_profile FROM admin_credentials Where admin_name = '{$_SESSION["adminname"]}'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($_SESSION["adminname"] == $row["admin_name"]) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
                <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
                <link rel="icon" href="../picture/DIP.png">
                <title>Document Information Portal</title>
                <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
                <link rel="stylesheet" href="../admin/css/setting.css">
                <style>
                    .home-section {
                        background-color: #f5f5f5;
                        width: 100%;
                        transition: all 0.4s ease;
                        position: relative;
                        left: 0px;
                    }

                    main img {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                    }
                    #pdflink{
                        display: block;
                        border: 2px solid blue;
                        background-color: #42C2FF;
                        color: white;
                        margin: 20px 20px;
                        height: 60px;
                        line-height: 60px;
                        border-radius: 10px;
                    }

                    @media screen and (max-width: 1210px) {

                        .home-section nav {
                            width: 100%;
                            left: 0px;
                        }

                        .home-section nav .profile-details {
                            display: flex;
                            align-items: center;
                            height: 50px;
                            min-width: 50px;
                            padding: 0 15px 0 2px;
                        }
                    }

                    @media screen and (max-width: 450px) {
                        .home-section .dashboard {
                            font-size: 12px;
                        }
                    }
                </style>
            </head>

            <body>

                <section class="home-section">
                    <nav>
                        <div class="sidebar-button">
                            <span class="dashboard">Document Information Portal</span>
                        </div>
                        <div class="profile-details">
                            <img src="<?php echo "admindata/" . $row["admin_profile"]; ?>" alt="Profile">

                            <span class="admin_name text-primary">Hi! <?php echo $row['admin_name'];
                                                                    }
                                                                }
                                                            } else {
                                                                header("Location:../admin/Adminlogin.php");
                                                            }  ?></span>&nbsp;&nbsp;
                            <a href="../admin/adminlogout.php" style="font-size: 30px;color:black;" title="Logout"><i class='bx bx-log-out'></i></a>
                        </div>
                    </nav>

                    <?php
                        if(isset($_GET["path"],$_GET["doc-id"],$_GET["doc-name"])){
                            $path = $_GET["path"];
                            $id = $_GET["doc-id"];
                            $docname = $_GET["doc-name"];
                            //echo $docname;die();
                            $folder = "../externaluserdata/".$docname;
                            
                            $query = "SELECT * FROM user_uploads WHERE doc_id = '$id'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);

                            $filename = explode(".", $docname);
                            $fileextn = $filename[1];

                            $extension = array("pdf", "jpg", "png", "jpeg");

                            if(array_search(strtolower($fileextn), $extension)){ ?>

                    <main class="container-fluid bg-light">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="<?php  echo $path; ?>" style="color: red;font-size:large;">Back</a>
                            </div>
                            <div class="col-lg-2 fileinfo text-start mt-5 bg-light h-50">
                                <h5>File Details</h5>
                            File name:<p class="text-lowercase text-primary my-0"> <?php echo $row["doc_name"]; ?></p>
                            Size:<p class="text-lowercase text-primary my-0"> <?php echo $row["doc_size"]." bytes"; ?></p>
                            Upload date:<p class="text-lowercase text-primary my-0"> <?php echo $row["upload_date"];?></p>
                            </div>
                            <div class="col-lg-10 my-5">
                                <img src="<?php echo $folder; ?>"  style="width:50%;">
                            </div>
                            
                        </div>
                    </main>
                    <?php }else{ ?>

                    <main class="container">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="<?php  echo $path; ?>" style="color: red;">Back</a>
                            </div>
                            <div class="col-12 text-center">
                               <a href="<?php echo $folder; ?>" cols="30" rows="10" id="pdflink" target="blank">Click To Open PDF</a>
                            </div>
                        </div>
                    </main>
                    <?php } }?>
                </section>
            </body>

            </html>