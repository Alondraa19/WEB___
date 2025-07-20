<?php
session_start();
session_destroy();

setcookie("nombre", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");

header("Location: ../html/html/login.php");
exit();
?>