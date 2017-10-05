<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 05/10/2017
 * Time: 09:41
 */

$no_duplicates = true;

/*
 * duplicates_protection - checking input label for duplicates
 * @param $label - label input data
 * @param $no_duplicates - duplicates existence state
 * return boolean - true or false for duplicates existence
 */
function duplicates_protection($label, $no_duplicates)
{
    $data = get_items();
    foreach ($data as $item) {
        $content = $item["label"];
        if ($content === $label) {
            $no_duplicates = false;
            return $no_duplicates;
        }
    }
    return $no_duplicates;
}