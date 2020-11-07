<title>Edit Message</title>
<?php
include 'style.html';
$name = $_GET['name'];
$id = $_GET['id'];
?>

<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='view.php?name=" . $name . "&id=" . <?=$id?> . "'>View</a>
                        <a href="index.php">Login</a>
                        <a href="signup.php">Register</a>
                </div>

<?php
include 'db.php';
$query = "SELECT * FROM guestbook WHERE  id=" . $_GET['id']; //選出該位使用者所留下的所有留言
$result = mysqli_query($db, $query);
//var_dump($result);
//exit;
$id = $_GET['id'];
while ($rs = mysqli_fetch_array($result)) {
   // var_dump($rs);
   // exit;
	?>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?=$rs['id']?>">
                        <input type="hidden" name="Guest_name" value="<?=$rs['Guest_name']?>">
                        <p>SUBJECT</p>
                        <input type="text" name="Guest_subject" value="<?=$rs['Guest_subject']?>">
                        <p>CONTENT</p>
                        <textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px; height:100px;" name="Guest_content"><?=$rs["Guest_content"]?></textarea>
                        <p><input type="submit" name="submit" value="SAVE">
                    <style>
                        input {padding:5px 15px; background:#ccc; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="REWRITE">
                    <style>
                        input {
                            padding:5px 15px;
                            background:#FFCCCC;
                            border:0 none;f
                            cursor:pointer;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            font-family: 'Nunito', sans-serif;
                            font-size: 19px;
                        }
                    </style>
                    </form>
                </div>

</body>
</html>
<?php }

if (isset($_POST['submit'])) {

	$id = $_POST['id'];
	$Guest_name = $_POST['Guest_name'];
	$Guest_subject = $_POST['Guest_subject'];
	$Guest_content = $_POST['Guest_content'];

	$sql = "update guestbook set Guest_subject='$Guest_subject',Guest_content='$Guest_content' where id='$id'";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error());
	} else {
		echo "
         <script>
            setTimeout(function(){window.location.href='view.php?name=" . $Guest_name . "&id=" . $id . "';},200);
        </script>";

	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}

//something wrong.
?>
