<?php include_once "../src/sidebar_nav.php" ?>
<?php 
        $userid =  $_SESSION['userid'];
    if(isset($_POST["update"])){
        $filename = $_FILES["newprofile"]["name"];
        $size = $_FILES["newprofile"]["size"];
        $tmp = $_FILES["newprofile"]["tmp_name"];

        $filex = explode(".", $filename);
        $ex = $filex[1];

        $extension = ["png", "jpg", "jpeg"];

        $exten = strtolower($ex);

        if(in_array($exten, $extension )){
            $folder = "../externaluserdata/".$filename;

            $query = "UPDATE user_credentials SET user_profile = '{$folder}' WHERE user_id = '$userid'";
            $res = mysqli_query($conn, $query) or die("Query Failed.");

            if($res){
                move_uploaded_file($tmp, $folder);
                $_SESSION["filesuccess"] = '<p class="alert alert-success py-1 px-5" role="alert">Successfully Update Profile.</p>';
                header("Location:../src/userprofile.php");
            }
        }else{
            $_SESSION["filetypeerror"] = '<p class="alert alert-danger py-1 px-5" role="alert">File type not supported.</p>';
            header("Location:../src/userprofile.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="../picture/DIP.png">
    <title>Document Information Portal</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/style.css">
    <style>
        .row {
            width: 100%;
            height: 680px;
            background-color: #f9f3f9;
            display: flex;
            justify-content: center;
        }

        .col-4 {
            height: 550px;
            background-color: #fff;
            padding: 30px 20px;
        }

        .col-4 .w-100 {
            background-color: #FFA1A1;
            padding: 5px;
            text-align: center;
            color: #fff;
            margin-top: 10px;
        }

        .col-4 .profile {
            width: 100%;
            height: fit-content;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .col-4 .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px solid gray;
        }

        .col-4 form .form-outline {
            width: 100%;
            height: fit-content;
            text-align: center;
            margin-top: 20px;
        }

        .form-outline label {
            width: 60%;
            margin-top: 0px auto;
            background-color: #97C4B8;
            border-radius: 12px;
            border: 1px dashed #A2B38B;
            padding: 10px;
            cursor: pointer;
            color: #fff;
        }

        .col-4 form .selected {
            width: 100%;
            height: fit-content;
            margin-top: 20px;
            text-align: center;
        }

        .selected input {
            width: 80%;
            border-radius: 10px;
            border: 1px solid gray;
            padding: 5px;
            text-align: center;
        }

        .selected input:focus {
            outline: none;
        }

        .col-4 form .buttons {
            width: 100%;
            height: fit-content;
            margin-top: 30px;
            text-align: center;
        }

        @media screen and (max-width: 1000px) {
            .col-4 {
                width: 95%;
                height: 500px;
                background-color: #fff;
                padding: 50px 30px;
                box-shadow: 0px 5px 5px 2px rgba(45,45,45,.5);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-4">
                <div class="w-100">
                    Update Profile
                </div>
                <div class="profile">
                    <img src="../picture/56239.png" alt="Profile" title="User Profile" id="imageprofile">
                </div>
                <form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" enctype="multipart/form-data">
                    <div class="form-outline">
                        <label for="Image">Choose Profile</label>
                        <input type="file" name="newprofile" id="Image" hidden onchange="readInput()">
                    </div>
                    <div class="selected">
                        <input type="text" name="profilename" value="" id="profilename">
                    </div>
                    <div class="buttons">
                        <button type="submit" class="btn btn-success" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/script.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var togglebtn = document.getElementById("menu-toggle");

        togglebtn.onclick = function() {
            el.classList.toggle("toggled");
        }

        function readInput() {
            let imagename = document.getElementById("Image");
            let newinput = document.getElementById("profilename");

            if (imagename.value) {
                newinput.value = imagename.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                newinput.style.color = "green";
            }
        }
    </script>

</body>

</html>