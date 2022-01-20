<?php
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "includes/database.php";

if(isset($_SESSION['user'])){
    header('Location: /CLE/');
    exit;
}

if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = mysqli_escape_string($db, $_POST['password']);
    
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        $data = login($db, $email, $password);

        if (empty($data['errors'])) {
            $_SESSION['user'] = $data['user'];
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
            exit;
        } else {
            $errors['login'] = $data['error'];
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
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
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-black">
            <ul class="col-md-12 nav p-0 d-flex justify-content-around align-items-center">
                <li class="nav-brand">
                    <a href="/CLE/">
                        <img src="../images/SRDC-Logo.png" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="schedule">Lessen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="#">Workshops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="parties">Parties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="#">Shows</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-maroon" href="login.php">Inloggen</a>
                </li>
            </ul>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?= isset($email) ? htmlentities($email) : '' ?>">
                        <span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="password" value="<?= isset($password) ? htmlentities($password) : '' ?>">
                        <span class="text-danger"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                        <span class="text-danger"><?= isset($errors['login']) ? $errors['login'] : ''; ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>