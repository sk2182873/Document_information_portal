<?php include_once "../src/sidebar_nav.php" ?>
<?php
if (isset($_GET["id"])) {
    $docid =  $_GET["id"];
    $oldname = $_GET["docname"];
    $userid =   $_SESSION['userid'];


    if (isset($_POST["update"])) {
        $docname = $_POST["filename"];
        $date = $_POST["date"];

        $folder = "C:/xamp/htdocs/DIP/externaluserdata/" . $oldname;
        $folder2 = "C:/xamp/htdocs/DIP/externaluserdata/" . $docname;

        rename($folder, $folder2);

        $query2 = "UPDATE user_uploads SET doc_name = '{$docname}', upload_date = '{$date}', document_path = '{$folder2}' WHERE doc_id = $docid AND user_id = $userid";
        $res = mysqli_query($conn, $query2) or die("Query Failed.");

        if ($res) {
            $_SESSION["updatesuccess"] = '<p class="alert alert-success py-1 px-5" role="alert">Successfully Updated.</p>';
            header("Location:../src/userdocview.php");
        } else {
            $_SESSION["updateerror"] = '<p class="alert alert-danger py-1 px-5" role="alert">Not Updated.</p>';
            header("Location:../src/userdocview.php");
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/style.css">
    <style>
        .outerdiv {
            width: 400px;
            height: 500px;
            margin: 20px auto;
            background-color: #fff;
            text-align: left;
            padding: 25px;
            border-radius: 12px;
        }

        .outerdiv h6 {
            margin-top: 10px;
            color: #064663;
        }

        .bar {
            max-width: 100%;
            height: fit-content;
            background-color: #6886C5;
            color: #fff;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row g-3 my-2">

            <div class="outerdiv">
                <div class="bar">
                    <h5>Update</h5>
                </div>

                <?php
                $userid  =  $_SESSION['userid'];

                if (isset($_GET["id"])) {
                    $docid = $_GET["id"];
                    $_SESSION["docid"] = $docid;

                    $query = "SELECT * FROM user_uploads WHERE doc_id = '$docid' AND user_id = '$userid'";
                    $res = mysqli_query($conn, $query) or die("Query Failed.");
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $_SESSION["olddocname"] = $row["doc_name"];  ?>
                            <h6>User Wise Document Details</h6>
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="mb-1">
                                    <label for="typeText" class="form-label">Document Name</label>
                                    <input type="text" class="form-control" name="filename" value="<?php echo $row["doc_name"]; ?>">
                                </div>

                                <div class="mb-1">
                                    <label for="typeText" class="form-label">Size</label>
                                    <input type="text" class="form-control" name="size" value="<?php echo $row["doc_size"]; ?>" disabled>
                                </div>

                                <div class="mb-1">
                                    <label for="typeText" class="form-label">Uploaded Date</label>
                                    <input type="date" class="form-control" name="date" value="<?php echo $row["upload_date"]; ?>">
                                </div>
                                <div class="mb-1">
                                    <label for="typeText" class="form-label">Uploaded By</label>
                                    <input type="text" class="form-control" name="user" value="<?php echo  $_SESSION['username']; ?>" disabled>
                                </div>
                                <div class="mb-1">
                                    <label for="typeText" class="form-label">Role</label>
                                    <input type="text" class="form-control" value="User" disabled>
                                </div>

                                <input type="text" class="form-control" name="docid" value="<?php echo $row["doc_id"]; ?>" hidden>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-success" name="update" type="submit" id="update">Update</button>
                                </div>

                            </form>
                <?php }
                    }
                } ?>

            </div>
        </div>
    </div>



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