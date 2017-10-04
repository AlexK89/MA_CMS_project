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

$table_name = stripslashes("about_page_items");
$project_url = "";

if(isset($_POST["update_about"])) {
    $about_welcome_text = $_POST["about_welcome_text"];

    if(update_about_data($about_welcome_text)) {
        header("Location: about_page.php");
        die();
    }
}
if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label && $description && $img_url) {
        if(add_content($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: about_page.php");
        }
    } else {
        echo "<p>Fill inputs</p>";
    }

}
if (isset($_POST["update"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];
    if ($img_url || $label || $description) {
        if(edit_form($label, $description, $img_url, $project_url, $table_name)) {
            header("Location: about_page.php");
        }
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    if(delete_item($table_name)) {
        header("Location: about_page.php");
    }
}

function get_about_data()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `about_text` FROM `about_block`;");
    $query->execute();
    $about_data_result = $query->fetchAll();
    return $about_data_result[0]["about_text"];
}
function update_about_data($about_welcome_text)
{
    $db = connection();
    $query = $db->prepare("REPLACE INTO `about_block`(`id`, `about_text`) VALUES (1, :our_param);");
    $query->bindParam(":our_param", $about_welcome_text);
    $query->execute();
    return $query->execute();
}
function get_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `label`, `description`, `img_url` FROM `about_page_items`;");
    $query->execute();
    return $query->fetchAll();
}

function get_items_list()
{
    $data = get_items();
    var_dump($data);
    foreach ($data as $item) {
        $content = $item["label"];
        echo "<option value='$content'> $content </option>";
    }
}