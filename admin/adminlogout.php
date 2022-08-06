<?php

include '../src/connection.php';

session_start();
unset($_SESSION["adminname"]);
header("Location:../admin/Adminlogin.php");

?>