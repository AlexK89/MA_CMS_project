<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include ("upload.php");
include ("set_connection.php");
include ("add_functions.php");
include ("update_functions.php");
include ("delete_functions.php");

$table_name = stripslashes("home_page");
$project_url = "";

if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label && $description && $img_url) {
        if(add_content($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: home_page.php?success=Data added");
            exit();
        }
    } else {
        header("Location: home_page.php?error=Fill inputs");
        exit();
    }
}
if (isset($_POST["update"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label && $description) {
        if(edit_form($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: home_page.php?success=Data updated");
            exit();
        }
    } else {
        header("Location: home_page.php?error=Fill the form please");
        exit();
    }
}
if (isset($_POST["delete"])) {
    if(delete_item($table_name)) {
        header("Location: home_page.php?success=Data removed");
        exit();
    }
}

/*
 * get_items()  -   getting requested data from data base;
 * return array -   associative array from database;
 */
function get_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $query = $db->prepare("SELECT `label`, `description`, `img_url` FROM `home_page`;");
    $query->execute();
    return $query->fetchAll();
}

/*
 * get_items_list()     -   getting from array of data labels for each item;
 * return string        -   label for element;
 */
function get_items_list()
{
    $data = get_items();
    foreach ($data as $item) {
        $content = $item["label"];
        echo "<option value='$content'> $content </option>";
    }
}