<?php
session_start();
include '../src/connection.php';
if (isset($_POST['upload'])) {
    $filetitle = $_POST['title'];
    $filename = $_FILES['fileInput']['name'];
    $tempname = $_FILES['fileInput']['tmp_name'];
    $filesize = $_FILES['fileInput']['size'];
    $date = $_POST['date'];
    $folder = "../admin/userdata/" . $filename;

    $fileexten = explode(".", $filename);
    
    
    $filecount = count($fileexten);
    
    $row = mysqli_query($conn, "SELECT admin_id FROM admin_credentials WHERE admin_name = '{$_SESSION["adminname"]}'") or die("SQL Error");
    if($result = mysqli_fetch_assoc($row)){
        $adminid = $result["admin_id"];
    } 

    if ($fileexten[1] == "jpg" || $fileexten[1] == "jpeg" || $fileexten[1] == "png" || $fileexten[1] == "pdf" ||
    $fileexten[1] == "JPG" || $fileexten[1] == "JPEG" || $fileexten[1] == "PNG" || $fileexten[1] == "PDF") {
        $query = "INSERT INTO admin_uploads(admin_id,doc_name,doc_size,upload_date,document_path,delete_status) VALUES('{$adminid}','{$filetitle}','$filesize','{$date}','{$folder}','1')";
        $sql = "INSERT INTO document_details(doc_name,doc_size,upload_date,document_path,admin_id,delete_status) VALUES('{$filetitle}','$filesize','{$date}','{$folder}','$adminid','1')";
        mysqli_query($conn, $sql) or die("Failed to saved in temprory database");
        if (mysqli_query($conn, $query)) {
            move_uploaded_file($tempname, $folder);
            $_SESSION['successmsg'] = '<div class="alert alert-success py-1 px-5" role="alert" style="height:30px;">File successfully uploaded.</div>';
            header("location:../admin/uploadfile.php");
        } else {
            $_SESSION['databaseerrormsg'] = '<div class="alert alert-danger py-1 px-5" role="alert" style="height:30px;">File not uploaded. Please try again.</div>';
            header("location:../admin/uploadfile.php");
        }
    } else {
        $_SESSION['errormsg'] = '<div class="alert alert-danger py-1 px-5" role="alert" style="height:fit-content;">File type not Supported.<br>only png, jpg, jpeg and pdf files allowed.</div>';
        header("location:../admin/uploadfile.php");
    }
}
