<?php include "../admin/sidebar.php"; ?>
<?php

//Implementaion to Display User Documents Information and Update.
if (isset($_GET["doc-id"], $_GET["doc-name"])) {
    $docid3 = $_GET["doc-id"];
    $docname3 = $_GET["doc-name"];
    $_SESSION["olduserdoc"] = $docname3;
    $_SESSION["docid"] = $docid3;
    

    $query = "SELECT * FROM user_uploads WHERE doc_id = '$docid3'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["docname2"] = $row["doc_name"];
        $_SESSION["docdate2"] = $row["upload_date"];
        $_SESSION["docsize2"] = $row["doc_size"];
        $_SESSION["uploadby2"] = $row["user_id"];
        $_SESSION["user_role"] = "User";
    }

    $joinquery = "SELECT user_name FROM user_credentials,user_uploads WHERE user_credentials.user_id = user_uploads.user_id";
    $queryres2 = mysqli_query($conn, $joinquery);
    $rows3 = mysqli_fetch_assoc($queryres2);
    $_SESSION["tempuser"] = $rows3["user_name"];
}

//Upload User Update documents details implementation. 
$old_docname = $_SESSION["olduserdoc"];
$docid = $_SESSION["docid"];
if (isset($_POST["update"])) {
    $docname = $_POST["docnname"];
    $rdate = $_POST["udate"];
    

    foreach (glob('../DIP/externaluserdata/*.*') as $files) {
        $onlyfilename = basename($files);
    }

    rename('C:/xamp/htdocs/DIP/externaluserdata/' . $old_docname, 'C:/xamp/htdocs/DIP/externaluserdata/' . $docname);
    $folder = "C:/xamp/htdocs/DIP/externaluserdata/" . $docname;



    $query = "UPDATE user_uploads SET doc_name =  '$docname', upload_date = '$rdate', document_path = '{$folder}' WHERE doc_id = $docid";
    $result = mysqli_query($conn, $query) or die("Query Failed.");
    if ($result) {
        $_SESSION["Status1"] = '<div class="alert alert-success py-1 px-5" role="alert" style="height:fit-content;" id="alertbar">SuccessFully Updated.
           <i class="bx bxs-x-circle py-1" style="font-size: 20px;" onclick="disappear_alert3();"></i>
           </div>';
    }

    header("Location:/DIP/admin/userdocuments.php");
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
            margin: 10px auto;
            padding: 0;
            height: 500px;
            display: flex;
            flex-direction: row;
            box-shadow: 0px 4px 4px 2px rgba(0, 0, 0, .3);
        }

        .container .outerdiv .bar {
            width: 99.9%;
            height: 40px;
            margin-top: 30px;
            padding: 0;
            text-align: center;
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
        }
    </style>
</head>

<body>
    <section class="home-section">

        <div class="container">

            <div class="outerdiv row">

                <div class="col-12 bar">
                    <h5>Update</h5>
                    <h6>User Wise Document Details</h6>
                </div>

                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                    <div class="form-outline">
                        <input type="text" class="form-control my-3" name="docnname" value="<?php if (isset($_SESSION["docname2"])) {
                                                                                                echo $_SESSION["docname2"];
                                                                                                unset($_SESSION["docname2"]);
                                                                                            }
                                                                                            ?>" />
                        <label class="form-label" for="typeText">Document Name</label>
                    </div>
                    <div class="form-outline">
                        <input type="email" id="typeEmail" class="form-control my-3" name="size" value="<?php if (isset($_SESSION["docsize2"])) {
                                                                                                            echo $_SESSION["docsize2"];
                                                                                                            unset($_SESSION["docsize2"]);
                                                                                                        }
                                                                                                        ?>" disabled />
                        <label class="form-label" for="typeEmail">Size</label>
                    </div>
                    <div class="form-outline">
                        <input type="date" class="form-control my-3" name="udate" value="<?php if (isset($_SESSION["docdate2"])) {
                                                                                                echo $_SESSION["docdate2"];
                                                                                                unset($_SESSION["docdate2"]);
                                                                                            }
                                                                                            ?>" />
                        <label class="form-label" for="typeText">Uploaded Date</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control my-3" value="<?php if (isset($_SESSION["tempuser"])) {
                                                                                echo $_SESSION["tempuser"];
                                                                                unset($_SESSION["tempuser"]);
                                                                            }
                                                                            ?>" disabled />
                        <label class="form-label" for="typeText">Uploaded By</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control my-3" value="<?php
                                                                            if (isset($_SESSION["user_role"])) {
                                                                                echo $_SESSION["user_role"];
                                                                                unset($_SESSION["user_role"]);
                                                                            } ?>" disabled />
                        <label class="form-label" for="typeText">Role</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-success" name="update" type="submit" id="update">Update</button>
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

<!-- 







 -->