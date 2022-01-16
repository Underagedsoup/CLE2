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

        $lsnQuery = "SELECT 10 FROM `lessons` WHERE start_datetime >= '$datetime'";
        $lsnResult = mysqli_query($db, $lsnQuery) or die ('Error: ' . $lsnQuery);

        $lessons = [];
        while ($row = mysqli_fetch_assoc($lsnResult)) {
            $lessons[] = $row;
        }
        
        $query = "";
        $result = null;
        for ($x = 0; $x < count($lessons); $x++) {
            $query = "INSERT INTO reservations (lesson_id, name, phone, email)
                      VALUES ('$lesson_id', '$name', '$phone', '$email')";
            $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

            if (!$result) {
                break;
            }
        }

        return $result;
    }