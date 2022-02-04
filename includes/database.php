<?php
// Require DB settings with connection variable
require_once "database-info.php";

// Start session
session_start();

// Create connection to the database
$db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;

    /**
     * Function: login
     * Description: This function logs in the user by 
     * verifying the given password.
     */
    function login(mysqli $db, $email, $password) {
        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare query and execute
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );

        $user = null;
        $row = mysqli_fetch_assoc($result);

        if ($row == null) {
            // Verify password
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
    
    /**
     * Function: register
     * Description: This function registers a new user.
     */
    function register(mysqli $db, $name, $registerPassword, $phone, $email) {
        // Hash password
        $hash = password_hash($registerPassword, PASSWORD_DEFAULT);
        
        // Prepare query and execute
        $query = "INSERT INTO users (name, password, phone, email)
                      VALUES ('$name', '$hash', '$phone', '$email')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }

    /**
     * Function: getAllLessons
     * Description: This function gets all the lessons
     * from the database table starting from current date.
     */
    function getAllLessons(mysqli $db) {
        // Prepare query and execute
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE()";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    /**
     * Function: getLessons
     * Description: This function gets all the lessons 
     * from the database table where trial_lesson = 0 starting from current date.
     */
    function getLessons(mysqli $db) {
        // Prepare query and execute
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE() AND trial_lesson=0";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    /**
     * Function: getTrialLessons
     * Description: This function gets all the lessons 
     * from the database table where trial_lesson = 1 starting from current date.
     */
    function getTrialLessons(mysqli $db) {
        // Prepare query and execute
        $query = "SELECT * FROM `lessons` WHERE start_datetime >= CURDATE() AND trial_lesson=1";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $lessons = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons[] = $row;
        }

        return $lessons;
    }

    /**
     * Function: getLesson
     * Description: This function gets the lesson with the 
     * given lessonId from the database table.
     */
    function getLesson(mysqli $db, $lessonId) {
        // Prepare query and execute
        $query = "SELECT * FROM lessons WHERE id = '$lessonId'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );

        return $result;
    }

    /**
     * Function: getReservations
     * Description: This function gets all the reservations 
     * from the database table.
     */
    function getReservations(mysqli $db) {
        // Prepare query and execute
        $query = "SELECT * FROM `reservations`";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query );
        
        $reservations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reservations[] = $row;
        }

        return $reservations;
    }

    /**
     * Function: getReservation
     * Description: This function gets the reservation with the 
     * given reservationId from the database table.
     */
    function getReservation(mysqli $db, $reservationId) {
        // Prepare query and execute
        $query = "SELECT * FROM reservations WHERE id = '$reservationId'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query);

        return $result;
    }

    /**
     * Function: insertReservations
     * Description: This function inserts a new reservation into the database table.
     */
    function insertReservations(mysqli $db, $trial_lesson, $lesson_id, $name, $phone, $email) {
        // Check if trial_lesson is true or false
        if ($trial_lesson == mysqli_escape_string($db, true)) {
            // Prepare query and execute
            $query = "INSERT INTO reservations (course_id, lesson_id, name, phone, email)
                    VALUES (null, '$lesson_id', '$name', '$phone', '$email')";
            $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);
        } else {
            // Prepare query and execute
            $flQuery = "SELECT * FROM `lessons` WHERE id=$lesson_id AND trial_lesson=0";
            $flResult = mysqli_query($db, $flQuery) or die ('Error: ' . $flQuery);

            $datetime = null;
            while ($row = mysqli_fetch_assoc($flResult)) {
                $datetime = $row['start_datetime'];
            }

            // Prepare query and execute
            $lsnQuery = "SELECT * FROM `lessons` WHERE start_datetime >= '$datetime' LIMIT 10";
            $lsnResult = mysqli_query($db, $lsnQuery) or die ('Error: ' . $lsnQuery);

            $lessons = [];
            while ($row = mysqli_fetch_assoc($lsnResult)) {
                $lessons[] = $row;
            }

            // Get startDate & endDate of
            $startDate = date('Y-m-d', strtotime($lessons[0]['start_datetime']));
            $endDate = date('Y-m-d', strtotime($lessons[9]['start_datetime']));

            // Prepare query and execute & Set course_id variable
            $crsQuery = "INSERT INTO courses (start_date, end_date)
                        VALUES ('$startDate', '$endDate')";
            
            $course_id = null;
            if (mysqli_query($db, $crsQuery)) {
                $course_id = mysqli_insert_id($db);
            } else {
                echo 'Error: '.mysqli_error($db). ' with query ' . $crsQuery;
            }
            
            // Set query & result variable
            $query = "";
            $result = null;
            for ($x = 0; $x < count($lessons); $x++) {
                // Set lesson_id variable for each course_reservation
                $lesson_id = $lessons[$x]['id'];

                // Prepare query and execute
                $query = "INSERT INTO reservations (course_id, lesson_id, name, phone, email)
                        VALUES ('$course_id', '$lesson_id', '$name', '$phone', '$email')";
                $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

                if (!$result) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Function: updateReservation
     * Description: This function updates the reservation 
     * with the given id from the database table.
     */
    function updateReservation(mysqli $db, $id, $lesson_id, $name, $phone, $email) {
        // Prepare query and execute
        $query = "UPDATE reservations
                  SET lesson_id='$lesson_id', name='$name', phone='$phone', email='$email'
                  WHERE id=$id";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }

    /**
     * Function: deleteReservation
     * Description: This function deletes the reservation 
     * with the given id from the database table.
     */
    function deleteReservation(mysqli $db, $id) {
        // Prepare query and execute
        $query = "DELETE FROM reservations WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        return $result;
    }
    
// Set the timezone!!
date_default_timezone_set('Europe/Amsterdam');
