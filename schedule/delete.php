<?php
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "../includes/database.php";

if (isset($_POST['submit'])) {
    $id = mysqli_escape_string($db, $_POST['id']);
    
    require_once "../includes/form-validation.php";

    if (empty($errors)) {
        $result = deleteReservation($db, $id);

        if ($result) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
} else if (isset($_GET['id']) || $_GET['id'] != '') {
    $reservationId = mysqli_escape_string($db, $_GET['id']);

    $result = getReservation($db, $reservationId);

    if (mysqli_num_rows($result) == 1) {
        $reservation = mysqli_fetch_assoc($result);
        
        $lResult = getLesson($db, $reservation['lesson_id']);

        if (mysqli_num_rows($lResult) == 1) {
            $reservation['lesson'] = mysqli_fetch_assoc($lResult);
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
            exit;
        }
    } else {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
        exit;
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
    exit;
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
    <title>Delete Reservation</title>
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
                    <a class="nav-link text-maroon" href="../schedule">Lessen</a>
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
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <a href="../schedule" class="btn btn-maroon rounded-pill">Terug</a>
            </div>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <h2>Verwijder de reservatie</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p>Weet u zeker dat u de reservatie voor les van <?= date('l jS F Y \o\n H:i', strtotime($reservation['lesson']['start_datetime'])) . ' - ' . date('H:i', strtotime($reservation['lesson']['end_datetime'])); ?> wilt verwijderen?</p>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>"/>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit" aria-describedby="contactHelp">
                        <div id="contactHelp" class="form-text">We'll never share your contact info with anyone else.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>