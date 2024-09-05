<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cim = $_POST['cim'];
    $feladat = $_POST['feladat'];
    $prioritas = $_POST['prioritas'];
    $hatarido = $_POST['hatarido'];
    $userid = $_SESSION['userid'];

    $query = "INSERT INTO feladat (userId, taskName, taskDetail, priority, deadline) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issis", $userid, $cim, $feladat, $prioritas, $hatarido);

    if ($stmt->execute()) {
        header("Location: tasks.php");
        exit();
    } else {
        echo "Hiba történt a feladat hozzáadása során.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teendők - Feladat hozzáadása</title>
    <!-- Bootstrap CSS -->
    <style>
        body {
        background-color: #fefff1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h1>Új feladat hozzáadása</h1>
    <form method="post" action="add_task.php">
        <div class="mb-3">
            <label for="cim" class="form-label">Feladat címe</label>
            <input type="text" class="form-control" id="cim" name="cim" required>
        </div>
        <div class="mb-3">
            <label for="feladat" class="form-label">Feladat leírása</label>
            <textarea class="form-control" id="feladat" name="feladat" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prioritas" class="form-label">Prioritás</label>
            <select class="form-select" id="prioritas" name="prioritas" required>
                <option value="1">Alacsony</option>
                <option value="2">Közepes</option>
                <option value="3">Magas</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="hatarido" class="form-label">Határidő</label>
            <input type="datetime-local" class="form-control" id="hatarido" name="hatarido" required>
        </div>
        <button type="submit" class="btn btn-primary">Feladat hozzáadása</button>
    </form>
</div>

<?php include('footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>