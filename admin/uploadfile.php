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

        .home-section .container {
            height: fit-content;
            margin-top: 30px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .container .add_doc {
            width: 500px;
            height: fit-content;
            padding: 10px;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, .5);
            background-color: #fff;
        }

        .container .add_doc .title {
            width: 100%;
            border-bottom: 1px solid gray;
            margin: 20px 0px;
        }

        .container .add_doc .row1,
        .row2 {
            border: none;
            width: 100%;
        }

        .container .add_doc .row1 label {
            border: none;
            margin-top: 10px;
        }

        .container .add_doc .row1 #doctitle {
            height: 40px;
        }

        .container .add_doc .row1 .doc_title {
            width: 100%;
            height: 80px;
            border: 2px dashed #BFFFF0;
            font-size: 30px;
            font-weight: 600;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            cursor: pointer;
            background-color: #BFFFF0;
            transition: all 0.3s ease;
        }

        .container .add_doc .btn {
            width: 100px;
            margin: 50px auto;
        }

        .container .add_doc .row2 {
            display: flex;
            justify-content: center;
            align-items: center;
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
    <?php include '../admin/sidebar.php'; ?>

    <section class="home-section">

        <div class="container">

            <div class="add_doc card">
                <div class="title">
                    <h5>Add Documents</h5>
                </div>
                <form action="../admin/admin_upload_process.php" method="post" enctype="multipart/form-data">
                    <div class="row1">
                        <?php
                        if(isset( $_SESSION['successmsg'])){
                            echo $_SESSION['successmsg'];
                            unset($_SESSION['successmsg']);
                        }elseif(isset($_SESSION['databaseerrormsg'])){
                            echo $_SESSION['databaseerrormsg'];
                            unset($_SESSION['databaseerrormsg']);
                        }elseif(isset($_SESSION['errormsg'])){
                            echo $_SESSION['errormsg'];
                            unset($_SESSION['errormsg']);
                        }
                        ?>
                    </div>
                    <div class="row1">
                        <label for="user" class="form-control">Title</label>
                        <input type="text" name="title" class="form-control" value="" required id="doctitle">
                    </div>
                    <div class="row1">
                        <label for="user" class="form-control">Attach Documents</label>
                    </div>

                    <div class="row1">
                        <label for="fileInput" class="form-control doc_title">
                            <i class='bx bxs-cloud-upload'></i>
                            <p class="text-primary" style="font-size: 17px;">Browse Files</p>
                        </label>
                        <input type="file" name="fileInput" id="fileInput" class="form-control" required hidden onchange="readInput()">
                        <p style="font-size: 12px;color:#ada9a8;float:left;padding:5px 10px">Accepted files type : .png .jpg .jpeg and .pdf</p>
                        <p style="font-size: 12px;color:#ada9a8;float:right;padding:5px 10px"><i class="fas fa-lock"></i> Secure</p>
                    </div>

                    <div class="row1 mt-5">
                        <label for="date" class="form-control">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="row2">
                        <input type="submit" name="upload" class="btn btn-primary form-control w-100" value="Upload file">
                    </div>

                </form>
            </div>
        </div>

    </section>

    <script>
        function readInput() {

            let input = document.getElementById("fileInput");
            let para = document.getElementById("doctitle");
            if (input.value) {
                para.value = input.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                para.style.color = "blue";
            }
        }
    </script>

    <script src="../admin/script/script.js"></script>
</body>

</html>