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
                <img src="images/SRDC-Banner.png" alt="" class="img-fluid">
            </div>
        </div>
        <div class="row bg-black">
            <div class="col-md-12 p-0 btn-group">
                <a class="btn btn-maroon border border-dark">Over ons</a>
                <a class="btn btn-maroon border border-dark">Contact</a>
            </div>
        </div>
    </div>
</body>
</html>