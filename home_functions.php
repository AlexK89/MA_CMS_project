<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include ("upload.php");
include ("set_connection.php");
include ("add_content_function.php");
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
            header("Location: home_page.php");
        }
    } else {
        header("Location: home_page.php");
        echo "<p>Fill inputs</p>";
    }
}
if (isset($_POST["update"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label || $description || $img_url) {
        if(edit_form($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: home_page.php");
        }
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    if(delete_item($table_name)) {
        header("Location: home_page.php");
    }
}

function get_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $query = $db->prepare("SELECT `label`, `description`, `img_url` FROM `home_page`;");
    $query->execute();
    return $query->fetchAll();
}

function get_items_list()
{
    $data = get_items();
    foreach ($data as $item) {
        $content = $item["label"];
        echo "<option value='$content'> $content </option>";
    }
}