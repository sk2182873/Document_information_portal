<?php
include "../src/connection.php";
session_start();

// User Reports
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $userid = $_POST["userid"];
    $date = $_POST["date"];

    //case 1
    unset($_SESSION["nofound"], $_SESSION["error"]);
    if ($username == "" && $userid == "" && $date == "") {
        $_SESSION["error"] = "Please provide some information for proceed. Like Username and UserId";
        header("Location:../admin/reports.php");
    } elseif (($username != ""  && $userid != "" && $date != "")) {  //Case 5

        $query = "SELECT * FROM user_credentials WHERE (create_date = '{$date}') AND (user_id = {$userid} OR user_name = '{$username}')";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            if ($row["create_date"] != $date) {
                unset($_SESSION["nofound"]);
                $_SESSION["nofound"] = "Any data is not exists on given date.";
            }
        }
        header("Location:../admin/reports.php");
    } elseif (($userid == ""  || $username != "") && $date == "") {

        $query = "SELECT * FROM user_credentials WHERE user_name = '{$username}'";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["count"] = 0;
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            $_SESSION["nofound"] = "User not exists.";
        }
        header("Location:../admin/reports.php");
    } elseif (($username == ""  || $userid != "") && $date == "") { //Case 2

        $query = "SELECT * FROM user_credentials WHERE user_id = $userid";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            $_SESSION["nofound"] = "User not exists.";
        }
        header("Location:../admin/reports.php");
    }elseif (($date != "" && $username == "") && ($date != "" && $userid == "")) {
        $query = "SELECT * FROM user_credentials WHERE create_date = '{$date}'";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            $_SESSION["nofound"] = "User not exists.";
        }
        header("Location:../admin/reports.php");
    } elseif (($username != ""  || $userid == "") && $date != "") {     //Case 3
        $query = "SELECT * FROM user_credentials WHERE user_name = '{$username}' AND create_date = '{$date}'";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            $_SESSION["nofound"] = "User not exists.";
        }
        header("Location:../admin/reports.php");
    } elseif (($username == ""  || $userid != "") && $date != "") { // Case 4
        $query = "SELECT * FROM user_credentials WHERE user_id = {$userid} AND create_date = '{$date}'";
        $result = mysqli_query($conn, $query);
        unset($_SESSION["count"]);
        unset($_SESSION["userid"], $_SESSION["Username"], $_SESSION["date"], $_SESSION["mail"], $_SESSION["profile"], $_SESSION["nofound"], $_SESSION["error"]);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["Username"] = $row["user_name"];
                $_SESSION["date"] = $row["create_date"];
                $_SESSION["mail"] = $row["user_mail"];
                $_SESSION["profile"] = $row["user_profile"];
                $_SESSION["userStatus"] = $row["user_status"];
                $_SESSION["count"] += 1;
            }
        } else {
            $_SESSION["nofound"] = "User not exists.";
        }
        header("Location:../admin/reports.php");
    }
}



