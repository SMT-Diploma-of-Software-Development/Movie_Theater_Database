<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location: staff_portal_login.php");
    exit();
} elseif (!$_SESSION['account']['username'] == "admin") {
    header("Location: staff_portal_login.php");
    exit();
}
