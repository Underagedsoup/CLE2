<?php
require_once "database-info.php";

$db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;

    function getAllLessons(mysqli $db) {
        $query = "SELECT * FROM lessons";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
        $lessons[] = $row;
        }

        return $lessons;
    }

    function getLessons(mysqli $db) {
        $query = "SELECT * FROM lessons WHERE trial_lesson=0";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
        $lessons[] = $row;
        }

        return $lessons;
    }

    function getTrialLessons(mysqli $db) {
        $query = "SELECT * FROM lessons WHERE trial_lesson=1";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
        $lessons[] = $row;
        }

        return $lessons;
    }

    function insertReservation(msqli $db, $lesson_id, $name, $phone, $email) {
        $query = "INSERT INTO reservations (lesson_id, name, phone, email)
                  VALUES ('$lesson_id', '$name', '$phone', '$email')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }