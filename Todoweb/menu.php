<!doctype html>
<html lang="hu">
  <head>
    <title>Teendők - Főoldal</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php
    session_start();
    if (!isset($_SESSION['felhasznalonev'])) {
        header("Location: login.php");
        exit;
    }

    include('header.php');
    ?>

    <div class="container mt-5">
        <h1 class="text-center">Üdvözlünk, <?php echo ($_SESSION['felhasznalonev']); ?>!</h1>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-2">
            <div class="fb-page" data-href="https://www.facebook.com/hengersor" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/hengersor" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/hengersor">BGSZC Pestszentlőrinci Technikum (Hengersor)</a>
                </blockquote>
            </div>
        </div>
    </div>



    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="Xn6DP6o2"></script>

    <?php
    include('footer.php');
?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>