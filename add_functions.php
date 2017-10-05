<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 04/10/2017
 * Time: 12:27
 */
/*
 *  add_content()       - adding content to database
 * @param $label        - label input data
 * @param $description  - description input data
 * @param $img_url      - name of uploading file
 * @param $project_url  - project url from input
 * @param $table_name   - database data table name
 * return boolean       - executing query and return true or false;
 */
function add_content($label, $description, $img_url, $project_url, $table_name) {
    $db = connection();
    $query = $db->prepare("INSERT INTO `" . $table_name . "` (`label`, `description`, `img_url`) VALUE (:label, :description, :img_url);");
    if ($project_url) {
        $query = $db->prepare("INSERT INTO `" . $table_name . "` (`label`, `description`, `img_url`, `project_url`) VALUE (:label, :description, :img_url, :project_url);");
        $query->bindParam(":project_url", $project_url);
    }
    $query->bindParam(":label", $label);
    $query->bindParam(":description", $description);
    $query->bindParam(":img_url", $img_url);

    return $query->execute();
}
