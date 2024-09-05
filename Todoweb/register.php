<!doctype html>
<html lang="hu">
  <head>
    <title>Teendő - Regisztráció</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

    <?php
    include('dbconnect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $felhasznalonev = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $jelszo = $conn->real_escape_string($_POST['password']);
        $jelszo2 = $conn->real_escape_string($_POST['password2']);
        
        if ($jelszo != $jelszo2) {
            echo "<div class='alert alert-danger text-center'>A jelszavak nem egyeznek meg!</div>";
        } else {
            $hashed_password = password_hash($jelszo, PASSWORD_BCRYPT);

            $sql = "INSERT INTO felhasznalok (userName, email, password) VALUES ('$felhasznalonev', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success text-center'>Regisztráció sikeres! <a href='login.php'>Bejelentkezés</a></div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Hiba történt: " . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>
      
    <div class=" d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Regisztráció</h3>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Felhasználónév</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Felhasználóneved" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email cím</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email címed" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Jelszó</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Jelszavad" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Jelszó 2*</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Jelszavad 2*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Regisztráció</button>
                    </form>
                    <div class="mt-3">
                        <a href="login.php" class="btn btn-secondary w-100">Vissza a bejelentkezéshez</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>