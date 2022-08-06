<?php include "../admin/sidebar.php"; ?>
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
         .home-section{
             background-color: #fff;
         }
        .home-section .container {
            height: 500px;
            margin-top: 10px;
            overflow: scroll;
            background-color: #fff;
        }

        .home-section .buttons{
            width: 100%;
            background-color: #fff;
            text-align: right;
           padding: 20px 50px;

        }

        .container .userinfo table thead tr th {
            font-weight: 600;
        }
        .container .userinfo table{
            background-color: #fff;
        }

        .home-section .search-box {
            height: 50px;
            width: 550px;
            margin: 30px auto;
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
        }
    </style>
</head>
<body>
<?php
    include '../src/connection.php';
?><!-- home section  -->
    <section class="home-section">
        <div class="container">
            <div class="search-box">
                <input type="text" placeholder="User Id...." class="form-control" id="searchinput" onkeyup="Search()" >
			

                <!-- <button type="submit" name="searchbtn"><i class='bx bx-search'></i></button> -->
            </div>
            <div class="userinfo">
                <table class="table table-hover print-table" id="infotable">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Username</th>
                            <th>Register Date</th>
                            <th>Email</th>
                            <th>User Id</th>
                            <th class="action">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM admin_credentials";
                        $result = mysqli_query($conn, $query);
                        $sequnce = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td><?php echo $sequnce;
                                        $sequnce += 1;  ?></td>
                                    <td><?php echo $row["admin_name"]; ?></td>
                                    <td><?php echo $row["date"]; ?></td>
                                    <td><?php echo $row["mail"]; ?></td>
                                    <td><?php echo $row["admin_id"]; ?></td>
                                    <td class="action"><a href="#" style="padding: 10px;color:blue;font-size:16px;"><i class="fas fa-pen"></i></a> <a href="#" style="padding: 10px;color:red;font-size:16px;"><i class="fas fa-trash"></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
						
                    </tbody>
                </table>
				<p id="demo"></p>
            </div>

        </div>
        <div class="buttons">
            <button class="btn btn-primary" onclick="window.print();">Print</button>
        </div>
    </section>
    <?php

    mysqli_close($conn);
    ?>

    <script>
        function Search() {
			let searchkey = document.getElementById("searchinput").value;
            
            let table = document.getElementById("infotable");
            let tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {

                let td = tr[i].getElementsByTagName('td')[0];

                if (td) {
                    let text = td.textContent;

                    if (text == searchkey) {
						tr[i].style.display = "";
						document.getElementById("demo").innerHTML = ""; 	
                    }else {
						tr[i].style.display = "none";
                       document.getElementById("demo").innerHTML = "Nothing is found.";
                    }
                }
            }
        }
    </script>
    <script src="../admin/script/script.js"></script>
</body>

</html>