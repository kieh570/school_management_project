<?php
session_start();

//DESTROY ALL SESSION DATA
$_SESSION = array();
session_destroy();

//CLEAR SESSION COOKIE
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["paths"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
}

//PREVENT CACHING
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

//REDIRECT TO LOGIN
header("Location: students_login.php");
exit();
?>
