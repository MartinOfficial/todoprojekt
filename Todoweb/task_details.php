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

    switch ($feladat['priority']) {
        case 1:
            $prioritas_szoveg = "Alacsony";
            break;
        case 2:
            $prioritas_szoveg = "Közepes";
            break;
        case 3:
            $prioritas_szoveg = "Magas";
            break;
        default:
            $prioritas_szoveg = "Ismeretlen";
            break;
    }

} else {
    header("Location: tasks.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teendő - Feladat részletei</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        background-color: #fefff1;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h1><?php echo ($feladat['taskName']); ?></h1>
    <p><strong>Prioritás:</strong> <?php echo $prioritas_szoveg; ?></p>
    <p><strong>Határidő:</strong> <?php echo $feladat['deadline']; ?></p>
    <p><?php echo nl2br(($feladat['taskDetail'])); ?></p>

    <a href="task_edit.php?id=<?php echo $feladat['taskId']; ?>" class="btn btn-warning">Módosítás</a>
    <a href="task_delete.php?id=<?php echo $feladat['taskId']; ?>" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a feladatot?');">Törlés</a>
</div>

<?php include('footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>