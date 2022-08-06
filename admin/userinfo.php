<?php
include "../admin/sidebar.php";
include '../src/connection.php';

if (isset($_GET["id"])) {
    $userid = $_GET["id"];

    $query = "UPDATE user_credentials SET user_status = 'suspended' WHERE user_id = '$userid'";
    mysqli_query($conn, $query) or die();
    $_SESSION["statusbar"] = '<div class="alert alert-success py-2 px-5" role="alert" id="alert">Successfully Suspended <i class="bx bx-window-close" onclick="hidebar()"></i></div>';
}

if(isset($_GET["susid"])){
    $userid = $_GET["susid"];

    $query = "UPDATE user_credentials SET user_status = 'Active' WHERE user_id = '$userid'";
    mysqli_query($conn, $query) or die();
    $_SESSION["statusbar"] = '<div class="alert alert-success py-2 px-5" role="alert" id="alert">Successfully active <i class="bx bx-window-close" onclick="hidebar()"></i></div>';
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
        .home-section .container {
            height: 500px;
            margin-top: 50px;
            overflow: scroll;
            background-color: #fff;
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

        .container .userinfo table,
        thead,
        tr,
        th {
            background-color: #fff;
        }

        .home-section .container .search-box {
            height: 50px;
            width: 550px;
            margin: 0px auto;
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
                position: relative;
            }
        }
    </style>
</head>

<body>

    <!-- home section  -->
    <section class="home-section">
        <div class="container">
            <div class="search-box">
                <input type="text" placeholder="User Id...." class="form-control" id="searchinput" onkeyup="Search()">
            </div>

            <div class="buttons">
                <a href="#" class="printbtn text-dark" title="Print Entire Document" onclick="window.print();"><i class='bx bxs-printer' style="font-size: 20px;"></i></a>
            </div>

            <div class="userinfo col-12 print-table text-center">
                <h5 class="caption text-primary">User Details</h5>
                <table class="table table-hover " id="infotable">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Username</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Email</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="action">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM user_credentials ";
                        $result = mysqli_query($conn, $query);
                        $sequnce = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td><?php echo $sequnce;
                                        $sequnce += 1;  ?></td>
                                    <td><?php echo $row["user_name"]; ?></td>
                                    <td><?php echo $row["create_date"]; ?></td>
                                    <td><?php echo $row["user_mail"]; ?></td>
                                    <td><?php echo $row["user_id"]; ?></td>
                                    <?php if ($row["user_status"] == "Active") { ?>
                                        <td class="text-success"><?php echo $row["user_status"]; ?></td>
                                    <?php } else { ?>
                                        <td class="text-danger"><?php echo $row["user_status"]; ?></td>
                                    <?php  } ?>
                                    <td class="action">
                                        <a href="../admin/userprofileview.php?id=<?php echo $row["user_id"]; ?>" style="padding: 3px;background-color:blue;font-size:15px;color:#fff;border-radius:5px;" title="View">View</a>
                                        <?php if ($row["user_status"] == "Active") { ?>
                                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $row["user_id"]; ?>" style="padding: 3px;background-color:red;color:#fff;font-size:15px;border-radius:5px;" title="Suspend">Suspend</a>
                                        <?php } else { ?>
                                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?susid=<?php echo $row["user_id"]; ?>" style="padding: 3px;background-color:green;color:white;font-size:15px;border-radius:5px;" title="Suspend">Active</a>

                                        <?php   } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
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
            let searchkey = document.getElementById("searchinput").value.toUpperCase();

            let table = document.getElementById("infotable");
            let tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {

                let td = tr[i].getElementsByTagName('td')[4];

                if (td) {
                    let text = td.textContent || td.innerHTML;

                    if (text.toUpperCase() == searchkey) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        document.getElementById("nofound").innerHTML = "Refresh For Full Data Loading.";
                    }
                }

            }
        }

        function hidebar() {
            document.getElementById("alert").style.display = "none";
        }
    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>