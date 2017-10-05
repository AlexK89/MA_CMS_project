<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 21/09/2017
 * Time: 14:22
 */

$our_user = "Vasile";
$our_user_pass = "123";

session_start();

/*
 *  submit_form checking inputs to be field
 * @params $our_user        - user name from database;
 * @params $our_user_pass   - user password from database;
 * @params $post_user_name  - provided name by user;
 * @params $post_password   - provided password by user;
 *
 * @return success          - run session_data function to check username and user password
 * @return fail string      - return request to fill inputs
 */
function submit_form($our_user, $our_user_pass, $post_user_name, $post_password) {
    if (!(empty($post_user_name) || empty($post_password))) {
        return session_data($our_user, $our_user_pass, $post_user_name, $post_password);
    } else {
        return "<p style='color:red;' class='error'>Please provide login and pass</p>";
    }
}

/*
 * session_data checking provided login and password with database data
 * @params $our_user        - user name from database;
 * @params $our_user_pass   - user password from database;
 * @params $post_user_name  - provided name by user;
 * @params $post_password   - provided password by user;
 * @return success          - redirect to welcome page;
 * @return fail             - message that wrong data provided;
 */
function session_data($our_user, $our_user_pass, $post_user_name, $post_password) {
    if ($our_user === stripslashes($post_user_name) && $our_user_pass === stripslashes($post_password)) {
        $_SESSION['user'] = $post_user_name;
        $_SESSION['password'] = $post_password;
        return 1;
    } else {
        return "<p style='color:red;' class='error'>Wrong pass or name</p>";
    }
}

/*
 * check_data checking is the name and password in session equals to data in database
 * @params $our_user        - user name from database;
 * @params $our_user_pass   - user password from database;
 * return number            - imitates true or false;
 */
function check_data($our_user, $our_user_pass) {
    $session_name = $_SESSION['user'];
    $session_pass = $_SESSION['password'];
    if ($session_name ===  $our_user &&  $session_pass=== $our_user_pass) {
        return 1;
    } else {
        return 0;
    }
}

if  (isset($_POST["submit"])){
    if (submit_form($our_user, $our_user_pass, $_POST["user_name"], $_POST["password"]) === 1) {
        header("Location: main_page.php");
    } else {
        echo submit_form($our_user, $our_user_pass, $_POST["user_name"], $_POST["password"]);
    }

}
if (isset($_POST["destroy"])) {
//    echo "destroy";
    session_destroy();
}