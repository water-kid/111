<?php 

header("content-type:text/html;charset=utf-8");



$fileInfo=$_FILES['myFile'];
$filename=$fileInfo['name'];
$filetype=$fileInfo['type'];
$tmp_name=$fileInfo['tmp_name'];
$size=$fileInfo['size'];
$error=$fileInfo['error'];
// echo UPLOAD_ERR_OK;


if($error===UPLOAD_ERR_OK){
	if(move_uploaded_file($tmp_name, "test/".$filename)){
		echo "文件".$filename."上传成功";
	}else{
		echo "上传失败";
	}
}else{
	switch($error){
		case 1:
			echo "上传文件超过了PHP配置文件中的upload_max_filesize选项的值";
			break;
		case 2:
			echo "超过了表单MAX_FILE_SIZE限制的大小";
			break;
		case 3:
			echo "文件被部分上传";
			break;
		case 4:
			echo "没有选择上传文件";
			break;
		case 6:
			echo "没有找到临时目录";
			break;
		case 7:
		case 8:
			echo "系统错误";
			break;

	}
}




?>