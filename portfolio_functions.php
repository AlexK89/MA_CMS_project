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

$table_name = stripslashes("portfolio_page");

if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];;
    $project_url = $_POST["project_url"];

    if ($label && $description && $img_url && $project_url) {
        if(add_content($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: portfolio_page.php");
            die();
        }
    } else {
        echo "<p>Fill inputs</p>";
    }
}
if (isset($_POST["update"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];
    $project_url = $_POST["project_url"];

    if ($label || $description || $img_url || $project_url) {
        if(edit_form($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: portfolio_page.php");
        }
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    echo delete_item($table_name);
}

/*
 * get_items()  -   getting requested data from data base;
 * return array -   associative array from database;
 */
function get_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `label`, `description`, `img_url`, `project_url` FROM `portfolio_page`;");
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