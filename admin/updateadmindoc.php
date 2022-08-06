<?php include "../admin/sidebar.php"; ?>
<?php
include "../src/connection.php";

if (isset($_GET["doc_name"])) {
    $oldname = $_GET["doc_name"];
    $_SESSION["old_doc"] = $oldname;
}

//Implementaion to Display Admin Documents Information and Update.
if (isset($_GET["id"])) {
    $docid =  $_GET["id"];
    $_SESSION["docid"] = $docid;
    $query = "SELECT * FROM admin_uploads WHERE doc_id = '$docid'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["docname"] = $row["doc_name"];
        $_SESSION["docdate"] = $row["upload_date"];
        $_SESSION["docsize"] = $row["doc_size"];
        $_SESSION["admin_role"] = "Admin";
    }

    $joinquery = "SELECT admin_name FROM admin_credentials,admin_uploads WHERE admin_credentials.admin_id = admin_uploads.admin_id";
    $queryres = mysqli_query($conn, $joinquery);
    $rows = mysqli_fetch_assoc($queryres);
    $_SESSION["tempadmin"] = $rows["admin_name"];
}

//Upload Admin Update documents details implementation. 
if (isset($_POST["update"])) {
    $docname = $_POST["docnname"];
    $rdate = $_POST["udate"];
    $docid = $_SESSION["docid"];

    $old_docname = $_SESSION["old_doc"];
    foreach (glob('../admin/userdata/*.*') as $files) {
        $onlyfilename = basename($files);
    }

    rename('../admin/userdata/' . $old_docname, '../admin/userdata/' . $docname);
    $folder = "../admin/userdata/" . $docname;



    $query = "UPDATE admin_uploads SET doc_name =  '$docname', upload_date = '$rdate', document_path = '{$folder}' WHERE doc_id = $docid";
    $result = mysqli_query($conn, $query) or die("Query Failed.");
    if ($result) {
        $_SESSION["Status"] = '<div class="alert alert-success py-1 px-5" role="alert" style="height:fit-content;" id="alertbar">SuccessFully Updated.
           <i class="bx bxs-x-circle py-1" style="font-size: 20px;" onclick="disappear_alert3();"></i>
           </div>';
    }

    header("Location:admindocuments.php");
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
                        <input type="text" class="form-control my-3" name="docnname" value="<?php if (isset($_SESSION["docname"])) {
                                                                                                echo  $_SESSION["docname"];
                                                                                                unset($_SESSION["docname"]);
                                                                                            }
                                                                                            ?>" />
                        <label class="form-label" for="typeText">Document Name</label>
                    </div>
                    <div class="form-outline">
                        <input type="email" id="typeEmail" class="form-control my-3" name="size" value="<?php if (isset($_SESSION["docsize"])) {
                                                                                                            echo $_SESSION["docsize"];
                                                                                                            unset($_SESSION["docsize"]);
                                                                                                        }
                                                                                                        ?>" disabled />
                        <label class="form-label" for="typeEmail">Size</label>
                    </div>
                    <div class="form-outline">
                        <input type="date" class="form-control my-3" name="udate" value="<?php if (isset($_SESSION["docdate"])) {
                                                                                                echo  $_SESSION["docdate"];
                                                                                                unset($_SESSION["docdate"]);
                                                                                            }
                                                                                            ?>" />
                        <label class="form-label" for="typeText">Uploaded Date</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control my-3" value="<?php if (isset($_SESSION["tempadmin"])) {
                                                                                echo $_SESSION["tempadmin"];
                                                                                unset($_SESSION["tempadmin"]);
                                                                            }
                                                                            ?>" disabled />
                        <label class="form-label" for="typeText">Uploaded By</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control my-3" value="<?php
                                                                            if (isset($_SESSION["admin_role"])) {
                                                                                echo $_SESSION["admin_role"];
                                                                                unset($_SESSION["admin_role"]);
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