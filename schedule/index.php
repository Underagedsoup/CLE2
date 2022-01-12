<?php
require_once "calendar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                    <a class="nav-link text-maroon" href="schedule">Lessen</a>
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
        <div class="row">
            <div class="col-md-12">
                <h3><a href=""><</a> <?php echo $title; ?> <a href="">></a></h3>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Maandag</th>
                            <th>Dinsdag</th>
                            <th>Woensdag</th>
                            <th>Donderdag</th>
                            <th>Vrijdag</th>
                            <th>Zaterdag</th>
                            <th>Zondag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($week as $day) { ?>
                                <?php if (!empty($day)) { ?>
                                    <?php if ($day['date'] > $today) { ?>
                                        <td>
                                            <?= $day['number'] ?>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <?= $day['number'] ?>
                                        </td>
                                    <?php } ?>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>