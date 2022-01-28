<?php
require_once "includes/database.php";

//Close connection
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-black">
            <?php require_once "includes/navigation-bar.php"; ?>
        </div>
        <div class="row bg-black">
            <div class="col-md-12 p-0 d-flex justify-content-center">
                <img src="images/SRDC-Banner.png" alt="" class="img-fluid position-relative">
                <a href="schedule/create.php" class="btn btn-maroon position-absolute top-50 start-50 translate-middle">Proefles registreren</a>
            </div>
        </div>
        <div class="row bg-black">
            <div class="col-md-12 p-0 btn-group">
                <a class="btn btn-maroon border border-dark">Over ons</a>
                <a class="btn btn-maroon border border-dark">Contact</a>
            </div>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-9">
                <h1>Lorum Ipsum</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                    ut labore et dolore magna aliqua. Adipiscing at in tellus 
                    integer feugiat scelerisque varius. Tortor aliquam nulla facilisi cras fermentum odio. 
                    Pellentesque habitant morbi tristique senectus. Sollicitudin ac orci phasellus egestas. 
                    Quam pellentesque nec nam aliquam sem et tortor. Adipiscing at in tellus integer feugiat scelerisque varius morbi. 
                    Natoque penatibus et magnis dis parturient montes. Morbi non arcu risus quis varius quam. 
                    Suspendisse potenti nullam ac tortor vitae. Nunc id cursus metus aliquam eleifend mi. 
                    In eu mi bibendum neque egestas congue quisque egestas. Sodales ut etiam sit amet nisl. 
                    Sollicitudin aliquam ultrices sagittis orci a scelerisque purus. 
                    Etiam non quam lacus suspendisse faucibus interdum. In iaculis nunc sed augue lacus.
                    <br><br>
                    Lobortis elementum nibh tellus molestie nunc non blandit. Est pellentesque elit 
                    ullamcorper dignissim cras. Viverra mauris in aliquam sem. Iaculis at erat pellentesque adipiscing 
                    commodo elit at imperdiet dui. Tortor vitae purus faucibus ornare suspendisse. 
                    Fames ac turpis egestas maecenas pharetra convallis. Et netus et malesuada fames ac turpis. 
                    Commodo odio aenean sed adipiscing diam donec. Faucibus in ornare quam viverra orci sagittis eu volutpat. 
                    A lacus vestibulum sed arcu non odio. Urna porttitor rhoncus dolor purus non enim.
                </p>
            </div>
        </div>
    </div>
</body>
</html>