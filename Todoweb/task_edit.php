<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $feladat_id = $_GET['id'];

    $query = "SELECT * FROM feladat WHERE taskId = ? AND userId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $feladat_id, $_SESSION['userid']);
    $stmt->execute();
    $result = $stmt->get_result();
    $feladat = $result->fetch_assoc();

    if (!$feladat) {
        echo "Nincs ilyen feladat, vagy nincs jogosultságod megtekinteni.";
        exit();
    }

} else {
    header("Location: tasks.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cim = $_POST['cim'];
    $feladat_leiras = $_POST['feladat'];
    $prioritas = $_POST['prioritas'];
    $hatarido = $_POST['hatarido'];

    $query = "UPDATE feladat SET taskName = ?, taskDetail = ?, priority = ?, deadline = ? WHERE taskId = ? AND userId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssissi", $cim, $feladat_leiras, $prioritas, $hatarido, $feladat_id, $_SESSION['userid']);

    if ($stmt->execute()) {
        header("Location: tasks.php");
        exit();
    } else {
        echo "Hiba történt a feladat frissítése során.";
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
    <title>Teendők - Feladat módosítása</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h1>Feladat módosítása</h1>
    <form method="post" action="task_edit.php?id=<?php echo $feladat['taskId']; ?>">
        <div class="mb-3">
            <label for="cim" class="form-label">Feladat címe</label>
            <input type="text" class="form-control" id="cim" name="cim" value="<?php echo ($feladat['taskName']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="feladat" class="form-label">Feladat leírása</label>
            <textarea class="form-control" id="feladat" name="feladat" rows="5" required><?php echo ($feladat['taskDetail']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="prioritas" class="form-label">Prioritás</label>
            <select class="form-select" id="prioritas" name="prioritas" required>
                <option value="1" <?php if ($feladat['priority'] == 1) echo 'selected'; ?>>Alacsony</option>
                <option value="2" <?php if ($feladat['priority'] == 2) echo 'selected'; ?>>Közepes</option>
                <option value="3" <?php if ($feladat['priority'] == 3) echo 'selected'; ?>>Magas</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="hatarido" class="form-label">Határidő</label>
            <input type="datetime-local" class="form-control" id="hatarido" name="hatarido" value="<?php echo date('Y-m-d', strtotime($feladat['deadline'])); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Feladat frissítése