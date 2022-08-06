<?php
include "../admin/sidebar.php";
include "../src/connection.php";
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
        .home-section {
            background-color: #fff;
        }

        .home-section .container {
            width: 100%;
            display: flex;
            justify-content: center;
            height: 90vh;
            margin: 0 auto;
            padding: 0;
        }

        .home-section .container .outerdiv {
            width: 376px;
            margin: 10px auto;
            padding: 0;
            height: fit-content;
            display: flex;
            flex-direction: row;
            background-color: transparent;
        }

        .container .outerdiv .bar {
            width: 376px;
            height: 70px;
            margin: 0px 0px;
            padding: 0;
            text-align: center;
            color: #fff;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;

        }

        .outerdiv .bar h5 {
            line-height: 90px;
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

            .home-section .container {
                height: fit-content;
                display: flex;
                align-items: center;
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

            .home-section .container {
                height: 80vh;
                display: flex;
                align-items: center;
            }

            .home-section .container .outerdiv {
                width: 100%;
                height: fit-content;
                margin: 30px 10px;
                border-radius: 12px;
            }
        }
    </style>
</head>

<body>
    <section class="home-section">

        <div class="container">

            <div class="outerdiv row">
                <div class=" bar bg-secondary">
                    <h5>User Profile</h5>
                </div>
                <?php
                if (isset($_GET["id"])) {
                    $userid = $_GET["id"];

                    $query = "SELECT * FROM user_credentials WHERE user_id = '$userid'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $folder = "../admin/userdata/".$row["user_profile"];
                ?>

                <div class="card text-center mt-5">

                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="<?php echo $folder; ?>" class="w-50" style="border-radius: 50%;" alt="No profile found" title="user profile"/>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-danger"><?php echo $row["user_name"]; ?></h5>
                        <p class="card-text text-dark my-0"><i class="fas fa-envelope text-success"></i> <?php echo $row["user_mail"]; ?></p>
                        <p class="card-text text-dark my-0"><i class="fas fa-calendar text-success"></i> <?php echo $row["create_date"]; ?></p>
                    </div>
                </div>
                <div class="text-light text-center mx-0 p-3 bg-secondary">2 days ago</div>
                    <?php } ?>
            </div>
        </div>
        </div>
    </section>
    <script>
        function readInput() {

            let input = document.getElementById("imginput");
            let para = document.getElementById("title");
            if (input.value) {
                para.value = input.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                para.style.color = "blue";
            }
        }
    </script>
    <script src="../admin/script/script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
</body>

</html>

<!-- 







 -->