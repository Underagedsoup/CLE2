<?php
//Require DB settings with connection variable
require_once "includes/database.php";

// Check if form has been submitted
if (isset($_POST['submit'])) {
    $name = mysqli_escape_string($db, $_POST['name']);
    $registerPassword = mysqli_escape_string($db, $_POST['register_password']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    
    // Require form-validations
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        $result = register($db, $name, $registerPassword, $phone, $email);

        if ($result) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/login.php');
            exit;
        } else {
            $errors['register'] = $data['errors'];
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
            <!-- Require navigation-bar -->
            <?php require_once "includes/navigation-bar.php"; ?>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <!-- login form -->
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Name input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Naam</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= isset($name) ? htmlentities($name) : '' ?>">
                        <span class="text-danger"><?= isset($errors['name']) ? $errors['name'] : ''; ?></span>
                    </div>
                    <!-- Password input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?= isset($password) ? htmlentities($password) : '' ?>">
                        <span class="text-danger"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
                    </div>
                    <!-- Phone input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefoonnummer</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?= isset($phone) ? htmlentities($phone) : '' ?>">
                        <span class="text-danger"><?= isset($errors['phone']) ? $errors['phone'] : ''; ?></span>
                    </div>
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email adres</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?= isset($email) ? htmlentities($email) : '' ?>">
                        <span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    </div>
                    <!-- Submit form -->
                    <div class="mb-3">
                        <input type="submit" name="submit" class="btn btn-primary" value="Register">
                        <span class="text-danger"><?= isset($errors['register']) ? $errors['register'] : ''; ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>