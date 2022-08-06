<?php include "../admin/sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../admin/css/setting.css">
    <link rel="stylesheet" href="../admin/css/print.css">
    <style>
        body {
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .home-section {
            background-color: #fff;
        }

        .home-section .container {
            height: 500px;
            margin-top: 10px;
        }

        .container .col-12 {
            width: 100%;
            height: 680px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }

        .container .col-12 .col-lg-10 {
            width: 80%;
            height: 700px;
            background-color: #fff;
        }

        .container .col-12 .col-lg-2 {
            width: 20%;
            height: 700px;
            background-color: #413F42;
            border-left: 2px solid gray;
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
        }
    </style>
</head>

<body>
    <!-- home section  -->
    <section class="home-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    if (isset($_GET["path"], $_GET["id"], $_GET["doc_name"])) {
                        $path = $_GET["path"];
                        $id = $_GET["id"];
                        $docname = $_GET["doc_name"];

                        $query = "SELECT * FROM admin_uploads WHERE doc_id = '$id'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);

                        $folder = $row["document_path"];

                        $filename = explode(".", $docname);
                        $fileextn = $filename[1];

                        $extension = array("pdf", "jpg", "png", "jpeg");

                        if (array_search(strtolower($fileextn), $extension)) { ?>

                            <div class="col-lg-10">
                                <img src="<?php echo $folder; ?>" class="img-fluid" alt="<?php echo $docname; ?>" title="<?php echo $docname; ?>" width="100%">
                            </div>
                            <div class="col-lg-2">
                                <div class="w-100 text-center text-light pt-4">
                                    <h5>File Details</h5>
                                </div>
                                <div class="w-100 p-3">
                                    <span class="text-light">Filename :</span>
                                    <p class="text-info"><?php echo $docname; ?></p>
                                    <span class="text-light">Size :</span>
                                    <p class="text-info"><?php echo $row["doc_size"] . " bytes"; ?></p>
                                    <span class="text-light">Date :</span>
                                    <p class="text-info"><?php echo $row["upload_date"]; ?></p>
                                </div>
                                <div class="w-100 text-center">
                                    <a href="../admin/downloadfile.php?file=<?php echo $folder; ?>" class="btn btn-success">Download</a>
                                </div>
                            </div>
                        <?php } else { ?>

                            <div class="col-lg-10 d-flex align-items-center justify-content-center py-4">
                                <a href="<?php echo $folder; ?>" id="pdflink" class="bg-primary text-white p-4">Click To Open PDF</a>
                            </div>
                            <div class="col-lg-2">
                                <div class="w-100 text-center text-light pt-4">
                                    <h5>File Details</h5>
                                </div>
                                <div class="w-100 p-3">
                                    <span class="text-light">Filename :</span>
                                    <p class="text-info"><?php echo $docname; ?></p>
                                    <span class="text-light">Size :</span>
                                    <p class="text-info"><?php echo $row["doc_size"] . " bytes"; ?></p>
                                    <span class="text-light">Date :</span>
                                    <p class="text-info"><?php echo $row["upload_date"]; ?></p>
                                </div>
                                <div class="w-100 text-center">
                                    <a href="../admin/downloadfile.php?file=<?php echo $folder; ?>" class="btn btn-success">Download</a>
                                </div>
                            </div>
                </div>
            </div>
    <?php }
                    } ?>
        </div>
        </div>
    </section>

    <?php

    mysqli_close($conn);
    ?>


    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>