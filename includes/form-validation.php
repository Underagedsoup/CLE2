<?php
//Check if data is valid & generate error if not so
$errors = [];
if (isset($_POST['lesson_id'])) {
    if ($lesson_id == "") {
        $errors['lesson_id'] = 'Lesson must be chosen';
    }
}

if (isset($_POST['name'])) {
    if ($name == "") {
        $errors['name'] = 'Name cannot be empty';
    }
}

if (isset($_POST['phone'])) {
    if (!is_numeric(preg_replace('/[\s]+/', '', $phone))) {
        $errors['phone'] = 'Phone cannot contain letters';
    }

    if ($phone == "") {
        $errors['phone'] = 'Phone cannot be empty';
    }
}

if (isset($_POST['email'])) {
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        $errors['email'] = 'Email invalid';
    }

    if ($email == "") {
        $errors['email'] = 'Email cannot be empty';
    }
}
