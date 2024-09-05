<?php
include('dbconnect.php');

session_start();
//var_dump($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $jelszo = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM felhasznalok WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($jelszo, $row['password'])) {
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['felhasznalonev'] = $row['UserName'];

            header("Location: menu.php");
            exit;
        } else {
            echo "<div class='alert alert-danger text-center'>Hibás jelszó!</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Nincs ilyen felhasználó!</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teendők - Bejelentkezés</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        background-color: #fefff1;
        }
        .card {
        background-color: #9eac88;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Bejelentkezés</h3>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email cím</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email címed" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Jelszó</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Jelszavad" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Bejelentkezés</button>
                    </form>
                    <div class="mt-3">
                        <a href="register.php" class="btn btn-secondary w-100">Regisztráció</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>