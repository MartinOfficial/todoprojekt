<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $feladat_id = $_GET['id'];

    $query = "DELETE FROM feladat WHERE taskId = ? AND userId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $feladat_id, $_SESSION['userid']);

    if ($stmt->execute()) {
        header("Location: tasks.php");
        exit();
    } else {
        echo "Hiba történt a feladat törlése során.";
    }

    $stmt->close();
} else {
    header("Location: tasks.php");
    exit();
}

$conn->close();
?>