<?php 

if(isset($_GET["file"])){
    $file = $_GET["file"];

    if(file_exists($file)){
        header('Content-Description:File Transfer');
        header('Content-Type:application/image');
        header('Content-Disposition:attachment;filename="'.basename($file).'"');
        header('Content-Length:'.filesize($file));
        readfile($file);
    }

}
?>