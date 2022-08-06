<?php
include '../src/connection.php';
include 'SimpleXLSXGen.php';
session_start();

// Data export of User documents
if (isset($_GET["export"])) {
    $user = $_GET["user"];

        $document_details = [
            ['Document Name', 'Date', 'Size', 'User']
        ];
       

        $query = "SELECT * FROM user_uploads WHERE delete_status = '1' AND user_id = $user";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $document_details = array_merge($document_details, array(array($row["doc_name"],$row["upload_date"],$row["doc_size"],$row["user_id"])));
            }
        }

        $xlsx = Shuchkin\SimpleXLSXGen::fromArray($document_details);
        $xlsx->downloadAs('document_details.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

        echo "<pre>";
        print_r($document_details);     
        
}

// Data export of userProfile
if (isset($_GET["exportuser"])) {
    $user = $_GET["user"];

        $user_details = [
            ['User Name', 'User Id', 'Date', 'Email'],
        ];

        $query = "SELECT * FROM user_credentials WHERE user_id = $user";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $user_details =  array_merge($user_details, array(array($row["user_name"], $row["user_id"], $row["create_date"], $row["user_mail"])));
            }
           
        }

        $xlsx = Shuchkin\SimpleXLSXGen::fromArray($user_details);
        $xlsx->downloadAs('user_details.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

        echo "<pre>";
        print_r($user_details);

}
