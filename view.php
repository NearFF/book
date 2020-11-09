<title>All messages</title>
<?php
include 'style.html';
$name = '';
if (!empty($_GET['name'])) {
    $name = $_GET['name'];
}

?>

<body>
	     <div class="flex-center position-ref full-height">
	<div class="top-right home">
                <?php
if (!$name) {
	echo '<a href="index.php">Log in</a>';
} else {
	echo "<a href='board.php?name=" . $name . "'>Write some messages</a>";
	echo '<a href="index.php">Log out</a>';
}?>
     </div>



</div>
<div class="note full-height">
<?php
session_start();
include "db.php";
$sql = "select * from guestbook";
$result = mysqli_query($db, $sql); 
//var_dump($result);
//exit;
if (!empty($_GET['name'])) {
    $_SESSION['name'] = $name = $_GET['name'];
}

//從資料庫中撈留言紀錄並顯示出來
while ($row = mysqli_fetch_assoc($result)) {
//var_dump($row);
//exit;
	echo "<br>Visitor Name：" . $row['Guest_name'];
    echo "<br>Subject：" . $row['Guest_subject'];
	echo "<br>Content：" . nl2br($row['Guest_content']) . "<br>";
	if ($name == $row['Guest_name']) {  //若登入者名稱和留言者名稱一致，顯示出編輯和刪除的連結
		echo '
		<a href=" edit.php?id=' . $row['id'] . '&name=' . $name . '">
		Edit message content</a>&nbsp|&nbsp<a href="delete.php?id=' . $row['id'] . '">Delete the message</a><br>';// 在這邊啦
	}
	echo "Time：" . $row['Guest_time'] . "<br>";
	echo "<hr>";

}
echo "<br>";
echo '<div class="bottom left position-abs content">';
echo "There are " . mysqli_num_rows($result) . " messages.";
?>
</div>
</body>
</html>