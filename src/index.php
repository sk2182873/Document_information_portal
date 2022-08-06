<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link rel="stylesheet" href="../src/style.css">
</head>
<style>
    .navmenu{
        background-color: #ECECEC;
    }
    .mainbody {
        height: 100vh;
        background-image: url('../picture/bg2.svg');
        background-repeat: no-repeat;
        background-size: 60%;
        background-position: right;
    }

    .welcomepage {
        height: 300px;
        position: relative;
        top: 20%;
        text-align: center;
    }

    .loginform {
        height: 65vh;
        position: absolute;
        top: 20%;
        left: 39%;
        display: none;
    }
    .menubar .menu{
        display: flex;
        justify-content: end;
        align-items: center;
        padding: 20px 0px;
    }
    .menubar .menu #links{
        margin-right: 100px;  
    }
    .menubar .menu #links li{
        list-style-type: none;
    }
    .menubar .menu #links li a{
        text-decoration: none;
        font-weight: 600;
        color: #001E6C;
    }

    @media (max-width: 992px) {
        .welcomepage {
            height: 300px;
            position: relative;
            top: 10%;
            text-align: center;
        }
    }

    @media only screen and (max-width: 576px) {
        .loginform {
            width: 90%;
            height: 60vh;
            position: absolute;
            top: 20%;
            left: 5%;
            display: none;
        }

        .mainbody {
            background-image: url('../picture/bg2.svg');
            background-position: center;
        }
    }

    @media only screen and (min-width: 576px) and (max-width:992px) {

        .loginform {
            width: 70%;
            height: 50vh;
            position: absolute;
            top: 15%;
            left: 15%;
            display: none;

        }
    }
</style>

<body>
    <!-- include custom navigation menu -->
    <?php include 'header.php'; ?>

    <section id="mainbodysection">

        <div class="container-fluid">
            <div class="row" style="background:linear-gradient(130deg, #dfe6e9 10%, transparent 100%);">
                <div class="col-12 mainbody">
                    <div class="col-md-6 my-5 welcomepage">
                        <h3 class="display-3 text-dark">Welcome</h3>
                        <h2 class="display-2 font-weight-bold text-danger">DOCUMENT</h2>
                        <h5 class="display-6 text-info">INFORMATION PORTAL</h5>
                        <span class="text-dark" style="display: block; font-weight: bold;letter-spacing: 2px;">Secure and Easy</span>
                        <?php
                        if (isset($_SESSION['login'])) { ?>
                            <button class="btn btn-danger mt-3 text-white" id="getbtn" hidden>Get Started</button>
                        <?php } else { ?>
                            <button class="btn btn-danger mt-3 text-white" id="getbtn">Get Started</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="Aboutussection">
        <div class="container card bg-light mt-5 p-5">
            <div class="row">
                <div class="col text-center p-5 text-white bg-dark">
                    <h2>ABOUT US</h2>
                    <p>Document Information Portal is a web-based application which is made for
                        store documents on a secure and easy platform. The data is crucial information,
                        so the security of data is important. This system provides a platform to user to
                        store their data in the form of document like PDF, JPG and PNG. This software
                        also provides retrieval of data and security of the data.
                        Before internet era, users store their documents at many physical places where
                        arrangement of documents is very important. If document misplaced it was
                        losses of money and security. Now online era is helping users to store, arrange
                        and manage documents securely. The way of documentation is fully changed in
                        day-by-day life of users with technology. Users can access system from
                        anywhere and view their documents.</p>
                </div>
            </div>
            <div class="row">
                <div class="col text-center p-5 text-white bg-dark">
                    <h2>Objective</h2>
                    <p>To provide online documentation platform.<br>
                        To provide easy and reliable facility to store document.<br>
                        To save time and cost of users.<br>
                        To provide security and enhancing accessibility.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="footer">
           <div class="w-100 bg-dark text-center py-3 text-white">
                    BCSP064 : BCA FINAL PROJECT BY SHIVA KANT ( ENROLLMENT NO : 186461639 )
           </div>
    </section>


  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <script>
        function showmenu() {
            var menu = document.getElementById("links");
            var x = document.getElementById("menubtn");
            var y = document.getElementById("menuclosebtn");
            if ((menu.style.display === "none")) {
                menu.style.display = "block";
                y.style.display = "block";
                x.style.display = "none";
            } else {
                menu.style.display = "none";
            }
        }

        function hidemenu() {
            var menu = document.getElementById("links");
            var x = document.getElementById("menubtn");
            var y = document.getElementById("menuclosebtn");
            if ((menu.style.display === "block") && (y.style.display === "block")) {
                menu.style.display = "none";
                y.style.display = "none";
                x.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }

        function showlogin() {
            const loginmenubtn = document.getElementById('loginbtn');
            const loginform = document.getElementById('loginform');
            if (loginform.style.display === "none") {
                loginform.style.display = "block";
            } else {
                loginform.style.display = "none";
            }

        }

        //login form show handlig
        const loginpageshowbtn = document.getElementById('getbtn');
        loginpageshowbtn.addEventListener('click', () => {
            const loginform = document.getElementById('loginform');
            if (loginform.style.display === "none") {
                loginform.style.display = "block";
            } else {
                loginform.style.display = "none";
            }
        })

        function closeform() {
            const loginpageclosebtn = document.getElementById('loginclosebtn');
            const loginform = document.getElementById('loginform');
            if (loginform.style.display === "block") {
                loginform.style.display = "none";
            } else {
                loginform.style.display = "block";
            }
        }
    </script>
</body>

</html>

<!-- font-family: 'Bebas Neue', cursive;
font-family: 'Russo One', sans-serif;
font-family: 'Share Tech Mono', monospace; -->