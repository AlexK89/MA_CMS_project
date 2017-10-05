<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 21/09/2017
 * Time: 16:56
 */
use PHPUnit\Framework\TestCase;

require("../login_functions.php");

class StackTest extends TestCase
{
    const OUR_USER = "Vasile";
    const OUR_USER_PASS = "Hello123";
    const POST_USER_NAME = "";
    const POST_PASSWORD = "hello";

    /*
     * testsubmit_form_success test for fail message if function success
     */
    public function testsubmit_form_success()
    {
        $result = submit_form(self::OUR_USER, self::OUR_USER_PASS, self::OUR_USER, self::POST_PASSWORD);
        $expect = "<p style='color:red;'>Wrong pass or name</p>";
        $this -> assertEquals($expect, $result);
    }
    /*
    * testsubmit_form_fail test is the main function return request to provide name and password
    */
    public function testsubmit_form_fail()
    {
        $result = submit_form(self::OUR_USER, self::OUR_USER_PASS, self::POST_USER_NAME, self::POST_PASSWORD);
        $expect = "<p style='color:red;'>Please provide login and pass</p>";
        $this -> assertEquals($expect, $result);
    }
    /*
     * testsession_data_success - if name and pass equals in database and provided one
     * main function should return 1(true)
     */
    public function testsession_data_success() {
        $result = session_data(self::OUR_USER, self::OUR_USER_PASS, self::OUR_USER, self::OUR_USER_PASS);
        $expect = 1;
        $this -> assertEquals($expect, $result);
    }
    /*
     * testsession_data_success - if name and pass not equals in database and provided one
     * main function should return 0(false)
     */
    public function testsession_data_fail() {
        $result = session_data(self::OUR_USER, self::OUR_USER_PASS, self::POST_USER_NAME, self::OUR_USER_PASS);
        $expect = "<p style='color:red;'>Wrong pass or name</p>";
        $this -> assertEquals($expect, $result);
    }
}