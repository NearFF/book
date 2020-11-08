<?php
include "db.php";
session_start();
$id = $_GET['id'];

//var_dump($id);

//exit;
$sql = "DELETE FROM guestbook WHERE id='$id'"; //take *
$name = $_SESSION['name'];
//var_dump($sql);
//var_dump($name);

$qqq = mysqli_query($db, $sql);
//var_dump($qqq);
//exit;
if (!mysqli_query($db, $sql)) {
    die(mysqli_error());
//var_dump($qqq);
//exit;
} else {
	echo "
         <script>
            setTimeout(function(){window.location.href='view.php?name=" . $name . "&id=" . $id . "';},300);
        </script>";

}
