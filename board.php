<?php
include 'style.html';
$name = $_GET['name'];
?>
<title>Board</title>
<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='view.php?name=<?=$name?>'>View</a>
                        <a href="index.php">Logout</a>
                        <a href="signup.php">Register</a>
                </div>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="board.php" method="post">
                        <input type="hidden" name="name" value="<?=$name?>"> 
                        	<p><strong><?="Hi, " . $name?></strong></p>
                        	<p>SUBJECT</p>
                        	<p><input type="text" name="subject"></p>
                        	<p>CONTENT</p>
                        	<p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px;height:100px;" name="content"></textarea></p>
                        	<p><input type="submit" name="submit" value="SEND">
                    <style>
                        input {padding:5px 15px; background:#FFCCCC; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="RESET">
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

<?php
//送出留言後會執行下面這段程式碼
if (isset($_POST['submit'])) {
	include "db.php";
	echo '<div class="success">Added successfully ！</div>';
	$Guest_name = $_POST['name'];
	$Guest_subject = $_POST['subject'];
    $Guest_content = $_POST['content'];
    //$Guest_time = $_POST['Guest_time'];
	$sql = "INSERT guestbook(Guest_name	, Guest_subject, Guest_content, Guest_time) VALUES ('$Guest_name', '$Guest_subject', '$Guest_content', now())";

	if (!mysqli_query($db, $sql)) {
		die(mysqli_error());
	} else {
    //若成功將留言存進資料庫，會自動跳轉到顯示留言的頁面
		echo "
                <script>
                setTimeout(function(){window.location.href='view.php?name=" . $name . "';},500);
                </script>";

	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}
?>
