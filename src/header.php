        <div class="container-fluid navmenu">
            <div class="row menubar">     
                <div class="col-12 menu">
                <?php if(isset($_SESSION['userid'])){    ?>
                    <ul id="links">
                        <li><a href="../src/userdashboard.php">Dashboard</a></li>
                        <li><a href="../src/userlogout.php" id="loginbtn">Logout</a></li>
                    </ul>
                        <?php }
                        else{ ?> 
                     <ul id="links">
                        <li><a href="../src/userlogin.php" id="loginbtn">Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
