<?php

session_start();

unset($_SESSION['empfname']);

unset($_SESSION['emplname']);

header("Location: ../index.php");

?>