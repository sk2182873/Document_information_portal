<?php include '../admin/sidebar.php'; ?>
<?php
error_reporting(E_ALL ^ E_WARNING);

if (isset($_POST["btn"])) {
    $docid = $_POST["input"];
    $docname = $_POST["input2"];

    $query2 = "UPDATE user_uploads SET delete_status = '1' WHERE doc_name = '$docname'";
    mysqli_query($conn, $query2) or die("Query Failed");


        $_SESSION["restore"] = '<p class="alert alert-success py-1 px-5" role="alert">Successfully Restored.</p>';
        unset($_POST["btn"]);
}

if (isset($_POST["btn2"])) {
    $docid = $_POST["inputid"];
    $docname = $_POST["inputname"];

    $query2 = "UPDATE admin_uploads SET delete_status = '1' WHERE doc_name = '$docname'";
    mysqli_query($conn, $query2) or die("Query Failed");

        $_SESSION["restore"] = '<p class="alert alert-success py-1 px-5" role="alert">Successfully Restored.</p>';
        unset($_POST["btn2"]);
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
        .home-section .container {
            height: 550px;
            margin-top: 0px;
            background-color: #F9F9F9;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container .trash {
            width: 100%;
            height: 680px;
            margin-top: 50px;
        }

        .cd-table-container {
            background-color: #fff;
            box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
            padding: 15px;
            width: 100%;
            text-align: center;
        }

        /* Table Design */
        .cd-table {
            width: 100%;
            color: #666;
            margin: 10px auto;
        }

        .cd-table tbody tr {
            border-bottom-style: none;
            border-top-style: none;
            padding: 10px;
            text-align: center;
        }

        .cd-table tbody tr td a {
            padding: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
        }

        .cd-table tbody tr td .bg1 {
            background-color: #42C2FF;
        }

        .cd-table tbody tr td .bg2 {
            background-color: red;
        }

        .cd-table tbody tr td .bg3 {
            background-color: gray;
        }

        .cd-table tbody tr td .bg4 {
            background-color: green;
        }

        .cd-table thead tr {
            border-bottom: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        .cd-table th {
            background: #fff;
            color: #666;
            padding: 10px;
            font-weight: 600;
        }

        /* Search Box */
        .cd-search {
            padding: 5px;
            border: 2px solid red;
            width: 50%;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .cd-search:focus {
            outline: none;
        }

        /* Search Title */
        .cd-title {
            color: #666;
            margin: 15px 0;
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
    <section class="home-section">
        <div class="container">
            <div class="w-100">
                <?php
                if (isset($_SESSION["restore"])) {
                    echo $_SESSION["restore"];
                    unset($_SESSION["restore"]);
                }
                ?>
            </div>
            <div class="trash">
                <div class="w-100 bg-primary mx-auto">
                    <section class="cd-table-container">
                        <h2 class="cd-title text-danger">Deleted Items</h2>
                        <input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Please Search Here" />

                        <table class="cd-table order-table table print-table mt-3">
                            <thead>
                                <tr>
                                    <th>Doc name</th>
                                    <th>Doc size</th>
                                    <th>Doc date</th>
                                    <th class="action">actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = "SELECT * FROM user_uploads WHERE delete_status = '0'";
                                $res = mysqli_query($conn, $query);
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td><?php echo $row["doc_name"]; ?></td>
                                            <td><?php echo $row["doc_size"]; ?></td>
                                            <td><?php echo $row["upload_date"]; ?></td>
                                            <td class="action">
                                                <form action="" method="POST">
                                                    <input type="text" name="input" value="<?php echo $row["doc_id"]; ?>" hidden>
                                                    <input type="text" name="input2" value="<?php echo $row["doc_name"]; ?>" hidden>
                                                    <button type="submit" name="btn" class="text-danger fw-bold border-0 bg-light">Restore</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                }?>
                                <?php 
                                $query2 = "SELECT * FROM admin_uploads WHERE delete_status = '0'";
                                $res2 = mysqli_query($conn, $query2);

                                if (mysqli_num_rows($res2) > 0) {
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($res2)) { ?>
                                        <tr>
                                            <td><?php echo $row["doc_name"]; ?></td>
                                            <td><?php echo $row["doc_size"]; ?></td>
                                            <td><?php echo $row["upload_date"]; ?></td>
                                            <td class="action">
                                                <form action="" method="POST">
                                                    <input type="text" name="inputid" value="<?php echo $row["doc_id"]; ?>" hidden>
                                                    <input type="text" name="inputname" value="<?php echo $row["doc_name"]; ?>" hidden>
                                                    <button type="submit" name="btn2" class="text-danger fw-bold border-0 bg-light">Restore</button>
                                                </form>
                                            </td>
                                        </tr>

                                <?php  }
                                } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src="../admin/script/script.js"></script>
    <script src="../src/script.js"></script>
</body>

</html>