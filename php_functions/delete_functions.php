<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 04/10/2017
 * Time: 13:37
 */

/*
 *  delete_item()       - removing item from database
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function delete_item($table_name) {
    $db = connection();
    $remove_content_name = stripslashes($_POST['select_options']);

    $query = $db->prepare("DELETE FROM `" . $table_name . "` WHERE `label` = \"" . $remove_content_name . "\";");
    return $query->execute();
}