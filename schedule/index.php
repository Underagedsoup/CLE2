<?php
require_once "../includes/database.php";

$reservations = getReservations($db);

for ($x=0; $x < count($reservations); $x++) {
    $result = getLesson($db, $reservations[$x]['lesson_id']);
    
    if (mysqli_num_rows($result) == 1) {
        $reservations[$x]['lesson'] = mysqli_fetch_assoc($result);
    } else {
        $reservations[$x]['lesson'] = '';
    }
}

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
                <a href="create.php" class="btn btn-maroon rounded-pill">Cursus/Proefles registreren</a>
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
                            <th>Lestijden</th>
                            <th <?= isset($_SESSION['user']) ? '' : 'colspan="3"'; ?>></th>
                        </tr>
                    </thead>
                    <tbody class="border border-maroon">
                        <?php foreach ($reservations as $index => $reservation) { ?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><?= $reservation['name']; ?></td>
                                <td><?= $reservation['phone']; ?></td>
                                <td><?= $reservation['email']; ?></td>
                                <td><?= date('H:i', strtotime($reservation['lesson']['start_datetime'])) . ' - ' . date('H:i | j-m-Y', strtotime($reservation['lesson']['end_datetime'])); ?></td>
                                <td><a href="details.php?id=<?= $reservation['id']; ?>">Details</a></td>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <td><a href="edit.php?id=<?= $reservation['id']; ?>">Bewerken</a></td>
                                    <td><a href="delete.php?id=<?= $reservation['id']; ?>">Annuleren</a></td>
                                <?php } ?>
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