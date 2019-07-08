<?php

//----------Secure connection-------------
if (!function_exists('my_session_start')) {

    function my_session_start($my_name) {
        session_set_cookie_params(60 * 60 * 24);
        session_name($my_name);
        session_start();
        session_regenerate_id();
    }

}
//-----------DB conection--------------
if (!function_exists('db_connect')) {

    function db_connect() {
        if ($link = mysqli_connect('localhost', 'root', '', 'middle_prj')) {
            return $link;
        } else {
            die('Data Base connection is unavaliable right now, please try later');
        }
    }

}
//-----------Check user--------------
if (!function_exists('confirm_user')) {

    function confirm_user() {
        $valid = FALSE;
        if (isset($_SESSION['uname']) && $_SERVER['REMOTE_ADDR'] == $_SESSION['ip_address']) {
            if ($_SERVER['HTTP_USER_AGENT'] == $_SESSION['HTTP_USER_AGENT']) {
                return $valid = TRUE;
            }
        }
        return $valid = FALSE;
    }

}
?>