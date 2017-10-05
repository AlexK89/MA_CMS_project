<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 02/10/2017
 * Time: 10:25
 */

function connection()
{
    $db = new PDO("mysql:host=127.0.0.1;dbname=CMS_project_database", "root" , "");
    return $db;
}
