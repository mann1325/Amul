<?php
session_start();
require_once "user_functions.php";

if (isset($_COOKIE['remember_me_cookie'])) {
    $cookie_data = json_decode(base64_decode($_COOKIE['remember_me_cookie']), true);
    $email = $cookie_data['email'];
    deleteTokenForUser($email);
    unset($_COOKIE['remember_me_cookie']);
    setcookie('remember_me_cookie', '', time() - 3600, '/');
}


$_SESSION = array();


session_destroy();


header("Location: login_page.php");
exit();
?>