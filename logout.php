<?php
session_start();
session_destroy();

// Clear all cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Clear additional cookies if any
setcookie('username', '', time() - 3600, '/');
setcookie('PHPSESSID', '', time() - 3600, '/');

header('Location: login.php');
exit;
?>
