<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */
include ("upload.php");
include ("set_connection.php");

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
        if(add_content($label, $description, $img_url)) {
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
        if(edit_form($img_url, $label, $description)) {
            header("Location: about_page.php");
        }
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    if(delete_item()) {
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
function get_about_page_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `label`, `description`, `img_url` FROM `about_page_items`;");
    $query->execute();
    return $query->fetchAll();
}

function get_about_page_items_list()
{
    $data = get_about_page_items();
    var_dump($data);
    foreach ($data as $item) {
        $content = $item["label"];
        echo "<option value='$content'> $content </option>";
    }
}

function add_content($label, $description, $img_url) {
    $db = connection();
    $query = $db->prepare("INSERT INTO `about_page_items` (`label`, `description`, `img_url`) VALUE (:label, :description, :img_url);");
    $query->bindParam(":label", $label);
    $query->bindParam(":description", $description);
    $query->bindParam(":img_url", $img_url);

    return $query->execute();
}

function update_label($db, $db_label_id, $label)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `label` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $label);
    $query->execute();
}
function update_description($db, $db_label_id, $description)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `description` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $description);
    $query->execute();
}
function update_img_url($db, $db_label_id, $img_url)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `img_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $img_url);
    $query->execute();
}
function edit_form($img_url, $label, $description)
{
    $db = connection();
    $db_label = stripslashes($_POST['select_options']);

    $query = $db->prepare("SELECT `id` FROM `about_page_items` WHERE `label` = \"" . $db_label . "\";");
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
    $result = "<p>Your data was added</p>";
    return $result;
}

function delete_item() {
    $db = connection();
    $remove_content_name = stripslashes($_POST['select_options']);

    $query = $db->prepare("DELETE FROM `about_page_items` WHERE `label` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}