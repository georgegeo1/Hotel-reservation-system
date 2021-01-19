<?php
session_start();
require_once "include/connect.php";
require_once "include/functions.php";
confirm_owner_logged_in();

$user_id = $_SESSION['user_id'];
require_once "include/head.php";
?>

<body>

<?php include "include/owner_navbar.php"; ?>

<div class="container">
<br>

<?php
if( !isset($_POST["action_type"]) ) {
    echo "
        <div class='col-md-12'>
        <form method='post' action='owner_upload.php' enctype='multipart/form-data'>            
            <input id='file_sel' type='file' name='photo_name' size='32' required>
            <button id='preview_btn' type='submit' name='action_type' value='preview'>Preview</button>  
        </form>
    </div> ";
}

// if user has selected preview
if( isset($_POST["action_type"]) && $_POST["action_type"]==='preview' ) {
    // See   https://www.w3schools.com/php/php_file_upload.asp
    $target_dir = "photos/";
    $file_name = basename($_FILES["photo_name"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["photo_name"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.\n";
        $uploadOk = 0;
    }
    // Check if file already exists
    //if (file_exists($target_file)) {
    //    echo "Sorry, file already exists.";
    //    $uploadOk = 0;
    //}
    // Check file size
    if ($_FILES["photo_name"]["size"] > 500000) {
        echo "Sorry, your file is too large.\n";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, cannot preview your file.\n";
    } else {
        $temp_image = "photos/temp_image";
        if (move_uploaded_file($_FILES["photo_name"]["tmp_name"], $temp_image)) {
            echo "
                <br>                
                <div class='col-md-8'>
                    <img class='img-fluid' src='{$temp_image}'>
                </div>
                <div class='col-md-8'>
                    <form method='post' action='owner_upload.php' enctype='multipart/form-data'>
                        Select Type of Photo:
                        <select name='photo_type'>
                            <option value='m'>Main</option>
                            <option value='2'>Hotel</option>
                            <option value='3'>1-bed Room</option>
                            <option value='4'>2-bed Room</option>
                        </select>
                        <input type='hidden' name='img_file_type' value='$imageFileType'>
                        <button id='upload_btn' type='submit' name='action_type' value='upload'>Upload</button>
                        <button type='cancel'>Cancel</button>
                    </form>
                </div>
            ";
        } else {
            echo "Sorry, there was an error previewing your file.";
        }
    }
}

if( isset($_POST["action_type"]) && $_POST["action_type"]==='upload' ) { // if user has selected upload

    $photoType = $_POST['photo_type'];  // m or 2 or 3 or 4
    $temp_image = "photos/temp_image";
    $image_data = mysqli_real_escape_string($connection, file_get_contents($temp_image));
    $img_file_type = $_POST['img_file_type'];  // jpg, png, jpeg or gif

    if ($photoType === 'm') { // if user wants to upload 'main' photo
        // first check if exists another 'main' photo
        $query = "SELECT * FROM photo WHERE Hotel_ID = '$user_id' AND Kind_ID ='1'";
        $result = mysqli_query($connection, $query) or die("Query to check main photo failed");
        $rows = mysqli_num_rows($result);

        if ($rows === 0) { // if no other 'main' photo exists
            $query = "INSERT INTO photo
                      (Hotel_ID, Kind_ID, Img_type, Image)
                      VALUES
                      ('$user_id', '1', '$img_file_type', '{$image_data}')";

            $result = mysqli_query($connection, $query) or die("Main Photo Insert failed");
        } else { // update 'main' photo
            $query = "UPDATE photo
                      SET Img_type = '$img_file_type', Image = '{$image_data}'
                      WHERE Hotel_ID = '$user_id' AND Kind_ID ='1'";
            $result = mysqli_query($connection, $query) or die("Main Photo Update failed");
        }
    } else { // if user wants to upload other type of photo
        $query = "INSERT INTO photo
                  (Hotel_ID, Kind_ID, Img_type, Image)
                  VALUES
                  ('$user_id', '$photoType', '$img_file_type', '{$image_data}')";
        $result = mysqli_query($connection, $query) or die("Photo Insert failed");
    }

        echo "
        <script>
            alert('upload successful');
            window.location.assign('owner_upload.php');
        </script>
        ";
}

?>

</div> <!-- close container -->

</body>
</html>















