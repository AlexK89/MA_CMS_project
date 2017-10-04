<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include("upload.php");
include ("set_connection.php");
include("add_content_function.php");

$table_name = stripslashes("home_page");
$project_url = "";
if (isset($_POST["add"])) {
    $label = $_POST["label"];
    $description = $_POST["description"];
    $img_url = $_FILES["file_To_Upload"]["name"];

    if ($label && $description && $img_url) {
        if(add_content($label, $description, $img_url, $table_name, $project_url)) {
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
        if(edit_form($label, $description, $img_url)) {
            header("Location: home_page.php");
        }
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    if(delete_item()) {
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

function update_label($db, $db_label_id, $label)
{
    $query = $db->prepare("UPDATE `home_page` SET `label` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $label);
    $query->execute();
}
function update_description($db, $db_label_id, $description)
{
    $query = $db->prepare("UPDATE `home_page` SET `description` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $description);
    $query->execute();
}
function update_img_url($db, $db_label_id, $img_url)
{
    $query = $db->prepare("UPDATE `home_page` SET `img_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $img_url);
    $query->execute();
}

function edit_form($label, $description, $img_url)
{
    $db = connection();
    $db_label = stripslashes($_POST['select_options']);

    $query = $db->prepare("SELECT `id` FROM `home_page` WHERE `label` = \"" . $db_label . "\";");
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
    $query = $db->prepare("DELETE FROM `home_page` WHERE `label` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}
