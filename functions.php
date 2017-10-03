<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

include ("set_connection.php");

if (isset($_POST["add"])) {
    $content_name = $_POST["content_name"];
    $text_content = $_POST["text_content"];

    if ($content_name && $text_content) {
        echo add_content($content_name, $text_content);
    } else {
        echo "<p>Fill inputs</p>";
    }
}
if (isset($_POST["edit"])) {
    $edit_content_name = $_POST["edit_content_name"];
    $edit_text_content = $_POST["edit_text_content"];

    if ($edit_content_name || $edit_text_content) {
        echo edit_form($edit_content_name, $edit_text_content);
    } else {
        echo "Fill the form please";
    }
}
if (isset($_POST["delete_item"])) {
    echo delete_item();
}


function add_content($content_name, $text_content) {
    $db = connection();
    $query = $db->prepare("INSERT INTO `test` (`content_name`, `text_content`) VALUE (:content_name, :text_content);");
    $query->bindParam(":content_name", $content_name);
    $query->bindParam(":text_content", $text_content);
    $query->execute();
    $result = "<p>Your data was added</p>";
    return $result;
}

function get_data()
{
    $db = connection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT * FROM `test`;");
    $query->execute();
    return $query->fetchAll();
}

function get_data_list()
{
    $data = get_data();
    foreach ($data as $item) {
        $content = $item["content_name"];
        echo "<option value='$content'> $content </option>";
    }
}
function update_name($db, $edit_content_name, $content_name)
{
    $query = $db->prepare("UPDATE `test` SET `content_name` = \"" . $edit_content_name. "\" WHERE `content_name` = \"" . $content_name . "\";");
    $query->bindParam(":content_name", $content_name);
    $query->execute();
}
function update_text_content($db, $edit_text_content, $content_name)
{
    $query = $db->prepare("UPDATE `test` SET `text_content` = \"" . $edit_text_content. "\" WHERE `content_name` = \"" . $content_name . "\";");
    $query->bindParam(":edit_text_content", $edit_text_content);
    $query->execute();
}
function edit_form($edit_content_name, $edit_text_content)
{
    $db = connection();
    $content_name = stripslashes($_POST['users']);

    if ($edit_content_name ) {
        update_name($db, $edit_content_name, $content_name);
        if ($edit_text_content) {
            update_text_content($db, $edit_text_content, $content_name);
        }
    } else {
        update_text_content($db, $edit_text_content, $content_name);
    }
    $result = "<p>Your data was added</p>";
    return $result;
}

function delete_item() {
    $db = connection();
    $remove_content_name = stripslashes($_POST['remove_item']);
    $query = $db->prepare("DELETE FROM `test` WHERE `content_name` = \"" . $remove_content_name . "\";");
    $query->execute();
    return "Your item deleted";
}
