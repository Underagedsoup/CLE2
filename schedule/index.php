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
            <?php require_once "../includes/navigation-bar.php"; ?>
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