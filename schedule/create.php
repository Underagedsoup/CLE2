<?php
// Require DB settings with connection variable
require_once "../includes/database.php";

// Get trial lessons and lessons from the database with SQL queries
$trialLessons = getTrialLessons($db);
$lessons = getLessons($db);

// Check if form has been submitted
if (isset($_POST['submit'])) {
    // if trial_lesson is given, set trial_lesson true
    isset($_POST['trial_lesson']) ? $trial_lesson = mysqli_escape_string($db, true) : $trial_lesson = mysqli_escape_string($db, false);
    $lesson_id = mysqli_escape_string($db, $_POST['lesson_id']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    
    // Require form-validations
    require_once "../includes/form-validation.php";

    if (empty($errors)) {
        // insert reservation into database table
        $result = insertReservations($db, $trial_lesson, $lesson_id, $name, $phone, $email);

        if ($result) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/CLE/schedule/');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
}

// Close connection
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
    <title>Create Reservation</title>
    <script>
        // Display trial lessons or lessons
        function isTrialLesson() {
            if (trialCheck.checked) {
                trialLessons.style.display = "block";
                lessons.style.display = "none";
            } else {
                trialLessons.style.display = "none";
                lessons.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-black">
            <!-- Require navigation-bar -->
            <?php require_once "../includes/navigation-bar.php"; ?>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <a href="../schedule" class="btn btn-maroon rounded-pill">Terug</a>
            </div>
        </div>
        <div class="row py-3 d-flex justify-content-center">
            <div class="col-md-10">
                <!-- create form -->
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Trial lesson checkbox -->
                    <div class="mb-3 form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="trial_lesson" class="form-check-input" id="trialLesson" onclick="isTrialLesson()" <?= isset($trial_lesson) && $trial_lesson == true ? 'checked' : '' ?>>Proefles nemen?
                        </label>
                        <span class="text-danger"><?= isset($errors['trial_lesson']) ? $errors['trial_lesson'] : ''; ?></span>
                    </div>
                    <!-- Trial-lesson/Lesson list -->
                    <div class="mb-3">
                        <label for="lessons" class="form-label">Start van de cursus</label>
                        <select name="lesson_id" class="form-select" id="trialLessons">
                            <?php foreach ($trialLessons as $lesson) { ?>
                                <option value="<?= $lesson['id']; ?>" <?= isset($lesson_id) && $lesson['id'] == $lesson_id ? 'selected' : '' ?>><?= date('H:i \o\n l jS F Y', strtotime($lesson['start_datetime'])); ?></option>
                            <?php } ?>
                        </select>
                        <select name="lesson_id" class="form-select" id="lessons">
                            <?php foreach ($lessons as $lesson) { ?>
                                <option value="<?= $lesson['id']; ?>" <?= isset($lesson_id) && $lesson['id'] == $lesson_id ? 'selected' : '' ?>><?= date('H:i \o\n l jS F Y', strtotime($lesson['start_datetime'])); ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger"><?= isset($errors['lesson_id']) ? $errors['lesson_id'] : ''; ?></span>
                    </div>
                    <!-- Name input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= isset($name) ? htmlentities($name) : '' ?>">
                        <span class="text-danger"><?= isset($errors['name']) ? $errors['name'] : ''; ?></span>
                    </div>
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?= isset($email) ? htmlentities($email) : '' ?>">
                        <span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    </div>
                    <!-- Phone input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?= isset($phone) ? htmlentities($phone) : '' ?>">
                        <span class="text-danger"><?= isset($errors['phone']) ? $errors['phone'] : ''; ?></span>
                    </div>
                    <!-- Submit form -->
                    <div class="mb-3">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit" aria-describedby="contactHelp">
                        <div id="contactHelp" class="form-text">We'll never share your contact info with anyone else.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // Toggle between trial lessons and lessons
    let trialCheck = document.getElementById("trialLesson");
    let trialLessons = document.getElementById("trialLessons");
    let lessons = document.getElementById("lessons");
    
    if (trialCheck.checked) {
        trialLessons.style.display = "block";
        lessons.style.display = "none";
    } else {
        trialLessons.style.display = "none";
        lessons.style.display = "block";
    }
</script>
</html>