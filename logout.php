<?php
session_start();

//reset session variable
session_destroy();

//if logged out, cookies will be deleted and not remember me any more
setcookie('username', '', 0);
setcookie("email", '', 0);
setcookie("user_id", '', 0);
setcookie("type", '', 0);
setcookie("remember", '', 0);

//redirect to login
header('location:index.php');
?>
