<?php
session_start();
if (! isset($_SESSION["user"]))
        $_SESSION["company"] = "";
if ( $_SESSION["user"] < " ") {
		// echo "乾";
		header("Location: index.html");
        exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" NAME="ROBOTS" CONTENT="NOARCHIVE"/>
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<title>首頁</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	function goto(where){
		location.href = where;
	}
	function logout(){
		$.ajax({
	        url:'../../model/user/controller.php?act=logout',
	        type: 'GET',
	        async:false,
	        success:function(r){
	        	location.href = "index.html";
	        },
	        error:function(err){
	                console.log(err);
	        }
	    });
	}
</script>
</head>
<style type="text/css">
	.class{
		height: 100px;
		width: 200px;
	}
</style>
<body>
	<button id="dataform.php" class="class" onclick="goto(this.id)">資料填寫</button>
	<button id="allresponsebyfront.php" class="class" onclick="goto(this.id)">已填寫資料</button>
	<button class="class" onclick="logout()">登出</button>
</body>
</html>
