<?php include "../admin/sidebar.php"; ?>
<?php

// Delete Documents 
if (isset($_GET["id"])) {
    $docid = $_GET["id"];

    $query = "SELECT * FROM user_uploads WHERE doc_id = $docid";
    $res = mysqli_query($conn, $query) or die("Query Failed.");
    $row = mysqli_fetch_assoc($res);
    $filename = basename($row["document_path"]);

    $folder = "C:/xamp/htdocs/DIP/externaluserdata/" . $filename;

    $query2 = "UPDATE user_uploads SET delete_status = '0' WHERE doc_id = $docid";
    $res2 = mysqli_query($conn, $query2);
    if ($res2) {
        unlink($folder);
        $_SESSION["selectmsg"] = '<div class="alert alert-danger py-1 px-5" role="alert">Successfully deleted.</div>';
        unset($_GET);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
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
        .home-section {
            background-color: #fff;
        }

        .home-section .container {
            height: 635px;
            margin-top: 10px;
            /* background-color: rebeccapurple; */
        }

        .container .col-12 {
            font-size: large;
        }

        .form2 {
            display: none;
        }

        .form2 input {
            width: 150px;
            margin: 0 10px;
            border-radius: 5px;
            border: 1px solid gray;
        }

        .form2 input:focus {
            outline: none;
        }

        .form4 {
            display: none;
        }

        .form4 input {
            width: 150px;
            margin: 0 10px;
            border-radius: 5px;
            border: 1px solid gray;
        }

        .form4 input:focus {
            outline: none;
        }

        .table2 {
            height: 500px;
            overflow: scroll;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
        }

        .table2 h4 {
            margin-top: 10px;
        }

        @media screen and (max-width:1200px) {
            .formdiv {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form2 {
                width: 200px;
                display: none;
            }

            .form2 label {
                display: block;
            }

            .form2 input {
                width: 200px;
            }

            .form2 button {
                width: 100px;
                margin: 10px auto;
                display: block;
            }

            .form2 a {
                width: 120px;
                margin: 0px auto;
                display: block;
            }

            .form4 {
                width: 200px;
                display: none;
            }

            .form4 label {
                display: block;
            }

            .form4 input {
                width: 200px;
            }

            .form4 button {
                width: 100px;
                margin: 10px auto;
                display: block;
            }
        }
    </style>
</head>

<body>

    <?php include "../src/connection.php"; ?>
    <section class="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-light p-lg-3 ps-lg-5 pr-lg-5 ">
                    <form action="" style="display: flex;justify-content:space-between;">
                        <div>
                            <label for="">User type</label>
                            <select name="usertype" id="usertype" onchange="displayform()">
                                <option value="select" selected>Select</option>
                                <option value="user">User</option>
                                <option value="document">Document</option>
                            </select>
                        </div>
                    </form>
                    <form action="../admin/reportsbackend.php" class="col-md-12 form2 mt-5 formdiv mx-auto" method="post">
                        <p class="text-disabled">User List</p>
                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="user">
                            <label for="userid">User Id</label>
                            <input type="text" name="userid" id="userid">
                            <label for="date">Registration Date</label>
                            <input type="date" name="date" id="rdate">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            <a href="../admin/userinfo.php" class="btn btn-primary">User List</a>
                        </div>
                    </form>

                    <?php
                    if (isset($_SESSION["error"])) { ?>
                        <div class="alert alert-warning" role="alert" style="height: fit-content;" id="alert3"><?php echo $_SESSION["error"]; ?><i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert3();"></i></div>
                    <?php
                    }
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-md-12 form4 mt-5 formdiv mx-auto" method="post" name="myform">
                        <p class="text-disabled">User Wise Document List.</p>
                        <div>
                            <label class="mt-2">User Id</label>
                            <input type="text" name="user" required>
                            <label for="docname" class="mt-2">Doc name</label>
                            <input type="text" name="docname" id="document">
                            <label for="docdate" class="mt-2">Date</label>
                            <input type="date" name="docdate" id="docdate">
                            <button class="btn btn-primary" type="submit" name="submit3">Submit</button>
                        </div>
                    </form>
                </div>

                <?php if (isset($_SESSION["selectmsg"])) {
                    echo $_SESSION["selectmsg"];
                    unset($_SESSION["selectmsg"]);
                }
                ?>

                <!-- userwise reports genetate code implementaion. -->
                <?php
                $count = 1;
                if (isset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"],$_SESSION["userStatus"])) {
                ?>
                    <!-- When given username as input -->
                    <div class="col-lg-12 mt-3 table3" id="usertable">

                        <div class="exportdata w-100 text-end">
                            <form action="../admin/exportdata.php" class="mx-5" method="get">
                                <select name="export_options">
                                    <option value="select">--Select--</option>
                                    <option value="xls">Excel</option>
                                </select>
                                <input type="text" name="user" value="<?php echo $_SESSION["userid"]; ?>" hidden>
                                <button type="submit" name="exportuser" class="btn btn-primary">Export</button>
                            </form>
                        </div>

                        <div style="width: 100%;text-align:end;">
                            <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer'></i></a>
                            <i class='bx bx-window-close text-danger' style="cursor: pointer;" onclick="table_close();"></i>
                        </div>

                        <div class="col-12 print-table text-center">
                            <h5 class="text-primary">User Profile Details.</h5>

                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">User id</th>
                                        <th scope="col">Registration Date</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count1 = $_SESSION["count"];
                                    for ($i = 0; $i < $count1; $i++) { ?>
                                        <tr>
                                            <td><?php echo $count;
                                                $count++; ?></td>
                                            <td><?php echo $_SESSION["Username"]; ?></td>
                                            <td><?php echo $_SESSION["userid"]; ?></td>
                                            <td><?php echo $_SESSION["date"]; ?></td>
                                            <td><?php echo $_SESSION["mail"]; ?></td>
                                            <td><?php echo $_SESSION["userStatus"]; ?></td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        if (isset($_SESSION["nofound"])) { ?>
                            <div class="alert alert-danger py-1" style="height: fit-content;" id="alert2"><?php echo $_SESSION["nofound"]; ?><i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert2();"></i></div>
                    <?php
                        }
                        unset($_SESSION["nofound"]);
                    }
                    unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"],$_SESSION["userStatus"]);
                    ?>
                    </div>

                    <!-- User's Documents details reports Generation Module implementation.  -->
                    <?php
                    if (isset($_POST["submit3"])) {
                        $user = $_POST["user"];
                        $docname = $_POST["docname"];
                        $date = $_POST["docdate"];

                        if ($user == "") {  ?>
                            <div class="alert alert-danger px-5 py-1" role="alert" style="height: fit-content;" id="alert">
                                User id must be entered.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert();"></i>
                            </div>


                            <?php } else {

                            if (ctype_digit($user)) {

                                $sql = "SELECT * FROM user_credentials WHERE user_id = $user";
                                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                                if (mysqli_num_rows($result) > 0) {

                                    if ($user != "" && $docname == "" && $date == "") {
                                        $sql = "SELECT * FROM user_uploads WHERE user_id = $user AND delete_status = '1'";
                                        $result = mysqli_query($conn, $sql) or die("Query Failed.");
                                        if (mysqli_num_rows($result) > 0) { ?>

                                            <div class="col-12 table2 " id="doctable">
                                                <!-- export Options -->
                                                <div class="exportdata w-100 text-end">
                                                    <form action="../admin/exportdata.php" class="mx-5" method="get">
                                                        <select name="export_options">
                                                            <option value="select">--Select--</option>
                                                            <option value="xls">Excel</option>
                                                        </select>
                                                        <input type="text" name="user" value="<?php echo $user; ?>" hidden>
                                                        <button type="submit" name="export" class="btn btn-primary">Export</button>
                                                    </form>
                                                </div>

                                                <div style="margin:10px 0px 0px;width:100%;text-align:end;">
                                                    <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer'></i></a>
                                                    <a href="#">
                                                        <i class='bx bx-window-close text-danger' style="cursor: pointer;" onclick="table_close2();"></i>
                                                    </a>
                                                </div>
                                                <div class="col-12 print-table text-center">
                                                    <h4 class="text-dark">User Documents Details</h4>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">S.no</th>
                                                                <th scope="col">Document name</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Size</th>
                                                                <th scope="col">User</th>
                                                                <th scope="col" class="action">actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                                <tr>
                                                                    <td><?php echo $count;
                                                                        $count++; ?></td>
                                                                    <td><?php echo $row["doc_name"]; ?></td>
                                                                    <td><?php echo $row["upload_date"]; ?></td>
                                                                    <td><?php echo $row["doc_size"];
                                                                        echo " b"; ?></td>
                                                                    <td><?php echo $row["user_id"]; ?></td>
                                                                    <td class="action">
                                                                        <a href="../admin/updateuserdoc.php?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding:3px;background-color:blue;color:#fff;font-size:15px;border-radius:5px;">edit</a>
                                                                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["doc_id"]; ?>" style="padding:3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;">delete</a>
                                                                    </td>
                                                                </tr>
                                                </div>
                                            </div>

                                        <?php    }
                                                        } else { ?>
                                        <div class="alert alert-danger px-5 py-1" role="alert" style="height: fit-content;" id="alert">
                                            No record found.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert();"></i>
                                        </div>
                                    <?php       }
                                                    } else if ($user != "" && $docname != "" && $date != "") {
                                                        $query = "SELECT * FROM user_uploads WHERE doc_name = '{$docname}' AND delete_status = '1'";
                                                        $result = mysqli_query($conn, $query);
                                                        $count = 1;
                                                        unset($_SESSION["nofound"], $_SESSION["error"]); ?>
                                    <div class="col-12 table2 " id="doctable">
                                        <!-- export Options -->
                                        <div class="exportdata w-100 text-end">
                                            <form action="../admin/exportdata.php" class="mx-5" method="get">
                                                <select name="export_options">
                                                    <option value="select">--Select--</option>
                                                    <option value="xls">Excel</option>
                                                </select>
                                                <input type="text" name="user" value="<?php echo $user; ?>" hidden>
                                                <button type="submit" name="export" class="btn btn-primary">Export</button>
                                            </form>
                                        </div>

                                        <div style="margin:10px 0px 0px;width:100%;text-align:end;">
                                            <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer'></i></a>
                                            <a href="#">
                                                <i class='bx bx-window-close text-danger' style="cursor: pointer;" onclick="table_close2();"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 print-table text-center">
                                            <h4 class="text-dark">User Documents Details</h4>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.no</th>
                                                        <th scope="col">Document name</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col" class="action">actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <td><?php echo $count;
                                                                    $count++; ?></td>
                                                                <td><?php echo $row["doc_name"]; ?></td>
                                                                <td><?php echo $row["upload_date"]; ?></td>
                                                                <td><?php echo $row["doc_size"];
                                                                    echo " b"; ?></td>
                                                                <td><?php echo $row["user_id"]; ?></td>
                                                                <td class="action">
                                                                    <!-- Edit button -->
                                                                    <a href="../admin/updateuserdoc.php?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding:3px;background-color:blue;color:#fff;font-size:15px;border-radius:5px;">edit</a>
                                                                    <!-- Delete button -->
                                                                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["doc_id"]; ?>" style="padding:3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;">delete</a>
                                                                    <!-- View button -->
                                                                    <a href="../admin/displayuserdoc.php?&doc-name=<?php echo $row["doc_name"]; ?>&path=<?php echo $_SERVER["PHP_SELF"]; ?>&doc-id=<?php echo $row["doc_id"]; ?>" style="padding: 3px;background-color:gray;color:#fff;font-size:15px;border-radius:5px;">view</a>
                                                                </td>
                                                            </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php
                                                            }
                                                        } else { ?>
                                <div class="alert alert-danger px-5 py-1" role="alert" style="height: fit-content;" id="alert">
                                    No record found.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert();"></i>
                                </div>
                            <?php }
                                                    } else if ($user != "" && $date != "") {
                                                        $query = "SELECT * FROM user_uploads WHERE user_id = {$user} AND upload_date = '{$date}' AND delete_status = '1'";
                                                        $result = mysqli_query($conn, $query);
                                                        $count = 1;
                                                        if (mysqli_num_rows($result) > 0) { ?>
                                <div class="col-12 table2" id="doctable">
                                    <!-- export Options -->
                                    <div class="exportdata w-100 text-end">
                                        <form action="../admin/exportdata.php" class="mx-5" method="get">
                                            <select name="export_options">
                                                <option value="select">--Select--</option>
                                                <option value="xls">Excel</option>
                                            </select>
                                            <input type="text" name="user" value="<?php echo $user; ?>" hidden>
                                            <button type="submit" name="export" class="btn btn-primary">Export</button>
                                        </form>
                                    </div>

                                    <div style="margin:10px 0px 0px;width:100%;text-align:end;">
                                        <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer'></i></a>
                                        <a href="#">
                                            <i class='bx bx-window-close text-danger' style="cursor: pointer;" onclick="table_close2();"></i>
                                        </a>
                                    </div>

                                    <div class="col-12 print-table text-center">

                                        <h4 class="text-dark">User Documents Details</h4>

                                        <table class="table table-hover ">

                                            <thead>

                                                <tr>
                                                    <th scope="col">S.no</th>
                                                    <th scope="col">Document name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col" class="action">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count;
                                                                $count++; ?></td>
                                                        <td><?php echo $row["doc_name"]; ?></td>
                                                        <td><?php echo $row["upload_date"]; ?></td>
                                                        <td><?php echo $row["doc_size"]; ?></td>
                                                        <td><?php echo $row["user_id"]; ?></td>
                                                        <td class="action">
                                                            <!-- Edit button -->
                                                            <a href="../admin/updateuserdoc.php?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding:3px;background-color:blue;color:#fff;font-size:15px;border-radius:5px;">edit</a>
                                                            <!-- Delete button -->
                                                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["doc_id"]; ?>" style="padding:3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;">delete</a>
                                                            <!-- View button -->
                                                            <a href="../admin/displayuserdoc.php?&doc-name=<?php echo $row["doc_name"]; ?>&path=<?php echo $_SERVER["PHP_SELF"]; ?>&doc-id=<?php echo $row["doc_id"]; ?>" style="padding: 3px;background-color:gray;color:#fff;font-size:15px;border-radius:5px;">view</a>
                                                        </td>
                                                    </tr>
                                    </div>
                                <?php  }
                                                        } else { ?>
                                <div class="alert alert-warning py-1" role="alert" id="alert7">No data exists on given date.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert7();"></i></div>
                                <?php
                                                        }
                                                    } elseif ($docname != "" && $user != "") {
                                                        $query = "SELECT * FROM user_uploads WHERE doc_name = '{$docname}' AND user_id = $user AND delete_status = '1'";
                                                        $result = mysqli_query($conn, $query);
                                                        $count = 1;
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                    <div class="col-12 text-center" id="doctable">
                                        <!-- Export Options -->
                                        <div class="exportdata w-100 text-end">
                                            <form action="../admin/exportdata.php" class="mx-5" method="get">
                                                <select name="export_options">
                                                    <option value="select">--Select--</option>
                                                    <option value="xls">Excel</option>
                                                </select>
                                                <input type="text" name="user" value="<?php echo $user; ?>" hidden>
                                                <button type="submit" name="export" class="btn btn-primary">Export</button>
                                            </form>
                                        </div>

                                        <div style="margin:10px 0px 0px;width:100%;text-align:end;">
                                            <a href="#" onclick="window.print();" class="printbtn text-dark" title="Print Entire Document"><i class='bx bxs-printer'></i></a>
                                            <a href="#">
                                                <i class='bx bx-window-close text-danger' style="cursor: pointer;" onclick="table_close2();"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 print-table text-center">
                                            <h5 class="text-primary">Document Details</h5>
                                            <table class="table table-hover">
                                                <thead>

                                                    <tr>
                                                        <th scope="col">S.no</th>
                                                        <th scope="col">Document name</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col" class="action">actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $count;
                                                                $count++; ?></td>
                                                        <td><?php echo $row["doc_name"]; ?></td>
                                                        <td><?php echo $row["upload_date"]; ?></td>
                                                        <td><?php echo $row["doc_size"]; ?></td>
                                                        <td><?php echo $row["user_id"]; ?></td>
                                                        <td class="action">
                                                            <!-- Edit button -->
                                                            <a href="../admin/updateuserdoc.php?doc-id=<?php echo $row["doc_id"]; ?>&doc-name=<?php echo $row["doc_name"]; ?>" style="padding:3px;background-color:blue;color:#fff;font-size:15px;border-radius:5px;">edit</a>
                                                            <!-- Delete button -->
                                                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["doc_id"]; ?>" style="padding:3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;">delete</a>
                                                            <!-- View button -->
                                                            <a href="../admin/displayuserdoc.php?&doc-name=<?php echo $row["doc_name"]; ?>&path=<?php echo $_SERVER["PHP_SELF"]; ?>&doc-id=<?php echo $row["doc_id"]; ?>" style="padding: 3px;background-color:gray;color:#fff;font-size:15px;border-radius:5px;">view</a>

                                                        </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php
                                                            }
                                                        } else { ?>
                                <div class="alert alert-warning py-1" role="alert" id="alert6">Document not exists.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert6();"></i></div>
                        <?php   }
                                                    }
                                                } else { ?>

                        <div class="alert alert-warning py-1" role="alert" id="alert5">User not found.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert5();"></i></div>
                    <?php
                                                }
                                            } else { ?>
                    <div class="alert alert-danger" role="alert" id="alert4">User Id must be a number.<i class='bx bxs-x-circle py-1' style="font-size: 20px;" onclick="disappear_alert4();"></i> </div>
        <?php  }
                                        }
                                    }

        ?>

                                </div>
    </section>

    <script type="text/javascript">
        function displayform() {
            var select = document.getElementById("usertype").value;
            var form2 = document.querySelector(".form2");
            var form4 = document.querySelector(".form4");
            var form5 = document.querySelector(".form5");

            if (select === "user") {
                form2.style.display = "block";
                form4.style.display = "none";

            } else if (select === "select") {
                form2.style.display = "none";
                form4.style.display = "none";
            } else if (select === "document") {
                form4.style.display = "block";
                form2.style.display = "none";
            } else {
                form2.style.display = "none";
                form4.style.display = "none";
            }
        }

        function disappear_alert() {
            var alertbox = document.getElementById("alert");
            alertbox.style.display = "none";
        }

        function disappear_alert2() {
            var alertbox2 = document.getElementById("alert2");
            alertbox2.style.display = "none";
        }

        function disappear_alert3() {
            var alertbox3 = document.getElementById("alert3");
            alertbox3.style.display = "none";
        }

        function disappear_alert4() {
            var alertbox4 = document.getElementById("alert4");
            alertbox4.style.display = "none";
        }

        function disappear_alert5() {
            var alertbox5 = document.getElementById("alert5");
            alertbox5.style.display = "none";
        }

        function disappear_alert6() {
            var alertbox6 = document.getElementById("alert6");
            alertbox6.style.display = "none";
        }

        function disappear_alert7() {
            var alertbox7 = document.getElementById("alert7");
            alertbox7.style.display = "none";
        }

        function table_close() {
            var table = document.getElementById("usertable");
            table.style.display = "none";
        }

        function table_close2() {
            var doctable = document.getElementById("doctable");
            doctable.style.display = "none";
        }
    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>