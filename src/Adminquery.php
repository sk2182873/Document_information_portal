<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/style.css">
    <link rel="icon" href="../picture/DIP.png">
    <script src="https://kit.fontawesome.com/50458f73e2.js" crossorigin="anonymous"></script>
    <script src="../src/app.js"></script>
    <title>Document Information Portal</title>
</head>

<body>
    <div class="header mw-100" id="adminqueryheader">
        <!-- Logo Div -->
        <div class="companyname">
            <span id="doc">Document</span>
            <span id="IP">Information Portal</span>
        </div>
        <!-- menu  -->
        <div class="menu2">
            <ul id="links">
                <li><a href="../src/index.php">Home</a></li>
                <li><a href="../src/Adminlogin.php" id="loginbtn">Login</a></li>
            </ul> 
        </div>
        
        <a id="homebtn" href="../src/index.php"><i class="fas fa-home text-white m-5"></i></a>
    </div>

    <section class="mainbody">
        <div class="container">
            <div class="col-md-12 bg-light">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <!-- Default form contact -->
                        <form class="text-center border border-light p-5" action="#!">

                            <p class="h4 mb-4">Contact us</p>

                            <!-- Name -->
                            <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">

                            <!-- Email -->
                            <input type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="E-mail">

                            <!-- Subject -->
                            <label>Subject</label>
                            <select class="browser-default custom-select mb-4">
                                <option value="" disabled>Choose option</option>
                                <option value="1" selected>Feedback</option>
                                <option value="2">Report a bug</option>
                                <option value="3">Feature request</option>
                                <option value="4">Feature request</option>
                                <option value="4">Sign-in Problem</option>
                            </select>

                            <!-- Message -->
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Message"></textarea>
                            </div>

                            <!-- Copy -->
                            <div class="custom-control custom-checkbox mb-4">
                                <input type="checkbox" class="custom-control-input" id="defaultContactFormCopy">
                                <label class="custom-control-label" for="defaultContactFormCopy">Send me a copy of this message</label>
                            </div>

                            <!-- Send button -->
                            <button class="btn btn-info btn-block" type="submit">Send</button>

                        </form>
                        <!-- Default form contact -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section3">
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 Contacts bg-dark text-white">
                        <h4 style="color:white">Contact us</h4>
                        <p>D/455<br>Near Sanjay Gandhi TPT. Nagar<br>SamayPur Badli
                            <br>Delhi-110042
                        </p>
                        <span>+91 9818423266</span>
                    </div>

                    <div class="col-12 foottag">
                        @Copyright MasteredCodePoint.com 2022
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="../src/app.js"></script>
</body>

</html>