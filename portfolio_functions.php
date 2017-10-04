<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include("upload.php");
include ("set_connection.php");

if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];;
    $project_url = $_POST["project_url"];

    if ($label && $description && $img_url && $project_url) {
        if(add_content($label, $description, $img_url, $project_url)) {
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
        if(edit_form($label, $description, $img_url, $project_url)) {
            header("Location: portfolio_page.php");
            die();
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

function add_content($label, $description, $img_url, $project_url) {
    $db = connection();
    $query = $db->prepare("INSERT INTO `portfolio_page` (`label`, `description`, `img_url`, `project_url`) VALUE (:label, :description, :img_url, :project_url);");
    $query->bindParam(":label", $label);
    $query->bindParam(":description", $description);
    $query->bindParam(":img_url", $img_url);
    $query->bindParam(":project_url", $project_url);
    $query->execute();
    $result = "<p>Your data was added</p>";
    return $result;
}

function update_label($db, $db_label_id, $label)
{
    $query = $db->prepare("UPDATE `portfolio_page` SET `label` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $label);
    $query->execute();
}
function update_description($db, $db_label_id, $description)
{
    $query = $db->prepare("UPDATE `portfolio_page` SET `description` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $description);
    $query->execute();
}
function update_img_url($db, $db_label_id, $img_url)
{
    $query = $db->prepare("UPDATE `portfolio_page` SET `img_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $img_url);
    $query->execute();
}
function update_project_url($db, $db_label_id, $project_url)
{
    $query = $db->prepare("UPDATE `portfolio_page` SET `project_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $project_url);
    $query->execute();
}
function edit_form($label, $description, $img_url, $project_url)
{
    $db = connection();
    $db_label = stripslashes($_POST['select_options']);

    $query = $db->prepare("SELECT `id` FROM `portfolio_page` WHERE `label` = \"" . $db_label . "\";");
    $query->execute();
    $query_result = $query->fetch(PDO::FETCH_ASSOC);

    $db_label_id = $query_result["id"];

    if ($label) {
        update_label($db, $db_label_id, $label);
    }
    if ($description) {
        update_description($db, $db_label_id, $description);
    }
    if ($img_url) {
        update_img_url($db, $db_label_id, $img_url);
    }
    if ($project_url) {
        update_project_url($db, $db_label_id, $project_url);
    }
    $result = "<p>Your data was added</p>";
    return $result;
}

function delete_item() {
    $db = connection();
    $remove_content_name = stripslashes($_POST['select_options']);
    $query = $db->prepare("DELETE FROM `portfolio_page` WHERE `label` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}
