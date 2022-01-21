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
    <title>Schedule</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-black">
            <?php require_once "../includes/navigation-bar.php"; ?>
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
            <div class="col-md-1">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <br>
                                <br>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php for ($x=0; $x <= $hour_count; $x++) { ?>
                                    <div class="text-center">
                                        <?= date("H:i", mktime($x, 0, 0, 0, 0, 0)); ?>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-9">
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
                                            <?= isset($hour['lessons']) ? $hour['time'] : ''; ?>
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