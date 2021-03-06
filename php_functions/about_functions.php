<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

$page_name = stripslashes("about_page");

include("set_connection.php");
include("add_functions.php");
include("update_functions.php");
include("delete_functions.php");
include("duplicate_protection.php");

$table_name = stripslashes("about_page_items");
$project_url = "";


if(isset($_POST["update_about"])) {
    $about_welcome_text = $_POST["about_welcome_text"];

    if(update_about_data($about_welcome_text)) {
        header("Location: ../about_page.php?success=Data updated");
        exit();
    }
}
if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label && $description && duplicates_protection($label, $no_duplicates)) {
        if(add_content($label, $description, $img_url, $project_url, $table_name)) {
            include("upload.php");
            header("Location: ../about_page.php?success=Data added");
            exit();
        }
    } else if(duplicates_protection($label, $no_duplicates) === false) {
        header("Location: ../about_page.php?error=This section already exist");
        exit();
    } else {
        header("Location: ../about_page.php?error=Fill inputs");
        exit();
    }

}
if (isset($_POST["update"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];
    if ($img_url || $label || $description) {
        if(edit_form($label, $description, $img_url, $project_url, $table_name)) {
            include("upload.php");
            header("Location: ../about_page.php?success=Data updated");
            exit();
        }
    } else {
        header("Location: ../about_page.php?error=Fill the form please");
        exit();
    }
}
if (isset($_POST["delete"])) {
    if(delete_item($table_name)) {
        header("Location: ../about_page.php?success=Data removed");
        exit();
    }
}

/*
 * get_about_data()  -   getting about section data from data base;
 * return string     -   content which is in about section;
 */
function get_about_data()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `about_text` FROM `about_block`;");
    $query->execute();
    $about_data_result = $query->fetchAll();
    return $about_data_result[0]["about_text"];
}

/*
 * update_about_data()  -   updating content in about section;
 * return string        -   query request to database;
 */
function update_about_data($about_welcome_text)
{
    $db = connection();
    $query = $db->prepare("REPLACE INTO `about_block`(`id`, `about_text`) VALUES (1, :our_param);");
    $query->bindParam(":our_param", $about_welcome_text);
    return $query->execute();
}

/*
 * get_items()  -   getting requested data from data base;
 * return array -   associative array from database;
 */
function get_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `label`, `description`, `img_url` FROM `about_page_items`;");
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