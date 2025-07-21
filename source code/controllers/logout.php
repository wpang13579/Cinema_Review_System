<?php
// session_start();
// if(session_destroy()){
//     header("Location: login.php");
//     exit();
// }
session_start();
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
session_destroy();
$cookie_name = "user";
setcookie($cookie_name, "", time() - 3600, "/");
header("Location: ../views/main.php");
exit();
