<?php
error_reporting(E_WARNING ^ E_ALL);
include_once "../src/sidebar_nav.php" ?>
<?php

if (isset($_POST["upload"])) {
    $file = $_FILES["filename"]["name"];
    $size = $_FILES["filename"]["size"];
    $tmp = $_FILES["filename"]["tmp_name"];
    $date = $_POST["date"];
    $fileext = explode(".", $file);
    $extension = strtolower(end($fileext));

    $userid =  $_SESSION['userid'];

    if($size < 16777215){

    

    if ($date != "") {

        $extention = ["png", "pdf", "jpg", "jpeg"];
        if (in_array($extension, $extention)) {
            $folder = "C:/xamp/htdocs/DIP/externaluserdata/" . $file;

            $query2 = "INSERT INTO document_details(doc_name,doc_size,upload_date,document_path,user_id) VALUES('$file','$size','$date','$folder','$userid')";
            $result2 = mysqli_query($conn, $query2) or die("Query Failed.");

            $query = "INSERT INTO user_uploads(user_id,doc_name,doc_size,upload_date,document_path,delete_status) VALUES('$userid','$file','$size','$date','$folder','1')";
            $result = mysqli_query($conn, $query) or die("Query Failed.");
            if ($result) {
                move_uploaded_file($tmp, $folder) or die("File Not saved on Server");
                $_SESSION["filesave"] = '<p class="alert alert-success py-1 px-5" role="alert">Successfully Uploaded.</p>';
            }
        } else {
            $_SESSION["fileerrormsg"] = '<p class="alert alert-danger py-1 px-5" role="alert">File type not allowed.</p>';
        }
    } else {
        $_SESSION["fileerrormsg"] = '<p class="alert alert-danger py-1 px-5" role="alert">Please enter date.</p>';
    }
}else{
    $_SESSION["size"] = '<p class="alert alert-danger py-1 px-5" role="alert">File too large.</p>';
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
        body {
            font-family: "Ubuntu", sans-serif;
        }

        .main {
            height: 670px;
            background-color: #42C2FF;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cardsparent {
            padding: 200px;
            margin: 50px auto;
        }

        .cards {
            width: 400px;
            height: 550px;
            background-color: #fff;
            margin: 80px 0px;
            padding: 30px;
        }

        .border-radius1 {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .border-radius2 {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .cards .infobar {
            background-color: #F9F3EE;
            padding: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .cards div span {
            font-size: 18px;
            color: #064663;
        }

        .cards div i {
            color: #064663;
        }

        .circle {
            width: 50px;
            height: 50px;
            border: 1px solid #064663;
            background-color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            color: #064663;
            display: inline-block;
        }

        .cards form .title {
            width: 100%;
            height: fit-content;
            background-color: #F9F3EE;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px 5px;
            font-weight: 600;
            color: #42C2FF;
            font-size: 15px;
        }

        .cards form .icon {
            width: 100%;
            height: 150px;
            background-color: #F9F3EE;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cards form .icon i {
            font-size: 100px;
            color: #42C2FF;
        }

        .cards form .date {
            width: 100%;
            height: fit-content;
            background-color: #F9F3EE;
            text-align: center;
            display: flex;
            justify-content: space-around;
        }

        .cards form .date input {
            width: 60%;
            height: 40px;
            border: none;
            background-color: #F9F3EE;
        }

        .cards form .date input:focus {
            outline: none;
        }

        .cards form .fileselect {
            width: 100%;
            height: fit-content;
            background-color: #F9F3EE;
            padding: 20px 20px;
            text-align: center;
        }

        .cards form .fileselect label {
            display: block;
            border-radius: 10px;
            text-align: center;
            background-color: #42C2FF;
            padding: 5px 0px;
            color: #fff;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            cursor: pointer;
        }

        .cards .buttons {
            width: 100%;
            height: 50px;
            background-color: #F9F3EE;
            text-align: center;
        }

        @media screen and (max-width: 1400px) {
            .main {
                height: fit-content;
                background-color: #42C2FF;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .cards {
                height: 500px;
                background-color: #fff;
                margin-top: 20px;
                border-radius: 12px;
            }

        }

        @media screen and (max-width: 400px) {
            .main {
                height: fit-content;
                background-color: #42C2FF;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .cards {
                width: 300px;
                height: fit-content;
                background-color: #fff;
                margin-top: 20px;
                border-radius: 12px;
            }

        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12 main">
                <div class="cards border-radius1">
                    <div class="infobar">
                        <div class="circle">
                            FILE
                        </div>
                        <span style="font-size: 15px;font-weight:bold;">Only Below Files Type Allowed</span>
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="infobar">
                        <div class="circle">
                            PDF
                        </div>
                        <span>Examaple.pdf</span>
                        <i class="fas fa-check"></i>

                    </div>
                    <div class="infobar">
                        <div class="circle">
                            JPG
                        </div>
                        <span>Examaple.jpg</span>
                        <i class="fas fa-check"></i>

                    </div>
                    <div class="infobar">
                        <div class="circle">
                            JPEG
                        </div>
                        <span>Examaple.jpeg</span>
                        <i class="fas fa-check"></i>

                    </div>
                    <div class="infobar">
                        <div class="circle">
                            PNG
                        </div>
                        <span>Examaple.png</span>
                        <i class="fas fa-check"></i>

                    </div>
                </div>

                <div class="cards border-radius2">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="w-100">
                            <?php if (isset($_SESSION["filesave"])) {
                                echo  $_SESSION["filesave"];
                                unset($_SESSION["filesave"]);
                            }
                            if (isset($_SESSION["fileerrormsg"])) {
                                echo $_SESSION["fileerrormsg"];
                                unset($_SESSION["fileerrormsg"]);
                            }
                            if(isset($_SESSION["size"])){
                                echo $_SESSION["size"];
                                unset($_SESSION["size"]);
                            }
                            ?>

                        </div>
                        <div class="title">
                            <p id="title"></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="date">
                            <span>Date:</span>
                            <input type="date" name="date" required>
                        </div>
                        <div class="fileselect">
                            <span class="">Click Button To Choose File</span>
                            <label for="fileInput">Browse File</label>
                            <input type="file" id="fileInput" name="filename" hidden onchange="readInput()">
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-info px-5 mx-auto" name="upload">Upload</button>
                        </div>
                    </form>
                </div>
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

        function readInput() {
            let para = document.getElementById("title");
            let file = document.getElementById("fileInput").value;

            if (file != "") {
                para.innerHTML = file.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else {
                para.innerHTML = "Please Choose any file.";
            }
        }
    </script>
</body>

</html>