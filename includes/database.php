<?php
require_once "database-info.php";

$db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;

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