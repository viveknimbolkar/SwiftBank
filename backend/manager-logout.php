<?php

session_start();

unset($_SESSION['managername']);

header("Location: ../index.php");

?>