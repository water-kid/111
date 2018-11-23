<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<!-- 客户端限制   在客户端的限制几乎是无效的，可以f12修改
		1，通过隐藏域限制
			<input type="hidden" name="MAX_FILE_SIZE" value="20000">
		2，通过accept来限制上传
			<input type="file" name="myFile" accept="image/gif,image/png">

	 -->
<form action="doAction2.php" enctype="multipart/form-data" method="post">
	<!-- <input type="hidden" name="MAX_FILE_SIZE" value="20000"> -->
	<input type="file" name="myFile" accept=""><br/>
	<input type="submit" name="" value="上传文件">
</form>
</body>
</html>