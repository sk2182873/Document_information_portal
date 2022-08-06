<?php
include '../src/connection.php';
session_start();
if (isset($_SESSION["adminname"])) {
    $query = "SELECT admin_name,admin_profile FROM admin_credentials Where admin_name = '{$_SESSION["adminname"]}'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($_SESSION["adminname"] == $row["admin_name"]) {
?><div class="sidebar">

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
                        <a href="../admin/Adduser.php" title="Create User">
                            <i class='bx bxs-user-plus'></i>
                            <span class="link-name">Create User</span>
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
                        <a href="../admin/uploadfile.php" title="Upload Documents">
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
                            <span class="link-name">Log Out</span>
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
            </section>