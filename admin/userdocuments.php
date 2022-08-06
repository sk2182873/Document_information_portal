<?php include "../admin/sidebar.php"; ?>
<?php
include '../src/connection.php';
error_reporting(E_ALL ^ E_WARNING);

$userid = $_SESSION["userid"];

//Delete User Document implementation.
if (isset($_GET["doc-id"], $_GET["doc-name"])) {
    $id = $_GET["doc-id"];
    $docuname = $_GET["doc-name"];

    $query = "UPDATE user_uploads SET delete_status = '0' WHERE doc_id = '$id'";
    mysqli_query($conn, $query) or die("Do not deleted from database.");
    header("Location: userdocuments.php");
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

        .home-section .search-box {
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
            background-color: #fff;
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
                width: 300px;
                margin: 0px auto;
            }
        }
    </style>
</head>

<body>
    <?php
    include '../src/connection.php';
    ?>

    <!-- home section  -->
    <section class="home-section">
        <div class="container">
            <div class="search-box">
                <input type="text" placeholder="User Id" class="form-control" id="searchinput" onkeyup="Search()">
                <button type="submit" name="searchbtn"><i class='bx bx-search'></i></button>
            </div>

            <div class="buttons">
                <a href="#" class="text-dark" title="Print Entire Document" onclick="window.print()"><i class='bx bxs-printer' style="font-size: 20px;"></i></a>
            </div>

            <div class="col-12 userinfo text-center print-table">
                <h5 class="text-primary">User Uploaded Documents.</h5>
                <table class="table table-hover mt-5" id="infotable">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Doc Name</th>
                            <th>Date</th>
                            <th>Doc size</th>
                            <th>User Id</th>
                            <th class="action">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM user_uploads WHERE delete_status = '1'";
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
                                    <td><?php echo $row["doc_size"] . " b"; ?></td>
                                    <td><?php echo $row["user_id"]; ?></td>
                                    <td class="action">
                                        <a href="../admin/updateuserdoc.php?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding: 2px;border-radius:5px;background-color:blue;color:#fff;font-size:15px;">edit</a>
                                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding: 2px;border-radius:5px;background-color:red;color:#fff;font-size:15px;">delete</a>
                                        <a href="../admin/displayuserdoc.php?&doc-name=<?php echo $row["doc_name"]; ?>&path=<?php echo $_SERVER["PHP_SELF"]; ?>&doc-id=<?php echo $row["doc_id"]; ?>" style="padding: 2px;border-radius:5px;background-color:gray;color:#fff;font-size:15px;">view</a>
                                        <a href="../admin/downloadfile.php?file=<?php echo $row["document_path"]; ?>" style="padding: 3px;background-color:green;color:#fff;font-size:15px;border-radius:5px;">download</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }else{ ?>
                            <tr>
                                <td colspan="6">No Record Found.</td>
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

    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>