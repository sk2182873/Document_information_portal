<?php include "../admin/sidebar.php"; ?>
<?php
include '../src/connection.php';
error_reporting(E_ALL ^ E_WARNING);
$adminid = $_SESSION["adminid"];

//Delete Admin Document implementation.
if (isset($_GET["id"], $_GET["docname"])) {
    $id = $_GET["id"];
    $docuname = $_GET["docname"];

    $query = "UPDATE admin_uploads SET delete_status = '0' WHERE doc_id = '$id'";
    mysqli_query($conn, $query) or die("Do not deleted from database.");
    header("Location: admindocuments.php");
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

        .home-section .buttons {
            width: 100%;
            background-color: #fff;
            text-align: right;
            padding: 20px 50px;
        }

        .container .userinfo table thead tr th {
            font-weight: 600;
        }

        .container .userinfo table {
            background-color: #fff;
        }

        .home-section .container .search-box {
            height: 50px;
            width: 550px;
            margin: 10px auto 10px;
            position: relative;
        }
        .search-box input {
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 6px;
            padding: 0 15px;
            font-size: 17px;
            color: #fff;
            background-color: #f2f0f0;
            border: 2px solid #ffc08a;
            outline: none;
            color: #16243d;
        }

        .search-box .bx-search {
            position: absolute;
            right: 5px;
            background-color: #3f8bfc;
            color: #fff;
            top: 50%;
            transform: translateY(-50%);
            height: 40px;
            width: 40px;
            border-radius: 6px;
            font-size: 22px;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
        }


        @media screen and (max-width: 1210px) {
            .container .userinfo {
                overflow: scroll;
            }

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

            .home-section .container .search-box {
                height: 50px;
                width: 250px;
                margin: 0px auto;
            }
        }
    </style>
</head>

<body>
    <!-- home section  -->
    <section class="home-section">
        <?php if (isset($_SESSION["Status"])) {
            echo $_SESSION["Status"];
            unset($_SESSION["Status"]);
        }
        ?>
        <div class="container">
            <div class="search-box">
                <input type="text" placeholder="Admin id" class="form-control" id="searchinput" onkeyup="Search()">
                <button type="submit" name="searchbtn"><i class='bx bx-search'></i></button>
            </div>

            <div class="buttons">
                <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer' style="font-size: 20px;"></i></a>
            </div>

            <div class="col-12 userinfo print-table text-center">
                <h5 class="text-primary">Admin Uploaded Documents.</h5>
                <table class="table table-hover mt-4" id="infotable">

                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Doc Name</th>
                            <th>Date</th>
                            <th>Doc size</th>
                            <th>admin Id</th>
                            <th class="action">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM admin_uploads WHERE delete_status = '1'";
                        $result = mysqli_query($conn, $query);
                        $sequnce = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                
                                <tr>
                                    <td><?php echo $sequnce;
                                        $sequnce += 1;  ?></td>
                                    <td><?php echo $row["doc_name"]; ?></td>
                                    <td><?php echo $row["upload_date"]; ?></td>
                                    <td><?php echo $row["doc_size"] . " bytes"; ?></td>
                                    <td><?php echo $row["admin_id"]; ?></td>
                                    <td class="action">
                                        <a href="../admin/updateadmindoc.php?id=<?php echo $row["doc_id"]; ?>&doc_name=<?php echo $row["doc_name"]; ?>" style="padding: 3px;background-color:blue;color:#fff;font-size:15px;border-radius:5px;">edit</a>
                                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["doc_id"]; ?>&docname=<?php echo $row["doc_name"]; ?>" style="padding: 3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;" >delete</a>
                                        <a href="../admin/displayimage.php?&doc_name=<?php echo $row["doc_name"]; ?>&path=<?php echo $_SERVER["PHP_SELF"]; ?>&id=<?php echo $row["doc_id"]; ?>" style="padding: 3px;background-color:gray;color:#fff;font-size:15px;border-radius:5px;">view</a>
                                        <a href="../admin/downloadfile.php?file=<?php echo $row["document_path"]; ?>" style="padding: 3px;background-color:green;color:#fff;font-size:15px;border-radius:5px;">download</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }else{ ?>
                            <tr>
                                <td colspan="6">No Records Found.</td>
                            </tr>
                      <?php  }
                        ?>
                    </tbody>
                </table>
                <p id="nofound"></p>
            </div>
        </div>

    </section>

    <?php

    mysqli_close($conn);
    ?>

    <script>
        function Search() {
            let searchkey = document.getElementById("searchinput").value;

            let table = document.getElementById("infotable");
            let tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {

                let td = tr[i].getElementsByTagName('td')[4];

                if (td) {
                    let text = td.textContent || td.innerHTML;

                    if (text == searchkey) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        document.getElementById("nofound").innerHTML = "Refresh For Full Data Loading.";
                    }
                }
            }
        }

        function disappear_alert3() {
            document.getElementById("alertbar").style.display = "none";
        }
    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>