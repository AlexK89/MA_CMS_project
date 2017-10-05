<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 04/10/2017
 * Time: 13:09
 */

/*
 * update_label()       - update chosen label in database
 * @param $db_label_id  - selecting database label id
 * @param $label        - data from label fields
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function update_label($db, $db_label_id, $label, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `label` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $label);
    return $query->execute();
}

/*
 * update_description()       - update chosen label in database
 * @param $db_label_id  - selecting database label id
 * @param $description  - data from description fields
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function update_description($db, $db_label_id, $description, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `description` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $description);
    return $query->execute();
}

/*
 * update_img_url()       - update chosen label in database
 * @param $db_label_id  - selecting database label id
 * @param $img_url      - name of chosen file to upload
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function update_img_url($db, $db_label_id, $img_url, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `img_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $img_url);
    return $query->execute();
}

/*
 * update_project_url()       - update chosen label in database
 * @param $db_label_id  - selecting database label id
 * @param $project_url  - data from project link input
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function update_project_url($db, $db_label_id, $project_url, $table_name)
{
    $query = $db->prepare("UPDATE `" . $table_name . "` SET `project_url` = :our_param WHERE `id` = \"" . $db_label_id . "\";");
    $query->bindParam(":our_param", $project_url);
    return $query->execute();
}

/*
 * edit_form()          - updating existing item in database
 * @param $label        - data from label fields
 * @param $description  - data from description fields
 * @param $img_url      - name of chosen file to upload
 * @param $project_url  - data from project link input
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true;
 */
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

    return true;
}