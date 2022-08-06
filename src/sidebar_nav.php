<?php
include_once "../src/connection.php";
session_start();

if (isset($_SESSION['userid'])) {
?>

    <body>

        <div class="d-flex" id="wrapper">
            <!-- sidebar starts here -->
            <div id="sidebar-wrapper">
                <div class="sidebar-heading py-0 px-0 text-center text-light fw-bold text-uppercase">
                    <span class="fs-1 d-block">Document</span>
                    <span class="fs-6 text-light">Information</span>
                    <span class="fs-6 text-light">Portal</span>
                </div>

                <div class="list-group list-group-flush my-3">
                    <a href="../src/userdashboard.php" class="list-group-item list-group-item-action bg-transparent text-white  active">
                        <i class='bx bxs-dashboard me-2'></i> Dashboard
                    </a>
                    <a href="../src/userprofile.php" class="list-group-item list-group-item-action bg-transparent text-white">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                    <a href="../src/uploaduserfile.php" class="list-group-item list-group-item-action bg-transparent text-white">
                        <i class="fas fa-upload me-2"></i> Upload
                    </a>
                    <a href="../src/userdocview.php" class="list-group-item list-group-item-action bg-transparent text-white">
                        <i class="fas fa-eye me-2"></i> View
                    </a>
                    <a href="../src/user_trashbin.php" class="list-group-item list-group-item-action bg-transparent text-white">
                        <i class="fab fa-bitbucket me-2"></i>Trash
                    </a>
                    <a href="../src/userlogout.php" class="list-group-item list-group-item-action bg-transparent text-white text-danger">
                        <i class="bx bx-log-out me-2"></i> Sign Out
                    </a>
                </div>
            </div>



            <!-- sidebar ends here -->

            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left text-dark fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Dashboard</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class='bx bx-menu'></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                            <li class="nav-item-dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-secondary fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i> <?php echo $_SESSION['username'];  ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="submenu">
                                    <li><a href="../src/userprofile.php" class="dropdown-item">Profile</a></li>
                                    <li><a href="../src/recovery.php?id=<?php echo $_SESSION['userid']; ?>" class="dropdown-item">Change Password</a></li>
                                    <li><a href="../src/userlogout.php" class="dropdown-item">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            <?php } else {
            $_SESSION["loginerror"] = "Please login first";
            header("Location:../src/userlogin.php");
        } ?>