<?php

include_once "../src/connection.php";
include "../admin/SimpleXLSXGen.php";

session_start();

if (isset($_GET["export"])) {
    $userid = $_GET["user"];
 

    $document_details = [
        ['Document Name', 'Size', 'Date', 'User']
    ];

    $query = "SELECT * FROM user_uploads WHERE user_id = '$userid'";
    $res = mysqli_query($conn, $query) or die("Query Failed.");

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            $document_details = array_merge($document_details, array(array( $row["doc_name"], $row["doc_size"], $row["upload_date"], $row["user_id"])));
        }
    }

    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($document_details);
    $xlsx->downloadAs('document_details.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx
}
?>
