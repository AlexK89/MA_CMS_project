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
    echo delete_item();
}

function get_portfolio_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `label`, `description`, `img_url`, `project_url` FROM `portfolio_page`;");
    $query->execute();
    return $query->fetchAll();
}

function get_portfolio_items_list()
{
    $data = get_portfolio_items();
    foreach ($data as $item) {
        $content = $item["label"];
        echo "<option value='$content'> $content </option>";
    }
}

function delete_item() {
    $db = connection();
    $remove_content_name = stripslashes($_POST['select_options']);
    $query = $db->prepare("DELETE FROM `portfolio_page` WHERE `label` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}
