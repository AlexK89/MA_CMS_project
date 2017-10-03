<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include ("set_connection.php");
if(isset($_POST["update_about"])) {
    $about_welcome_text = $_POST["about_welcome_text"];
    update_about_data($about_welcome_text);
}
if (isset($_POST["add"])) {
    $i_can_do_label = $_POST["i_can_do_label"];
    $i_can_do_text = $_POST["i_can_do_text"];
    $i_can_do_icon_url = $_POST["i_can_do_icon_url"];

    if ($i_can_do_label && $i_can_do_text && $i_can_do_icon_url) {
        echo add_content($i_can_do_label, $i_can_do_text, $i_can_do_icon_url);
    } else {
        echo "<p>Fill inputs</p>";
    }
}
if (isset($_POST["update"])) {
    $i_can_do_icon_url = $_POST["i_can_do_icon_url"];
    $i_can_do_label = $_POST["i_can_do_label"];
    $i_can_do_text = $_POST["i_can_do_text"];

    if ($i_can_do_icon_url || $i_can_do_label || $i_can_do_text) {
        echo edit_form($i_can_do_icon_url, $i_can_do_label, $i_can_do_text);
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete"])) {
    echo delete_item();
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
}
function get_about_page_items()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `i_can_do_label`, `i_can_do_text`, `i_can_do_icon_url` FROM `about_page_items`;");
    $query->execute();
    return $query->fetchAll();
}

function get_about_page_items_list()
{
    $data = get_about_page_items();
    var_dump($data);
    foreach ($data as $item) {
        $content = $item["i_can_do_label"];
        echo "<option value='$content'> $content </option>";
    }
}

function add_content($i_can_do_label, $i_can_do_text, $i_can_do_icon_url) {
    $db = connection();
    $query = $db->prepare("INSERT INTO `about_page_items` (`i_can_do_label`, `i_can_do_text`, `i_can_do_icon_url`) VALUE (:i_can_do_label, :i_can_do_text, :i_can_do_icon_url);");
    $query->bindParam(":i_can_do_label", $i_can_do_label);
    $query->bindParam(":i_can_do_text", $i_can_do_text);
    $query->bindParam(":i_can_do_icon_url", $i_can_do_icon_url);
    $query->execute();
    $result = "<p>Your data was added</p>";
    return $result;
}

function update_i_can_do_label($db, $db_i_can_do_label_id, $i_can_do_label)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `i_can_do_label` = :our_param WHERE `id` = \"" . $db_i_can_do_label_id . "\";");
    $query->bindParam(":our_param", $i_can_do_label);
    $query->execute();
}
function update_i_can_do_text($db, $db_i_can_do_label_id, $i_can_do_text)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `i_can_do_text` = :our_param WHERE `id` = \"" . $db_i_can_do_label_id . "\";");
    $query->bindParam(":our_param", $i_can_do_text);
    $query->execute();
}
function update_i_can_do_icon_url($db, $db_i_can_do_label_id, $i_can_do_icon_url)
{
    $query = $db->prepare("UPDATE `about_page_items` SET `i_can_do_icon_url` = :our_param WHERE `id` = \"" . $db_i_can_do_label_id . "\";");
    $query->bindParam(":our_param", $i_can_do_icon_url);
    $query->execute();
}
function edit_form($i_can_do_icon_url, $i_can_do_label, $i_can_do_text)
{
    $db = connection();
    $db_i_can_do_label = stripslashes($_POST['select_options']);

    $query = $db->prepare("SELECT `id` FROM `about_page_items` WHERE `i_can_do_label` = \"" . $db_i_can_do_label . "\";");
    $query->execute();
    $query_result = $query->fetch(PDO::FETCH_ASSOC);

    $db_i_can_do_label_id = $query_result["id"];

    if ($i_can_do_label) {
        update_i_can_do_label($db, $db_i_can_do_label_id, $i_can_do_label);
    }
    if ($i_can_do_text) {
        update_i_can_do_text($db, $db_i_can_do_label_id, $i_can_do_text);
    }
    if ($i_can_do_icon_url) {
        update_i_can_do_icon_url($db, $db_i_can_do_label_id, $i_can_do_icon_url);
    }
    $result = "<p>Your data was added</p>";
    return $result;
}

function delete_item() {
    $db = connection();
    $remove_content_name = stripslashes($_POST['select_options']);

    $query = $db->prepare("DELETE FROM `about_page_items` WHERE `i_can_do_label` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}

//======================================
//PUT data into portfolio page
//======================================

function put_items()
{
    $data = get_about_page_items();
    foreach ($data as $item) {
        $label = $item["i_can_do_label"];
        $description = $item["i_can_do_text"];
        $icon = $item["i_can_do_icon_url"];

        echo "<div class=\"satisfaction_type\">";
            echo "<p><img src=\"./img/" . $icon . "\"></p>";
            echo "<h4>" . $label . "</h4>";
            echo "<p>" . $description . "</p>";
        echo "</div>";
    }
}