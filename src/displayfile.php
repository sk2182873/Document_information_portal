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
        .col-12 {
            height: fit-content;
            display: flex;
            flex-direction: row;
        }

        .col-lg-3 {
            height: 680px;
            box-shadow: 0px 5px 5px 2px rgba(45, 45, 45, 0.5);
            padding: 20px;
        }

        .col-lg-3 {
            height: 680px;
            margin-left: 0;
            background-color: #393E46;
        }

        .col-lg-3 div {
            height: fit-content;
            text-align: left;
        }

        .col-lg-3 div .file_details span {
            color: white;
            font-size: 17px;
            padding: 0;
        }

        .col-lg-3 div .file_details p {
            font-size: 15px;
            margin-top: 0px;
            padding-top: 0px;
            color: #84DFFF;
        }

        .col-lg-9 {
            height: fit-content;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .col-lg-9 img {
            width: 100%;
            box-shadow: 0px 5px 5px 2px rgba(45, 45, 45, 0.5);
        }

        @media screen and (max-width: 1150px) {
            .col-12 {
                height: fit-content;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .col-lg-3 {
                width: 50%;
                height: fit-content;
                box-shadow: 0px 5px 5px 2px rgba(45, 45, 45, 0.5);
                padding: 20px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            .col-lg-9 {
                width: 100%;
                height: fit-content;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;

            }
        }

        @media screen and (max-width: 700px) {
            .col-12 {
                height: fit-content;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .col-lg-3 {
                width: 100%;
                height: fit-content;
                box-shadow: none;
                padding: 20px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            .col-lg-3 div {
                height: fit-content;
                text-align: left;
            }

            .col-lg-3 div .file_details {
                text-align: left;
            }

            .col-lg-3 div .file_details span {
                font-size: 12px;
                padding: 0;
            }

            .col-lg-3 div .file_details p {
                font-size: 12px;
                margin-top: 0px;
                padding-top: 0px;
                color: black;
            }

            .col-lg-9 {
                width: 100%;
                height: fit-content;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
            }

            .col-lg-9 img {
                width: 100%;
                box-shadow: 0px 5px 5px 2px rgba(45, 45, 45, 0.5);
            }
        }
    </style>
</head>

<body>
    <?php
    $userid =  $_SESSION['userid'];
    if (isset($_GET["id"])) {
        $docid = $_GET["id"];

        $query2 = "SELECT * FROM user_uploads WHERE doc_id = $docid AND user_id = $userid";
        $res2 = mysqli_query($conn, $query2) or die("Query Failed.");
        if (mysqli_num_rows($res2) > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $folder = "../externaluserdata/" . $row["doc_name"];
    ?>
                <div class="container-fluid px-4">
                    <div class="row g-3 my-2">
                        <div class="col-12">
                            <?php
                            $file = $row["doc_name"];
                            $filearr = explode(".", $file);
                            $filex = $filearr[1];
                            if (strtolower($filex) != "pdf") {
                            ?>
                                <div class="col-lg-3">
                                    <div class="w-100">
                                        <div class="file_details p-4">
                                            <div class="w-100 text-light text-center fs-5">File Details</div>
                                            <span class="mt-2">Filename :</span>
                                            <p><?php echo $row["doc_name"]; ?></p>
                                            <span>Size :</span>
                                            <p><?php echo $row["doc_size"]." bytes"; ?></p>
                                            <span>Uploaded date :</span>
                                            <p><?php echo $row["upload_date"]; ?></p>
                                        </div>
                                        <div class="w-100 text-center">
                                            <a href="../src/download_file.php?file=<?php echo $row["document_path"]; ?>" class="btn btn-success">Download</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <img src="<?php echo $folder; ?>" alt="Documents">
                                </div>
                            <?php } else { ?>
                                <div class="col-12">
                                    <a href="<?php echo $folder; ?>" class="p-4 bg-secondary w-100 text-white text-center fs-5 mt-5 ms-2" target="blank">Click to Open PDF</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
    <?php }
        }
    } ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/script.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var togglebtn = document.getElementById("menu-toggle");

        togglebtn.onclick = function() {
            el.classList.toggle("toggled");
        }
    </script>

</body>

</html>