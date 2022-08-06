<?php include "../src/sidebar_nav.php" ?>
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
</head>

<body>

    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <?php
                    $userid =  $_SESSION['userid'];
                    $query = "SELECT * FROM user_uploads WHERE user_id = '{$userid}'";
                    $result = mysqli_query($conn, $query) or die("Query Failed.");
                    if (mysqli_num_rows($result) > 0) {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;
                        }
                    } else {
                        $count = 0;
                    }
                    ?>
                    <div>
                        <h3 class="fs-2 text-danger fw-bold"><?php echo $count; ?></h3>
                        <p class="fs-5 text-success">Uploads</p>
                        <h6>Total Uploads</h6>
                    </div>

                    <i class="fas fa-upload fs-1 text-danger bg-info border rounded-circle secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <?php

                        $query2 = "SELECT * FROM user_uploads WHERE delete_status = '0' AND user_id = '{$userid}'";
                        $sqlres2 = mysqli_query($conn, $query2);
                        $count = $sqlres2->num_rows;
                    ?>
                    <div>
                        <h3 class="fs-2 text-secondary fw-bold"><?php echo $count; ?></h3>
                        <p class="fs-5 text-success">Deleted</p>
                        <h6>Total Delete</h6>
                    </div>
                    <i class="fas fa-dumpster fs-1 text-dark bg-info border rounded-circle secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <?php

                    $query2 = "SELECT * FROM user_credentials WHERE user_id = '$userid'";
                    $result2 = mysqli_query($conn, $query2) or die("Query Failed.");
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {

                            $startdate = $row["create_date"];
                            $enddate = date("Y-m-d");
                            $date1 = date_create($startdate);
                            $date2 = date_create($enddate);
                            $diff = date_diff($date2, $date1);
                    ?>

                            <div>
                                <h3 class="fs-2 text-primary fw-bold"><?php echo $diff->days; ?></h3>
                                <p class="fs-5 text-success">Days</p>
                                <h6>To Registered</h6>
                            </div>
                    <?php  }
                    } ?>
                    <i class="fas fa-calendar fs-1 text-warning bg-info border rounded-circle secondary-bg p-3"></i>
                </div>
            </div>
        </div>

        <div class="row my-5 bg-white" style="overflow-x: scroll;">
            <div class="col p-3">
                <h4 class="text-info">Recent Uploads</h4>
                <div class="g-2">
                    <?php
                    $query3 = "SELECT * FROM user_uploads 
                    WHERE user_id = '$userid'
                    ORDER BY doc_id 
                    DESC LIMIT 5";
                    $result3 = mysqli_query($conn, $query3);

                    if (mysqli_num_rows($result3) > 0) {
                        $count  = 1; ?>
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>S.no</th>
                                    <th>Doc name</th>
                                    <th>Doc size</th>
                                    <th>Doc date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result3)) { ?>

                                    <tr>
                                        <td><?php echo $count;
                                            $count++; ?></td>
                                        <td><?php echo $row["doc_name"]; ?></td>
                                        <td><?php echo $row["doc_size"] . " b"; ?></td>
                                        <td><?php echo $row["upload_date"]; ?></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">No Records found.</td>
                        </tr>
                        </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var togglebtn = document.getElementById("menu-toggle");

        togglebtn.onclick = function() {
            el.classList.toggle("toggled")
        }
    </script>
</body>

</html>