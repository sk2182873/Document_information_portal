<?php
include '../src/connection.php';
session_start();
if (isset($_SESSION["adminname"])) {

    $query = "SELECT admin_name,admin_profile FROM admin_credentials Where admin_name = '{$_SESSION["adminname"]}'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($_SESSION["adminname"] == $row["admin_name"]) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
                <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
                <link rel="icon" href="../picture/DIP.png">
                <title>Document Information Portal</title>
                <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
                <link rel="stylesheet" href="../admin/css/setting.css">
                <style>
                    .home-section .home-content .overview-boxes {
                        display: flex;
                        width: 100%;
                        justify-content: space-between;
                        flex-wrap: wrap;

                    }

                    .home-section .home-content .box {
                        width: calc(100% / 4 - 15px);
                        height: 100px;
                        margin: 15px 0px;
                        border-radius: 6px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, .5);
                        background-color: #fff;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        flex-direction: row;
                        padding: 20px;
                        cursor: pointer;
                    }

                    .box .box_title {
                        font-size: 20px;
                        font-weight: 600;
                    }

                    .box .data {
                        font-size: 20px;
                        color: #00a118;
                        text-align: center;
                        background-color: #94f7a3;
                        padding: 5px;
                        border-radius: 6px;
                    }

                    .box .two {
                        color: #0439d9;
                        background-color: #aabbf0;
                    }

                    .box .three {
                        color: #d402a6;
                        background-color: #e2aff0;
                    }

                    .box .four {
                        color: #d12502;
                        background-color: #e6aea3;
                    }

                    .home-section .status-box {
                        display: flex;
                        justify-content: space-between;
                        padding: 20px;
                        flex-wrap: wrap;
                    }

                    .home-section .status-box .recent-status {
                        background-color: #fff;
                        border-radius: 6px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, .5);
                        padding: 15px;
                        height: 480px;
                        margin: 15px 15px;
                        flex: 50%;
                        overflow-x: scroll;
                    }

                    .recent-status .upload-details .table thead {
                        border-bottom: 2px solid black;
                    }

                    .recent-status .upload-details .table thead tr th {
                        font-weight: 600;
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

                        .home-section .home-content .overview-boxes .box {
                            width: calc(100% - 15px);
                            margin: 15px 15px;
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


                <div class="sidebar">

                    <div class="logo-details">
                        <span class="logo" title="Document Information Portal">DOCUMENT</span>
                    </div>

                    <ul class="nav-links">
                        <li>
                            <a href="../admin/admindashboard.php" title="Dashboard">
                                <i class='bx bxs-grid-alt'></i>
                                <span class="link-name">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/admin_profile.php" title="Profile">
                                <i class="fas fa-id-badge"></i>
                                <span class="link-name">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/userinfo.php" title="Users">
                                <i class="fas fa-user"></i>
                                <span class="link-name">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/Adduser.php" title="Create Users">
                                <i class='bx bxs-user-plus'></i>
                                <span class="link-name">Create Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/admindocuments.php" title="Admin Documents">
                                <i class='bx bxs-file-doc'></i>
                                <span class="link-name">Admin Documents</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/userdocuments.php" title="User Documents">
                                <i class='bx bxs-file-doc'></i>
                                <span class="link-name">User Documents</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/uploadfile.php" title="Upload">
                                <i class='bx bxs-file-plus'></i>
                                <span class="link-name">Upload Documents</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/reports.php" title="Reports">
                                <i class='bx bx-detail'></i>
                                <span class="link-name">Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/trash_bin.php" title="Trash Bin">
                                <i class="fab fa-bitbucket"></i>
                                <span class="link-name">Trash</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/adminlogout.php" title="Logout">
                                <i class='bx bx-log-out'></i>
                                <span class="link-name" onclick="">Log Out</span>
                            </a>
                        </li>

                    </ul>

                </div>

                <section class="home-section">
                    <nav>
                        <div class="sidebar-button">
                            <i class='bx bx-menu sidebarbtn'></i>
                            <span class="dashboard">Dashboard</span>
                        </div>
                        <div class="profile-details">
                            <img src="<?php echo "admindata/" . $row["admin_profile"]; ?>" alt="Profile">

                            <span class="admin_name text-primary">Hi! <?php echo $row['admin_name'];
                                                                    }
                                                                }
                                                            } else {
                                                                header("Location:../admin/Adminlogin.php");
                                                            }  ?></span>
                        </div>
                    </nav>

                    <!-- home content -->

                    <div class="home-content">
                        <div class="overview-boxes">
                            <div class="box">
                                <div class="box_title">Total User</div>
                                <?php
                                $query3 = "SELECT * FROM user_credentials";
                                $result3 = mysqli_query($conn, $query3) or die("Query Failed (Total Users).");
                                $Total_user = mysqli_num_rows($result3);
                                ?>
                                <div class='data'><i class='bx bxs-user'></i><?php echo $Total_user; ?></div>
                            </div>

                            <div class="box">
                                <div class="box_title">Total Admin</div>
                                <?php
                                $query4 = "SELECT * FROM admin_credentials";
                                $result4 = mysqli_query($conn, $query4) or die("Query Failed (Total admin).");
                                $Total_admin = mysqli_num_rows($result4);
                                ?>
                                <div class="data two"><i class='bx bxs-user-voice'></i><?php echo $Total_admin; ?></div>
                            </div>

                            <div class="box">
                                <div class="box_title">Total Document</div>
                                <?php
                                $query5 = "SELECT * FROM user_uploads";
                                $query6 = "SELECT * FROM admin_uploads";
                                $result5 = mysqli_query($conn, $query5);
                                $result6 = mysqli_query($conn, $query6);
                                $Total_doc1 = mysqli_num_rows($result5);
                                $Total_doc2 = mysqli_num_rows($result6);
                                ?>
                                <div class="data three"><i class='bx bx-file'></i><?php echo $Total_doc2 + $Total_doc1; ?></div>
                            </div>

                            <div class="box">
                                <div class="box_title">Recent Uploads</div>
                                <?php
                                $query7 = "SELECT * FROM user_uploads ORDER BY doc_id DESC LIMIT 5";

                                $result7 = mysqli_query($conn, $query7) or die("Query Failed");
                                $recent_doc = mysqli_num_rows($result7);


                                ?>
                                <div class="data four"><i class='bx bxs-file-plus'></i><?php echo $recent_doc; ?></div>
                            </div>
                        </div>

                        <!-- Sales content -->

                        <div class="status-box">
                            <div class="recent-status">
                                <div class="title text-secondary"><i class='bx bx-upload'></i>
                                    <h5 style="display: inline;">Recent Uploads</h5>
                                </div>
                                <div class="upload-details">
                                    <table class="table table-borderless text-center">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Document name</th>
                                                <th>User Id</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query2 = "SELECT * FROM user_uploads ORDER BY doc_id DESC LIMIT 5";

                                            $result2 = mysqli_query($conn, $query2) or die("Query Failed");
                                            if (mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {

                                            ?>
                                                    <tr>
                                                        <td><?php echo $row2["upload_date"]; ?></td>
                                                        <td><?php echo $row2["doc_name"]; ?></td>
                                                        <td><?php echo $row2["user_id"]; ?></td>
                                                        <td><?php echo "Uploded"; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- JavaScript -->
                <script src="../admin/script/script.js"></script>
            </body>

            </html>