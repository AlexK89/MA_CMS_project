<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 04/10/2017
 * Time: 13:09
 */

function update_label($db, $db_label_id, $label, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `label` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $label);
    return $query->execute();
}
function update_description($db, $db_label_id, $description, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `description` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $description);
    return $query->execute();
}
function update_img_url($db, $db_label_id, $img_url, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `img_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $img_url);
    return $query->execute();
}
function update_project_url($db, $db_label_id, $project_url, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `project_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $project_url);
    return $query->execute();
}
function edit_form($label, $description, $img_url, $project_url, $table_name)
{
    $db = connection();
    $db_label = stripslashes($_POST['select_options']);

    $query = $db->prepare("SELECT `id` FROM `" . $table_name . "` WHERE `label` = \"" . $db_label . "\";");
    $query->execute();
    $query_result = $query->fetch(PDO::FETCH_ASSOC);

    $db_label_id = $query_result["id"];

    if ($label) {
        update_label($db, $db_label_id, $label, $table_name);
    }
    if ($description) {
        update_description($db, $db_label_id, $description, $table_name);
    }
    if ($img_url) {
        update_img_url($db, $db_label_id, $img_url, $table_name);
    }
    if ($project_url) {
        update_project_url($db, $db_label_id, $project_url, $table_name);
    }

    return "Data changed";
}