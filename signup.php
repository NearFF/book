<?php
session_start();
if (
    !empty($_SESSION['name'])
    || !empty($_SESSION['id'])
    && $_SESSION['expire_ts']
) 
?>
<title>Sign up</title>
<?php
include 'style.html';
?>
<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href="view.php?name='<?=$_GET['name']?>'">View</a>
                        <a href="index.php">Login</a>
                        <a href="signup.php">Register</a>
                </div>
      <div class="content">
                <div class="m-b-md">
                    <form name="signup" action="signup.php" method="post">
                        <p>Username : <input type=text name="name"></p>
                        <p>Password : <input type=password name="password"></p>
                        <p><input type="submit" name="submit" value="Sign up">
                    <style>
                        input {padding:5px 15px; background:#ccc; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="Reset">
                    <style>
                        input {
                            padding:5px 15px;
                            background:#FFCCCC;
                            border:0 none;
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
<!--留言者按下Signup後接著會執行以下程式碼-->
<?php
//header("Content-Type: text/html; charset=utf8");
if (isset($_POST['submit'])) { 
    include 'db.php';
	$name = $_POST['name'];
    $password = $_POST['password'];

    if ($name && $password) {
		$sql = "select * from user_table where User_name = '$name'";
		$rows = mysqli_query($db, $sql);

        if (! $num = mysqli_num_rows($rows)) { //若這個username還未被使用過
            $method = 'DES-ECB';
            $options ='0';
            $result = openssl_encrypt($password, $method,  $options);
            $sql = "insert user_table(User_id,User_name,User_password) values (null,'$name','$result')";         
            $row = mysqli_query($db, $sql);  
            
            //if($row){    
                    //以下為javascript語法，註冊成功後會自動跳轉到登入頁面
                    echo '<div class="success">Sign up successfully ！</div>';
                    echo "<script>setTimeout(function(){window.location.href='index.php';},2000);</script>";
                //}                  
        }
        else{
            //這個username已被使用
            echo '<div class="warning">The Username has already been used ！</div>';
            echo "<script>setTimeout(function(){window.location.href='signup.php';},1000);</script>";
           
       }   
            
            //if (!$result) {
	        //    die('Error: ' . mysqli_error());
            //} else {
	    	    //echo '<div class="success">Sign up successfully ！</div>';
		        //echo "<script>setTimeout(function(){window.location.href='view.php?name=" . $name . "';},2000);</script>";
           // }
       // } else { 
		  
		//}
    } 
    mysqli_close($db);
}
   


?>