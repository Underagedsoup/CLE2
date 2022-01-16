<?php
require_once "../includes/database.php";
require_once "calendar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <title>Home</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-black">
            <ul class="col-md-12 nav p-0 d-flex justify-content-around align-items-center">
                <li class="nav-brand">
                    <img src="../images/SRDC-Logo.png" alt="">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="">Lessen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="#">Workshops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="../parties">Parties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="#">Shows</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="../login.php">Inloggen</a>
                </li>
            </ul>
        </div>
        <div class="row py-3 d-flex justify-content-around">
            <div class="col-md-3 text-center">
                <span class="btn text-maroon"><?= $titles['yearmonth']; ?></span>
            </div>
            <div class="col-md-3 text-center">
                <div class="btn-group border border-maroon rounded-pill" role="group">
                    <a href="?year=<?=$prev['year'];?>&week=<?=$prev['week'];?>" class="btn btn-outline-maroon"><</a>
                    <button type="button" class="btn btn-outline-maroon"><?= $titles['week']; ?></button>
                    <a href="?year=<?=$next['year'];?>&week=<?=$next['week'];?>" class="btn btn-outline-maroon">></a>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <a href="create.php" class="btn btn-maroon rounded-pill">Cursus registreren</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <table class="table table-borderless">
                    <thead class="border border-maroon">
                        <tr>
                            <?php foreach ($week as $day) { ?>
                                <th class="text-center"><?= $day['day']; ?><br><?= $day['date']; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody class="border border-maroon">
                        <tr>
                            <?php foreach ($week as $day) { ?>
                                <td>
                                    <?php foreach ($day['hours'] as $hour) { ?>
                                        <div class="text-center">
                                            <?= $hour['time']; ?>
                                        </div>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>