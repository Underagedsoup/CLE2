<?php
require_once "database-info.php";

session_start();
        
$db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;

    function login(mysqli $db, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );

        $user = null;
        $row = mysqli_fetch_assoc($result);

        if ($row == null) {
            $checkPassword = $row['password'];
            if (password_verify($password, $checkPassword)) {
                $user = $row;
            } else {
                $user = 'Login failed';
            }
        } else {
            $user = 'Login failed';
        }
        
        return $user;
    }
    
    function register(mysqli $db, $name, $registerPassword, $phone, $email) {
        $hash = password_hash($registerPassword, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, password, phone, email)
                      VALUES ('$name', '$hash', '$phone', '$email')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }

    function getAllLessons(mysqli $db) {
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE()";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    function getLessons(mysqli $db) {
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE() AND trial_lesson=0";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    function getTrialLessons(mysqli $db) {
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE() AND trial_lesson=1";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    function getLesson(mysqli $db, $lessonId) {
        $query = "SELECT * FROM lessons WHERE id = '$lessonId'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );

        return $result;
    }

    function getReservations(mysqli $db) {
        $query = "SELECT * FROM `reservations`";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $reservations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reservations[] = $row;
        }

        return $reservations;
    }

    function getReservation(mysqli $db, $reservationId) {
        $query = "SELECT * FROM reservations WHERE id = '$reservationId'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query);

        return $result;
    }

    function insertReservations(mysqli $db, $lesson_id, $name, $phone, $email) {
        $flQuery = "SELECT * FROM `lessons` WHERE id=$lesson_id AND trial_lesson=0";
        $flResult = mysqli_query($db, $flQuery) or die ('Error: ' . $flQuery);

        $datetime = null;
        while ($row = mysqli_fetch_assoc($flResult)) {
            $datetime = $row['start_datetime'];
        }

        $lsnQuery = "SELECT * FROM `lessons` WHERE start_datetime >= '$datetime' LIMIT 10";
        $lsnResult = mysqli_query($db, $lsnQuery) or die ('Error: ' . $lsnQuery);

        $lessons = [];
        while ($row = mysqli_fetch_assoc($lsnResult)) {
            $lessons[] = $row;
        }

        $startDate = date('Y-m-d', strtotime($lessons[0]['start_datetime']));
        $endDate = date('Y-m-d', strtotime($lessons[9]['start_datetime']));

        $crsQuery = "INSERT INTO courses (start_date, end_date)
                     VALUES ('$startDate', '$endDate')";

        $course_id = null;
        if (mysqli_query($db, $crsQuery)) {
            $course_id = mysqli_insert_id($db);
          } else {
            echo 'Error: '.mysqli_error($db). ' with query ' . $crsQuery;
          }
        
        $query = "";
        $result = null;
        for ($x = 0; $x < count($lessons); $x++) {
            $lesson_id = $lessons[$x]['id'];

            $query = "INSERT INTO reservations (course_id, lesson_id, name, phone, email)
                      VALUES ('$course_id', '$lesson_id', '$name', '$phone', '$email')";
            $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

            if (!$result) {
                break;
            }
        }

        return $result;
    }

    function updateReservation(mysqli $db, $id, $lesson_id, $name, $phone, $email) {
        $query = "UPDATE reservations
                  SET lesson_id='$lesson_id', name='$name', phone='$phone', email='$email'
                  WHERE id=$id";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }

    function deleteReservation(mysqli $db, $id) {
        $query = "DELETE FROM reservations WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }
    
// Set your timezone!!
date_default_timezone_set('Europe/Amsterdam');
