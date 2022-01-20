<?php
require_once "../includes/database.php";

$reservations = getReservations($db);

//Close connection
mysqli_close($db);
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
            <ul class="col-md-12 nav p-0 d-flex justify-content-around align-items-center">
                <li class="nav-brand">
                    <a href="../">
                        <img src="../images/SRDC-Logo.png" alt="">
                    </a>
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
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-maroon dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Admin</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profiel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-maroon" href="login.php">Inloggen</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="row py-3">
            <div class="col-md-12">
                <a href="create.php" class="btn btn-maroon rounded-pill">Cursus registreren</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <table class="table table-borderless">
                    <thead class="border border-maroon">
                        <tr>
                            <th>#</th>
                            <th>Naam</th>
                            <th>Telefoonnummer</th>
                            <th>Email</th>
                            <th>Les</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="border border-maroon">
                        <?php foreach ($reservations as $index => $reservation) { ?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><?= $reservation['name'] ?></td>
                                <td><?= $reservation['phone'] ?></td>
                                <td><?= $reservation['email'] ?></td>
                                <td><?= $reservation['lesson_id'] ?></td>
                                <td><a href="details.php?id=<?= $reservation['id']; ?>">Details</a></td>
                                <td><a href="edit.php?id=<?= $reservation['id']; ?>">Bewerken</a></td>
                                <td><a href="delete.php?id=<?= $reservation['id']; ?>">Annuleren</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot class="border border-maroon">
                        <tr>
                            <td colspan="9">&copy; Reservations</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>