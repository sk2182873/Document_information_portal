<?php include_once "../src/sidebar_nav.php" ?>
<?php
$userid =  $_SESSION['userid'];
if (isset($_POST["btn"])) {
    $docid = $_POST["input"];

    $query = "UPDATE user_uploads SET delete_status = '1' WHERE doc_id = $docid";
    $res = mysqli_query($conn, $query) or die("Query Failed");
    $_SESSION["Delete"] = '<p class="alert alert-success py-1 px-5" role="alert">Deleted Successfully.</p>';
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
    <link rel="stylesheet" href="../src/print.css">
    <style>
        .cd-table-container {
            background: #fff;
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

        #heading {
            display: none;
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


        .cd-table tbody tr td .bg2 {
            background-color: red;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px;
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
            padding: 10px;
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

        #select {
            width: 100px;
            height: 30px;
        }

        #button {
            width: 100px;
            height: 30px;
            padding: 5px 10px;
        }

        @media screen and (max-width: 550px) {
            .cd-table-container {
                background: #fff;
                box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
                padding: 15px;
                width: 100%;
                overflow-x: scroll;
            }

            .cd-table tbody tr td .bg2 {
                background-color: transparent;
                color: red;
                font-weight: 600;
            }

        }

        @media print {
            .print-table #heading {
                display: block;
            }
        }

        @media print and (landscape) {
            .print-table #heading {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row g-3">
            <main>
                <div class="w-100 mt-4 text-center">
                    <?php
                    if (isset($_SESSION["Delete"])) {
                        echo  $_SESSION["Delete"];
                        unset($_SESSION["Delete"]);
                    }
                    ?>
                </div>
                <!-- User Export data implementation  -->

                <div class="w-100 my-4 d-flex justify-content-end">
                    <a href="#" class="fs-5 me-4 text-dark" title="Print Table" onclick="window.print()"><i class='bx bxs-printer'></i></a>
                </div>
                <!-- partial:index.partial.html -->
                <section class="container cd-table-container mt-1 ">
                    <h2 class="cd-title text-danger">Deleted Documents</h2>
                    <input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Please Search Here" />
                    <?php
                    $userid =  $_SESSION['userid'];
                    $query = "SELECT * FROM user_uploads WHERE user_id = '$userid' AND delete_status = '0'";
                    $res = mysqli_query($conn, $query) or die("Query Failed."); ?>


                    <div class="w-100 print-table">
                        <table class="cd-table order-table table  mt-3">
                            <h5 id="heading">Deleted Documents</h5>
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Doc name</th>
                                    <th>Doc size</th>
                                    <th>Doc date</th>
                                    <th class="action">actions</th>
                                </tr>
                            </thead>

                            <?php if (mysqli_num_rows($res) > 0) {
                                $count = 1; ?>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td><?php echo $count; $count++; ?></td>
                                            <td><?php echo $row["doc_name"]; ?></td>
                                            <td><?php echo $row["doc_size"]; ?></td>
                                            <td><?php echo $row["upload_date"]; ?></td>
                                            <td class="action">
                                                <form action="" method="POST" class="p-0 m-0">
                                                    <input type="text" name="input" value="<?php echo $row["doc_id"]; ?>" hidden>
                                                    <button type="submit" name="btn" class="bg2">Restore</button>
                                                </form>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                        </table>
                    <?php } else { ?>

                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>

                    <?php  } ?>
                    </tbody>
                    </table>
                    </div>

                </section>
                <!-- partial -->
            </main>
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