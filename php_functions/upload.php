<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 03/10/2017
 * Time: 16:51
 */

$target_dir = "../Portfolio_project-2.0/img/";
$target_file = $target_dir . basename($_FILES["file_To_Upload"]["name"]);
$uploadOk = 1;
var_dump($target_file);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
var_dump($imageFileType);
// Check if image file is a actual image or fake image
if(isset($_POST["add"]) || isset($_POST["update"])) {
    $check = getimagesize($_FILES["file_To_Upload"]["tmp_name"]);
    if($_FILES["file_To_Upload"]["name"]) {
        if($check === false) {
            header("Location: ../" . $page_name . ".php?error=File is not an image.");
            $uploadOk = 0;
            exit();
        }
    }
}

if($_FILES["file_To_Upload"]["name"]) {
    // Check if file already exists
    if (file_exists($target_file)) {
        header("Location: ../" . $page_name . ".php?error=Sorry, file already exists.");
        $uploadOk = 0;
        exit();
    }
// Check file size
    if ($_FILES["file_To_Upload"]["size"] > 5000000) {
        header("Location: ../" . $page_name . ".php?error=Sorry, your file is too large.");
        $uploadOk = 0;
        exit();
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        header("Location: ../" . $page_name . ".php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
        exit();
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: ../" . $page_name . ".php?error=Sorry, your file was not uploaded. File already exists");
        exit();
// if everything is ok, try to upload file
    } else {
        if (!(move_uploaded_file($_FILES["file_To_Upload"]["tmp_name"], $target_file))) {
//            var_dump($target_file);
//            var_dump($imageFileType);
            header("Location: ../" . $page_name . ".php?error=Sorry, there was an error uploading your file.");
            exit();
        }
    }
}
