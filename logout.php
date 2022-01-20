<?php
require_once "includes/database.php";

session_destroy();
header('Location: /CLE/');
exit;

//Close connection
mysqli_close($db);
?>