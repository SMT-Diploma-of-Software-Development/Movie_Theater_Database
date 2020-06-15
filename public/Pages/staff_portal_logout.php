<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: staff_portal_login.php");
?>