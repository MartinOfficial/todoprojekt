<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teendők - Menü</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown-menu {
            max-width: 200px;
            white-space: nowrap;
        }
        .dropdown-menu-end {
            right: 0;
            left: auto;
        }
        body {
            background-color: #fefff1;

        }
    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Teendők</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Főoldal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tasks.php">Feladataim</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo ($_SESSION['felhasznalonev']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="edit-profile.php">Profil szerkesztése</a></li>
                        <li><a class="dropdown-item" href="logout.php">Kijelentkezés</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>