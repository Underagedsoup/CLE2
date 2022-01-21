<?php
require_once "includes/database.php";

if (!isset($_SESSION['user'])) {
    header('Location: /CLE/');
}

if (isset($_POST['submit'])) {
    session_destroy();
    header('Location: /CLE/');
}

//Close connection
mysqli_close($db);
?>