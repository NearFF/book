<?php
    session_start();
    if (!empty($_SESSION['name']) || !empty($_SESSION['id'])) {
        session_destroy();
    }

    header("Location: signup.php");
	exit;

?>