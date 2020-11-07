<?php
include "db.php";
session_start();
$no = $_GET['no'];
$sql = "delete from guestbook where no='$no'";
$name = $_SESSION['name'];
$qqq = mysqli_query($db, $sql);
if (!mysqli_query($db, $sql)) {
    die(mysqli_error());
var_dump($qqq);
exit;
} else {
	echo "
         <script>
            setTimeout(function(){window.location.href='view.php?name=" . $name . "&no=" . $no . "';},300);
        </script>";

}
