<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

$query = "SELECT * FROM feladat WHERE userId = ? ORDER BY priority DESC, deadline ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teendők - Feladataim</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .feladat {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .prioritas-3 { background-color: #ffdddd; }
        .prioritas-2 { background-color: #fff4dd; }
        .prioritas-1 { background-color: #ddffdd; }
        .lejart { color: red; font-weight: bold; }
        body {
        background-color: #fefff1;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Feladataim</h1>
        <a href="add_task.php" class="btn btn-primary">Feladat hozzáadása</a>
    </div>

    <div class="mt-4">
        <?php while ($row = $result->fetch_assoc()): 
            $hatarido = new DateTime($row['deadline']);
            $most = new DateTime();
            $interval = $most->diff($hatarido);
            $hatra = $interval->format('%a nap %h óra %i perc %s másodperc');
            $lejart = $most > $hatarido;
        ?>
            <div class="feladat prioritas-<?php echo ($row['priority']); ?>">
                <h3><?php echo ($row['taskName']); ?></h3>
                <p><strong>Határidő:</strong> <?php echo ($row['deadline']); ?></p>
                <?php if ($lejart): ?>
                    <p class="lejart">Lejárt</p>
                <?php else: ?>
                    <p><strong>Hátralévő idő:</strong> <?php echo $hatra; ?></p>
                <?php endif; ?>
                
                <a href="task_details.php?id=<?php echo $row['taskId']; ?>" class="btn btn-info">Részletek</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include('footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>