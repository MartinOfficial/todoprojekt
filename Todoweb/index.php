<?php
session_start();

if (isset($_SESSION['felhasznalonev'])) {
    header("Location: menu.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>