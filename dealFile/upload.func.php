<?php
$fileInfo=$_FILES['myFile'];

// $fileInfo   
// $uploadPath
// 是否检测
// $allowExt
function uploadFile($fileInfo,$allowExt=array("jpg","png"),$maxSize=2000000){

if($fileInfo['error']>0){
	switch($fileInfo['error']){
		case 1:
			$msg="上传文件超过了PHP配置文件中的upload_max_filesize选项的值";
			break;
		case 2:
			$msg="超过了表单MAX_FILE_SIZE限制的大小";
			break;
		case 3:
			$msg ="文件被部分上传";
			break;
		case 4:
			$msg= "没有选择上传文件";
			break;
		case 6:
			$msg= "没有找到临时目录";
			break;
		case 7:
		case 8:
			$msg= "系统错误";
			break;
	}
	exit($msg);
}


// 检查上传文件的类型
	$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
	$allowExt=array("jpg","png","gif");
	if(!in_array($ext, $allowExt)){
		exit("非法文件类型");
	}

	//检查上传文件大小
	$maxSize=2097152;
	if($fileInfo['size']>$maxSize){
		exit('上传文件过大');
	} 

	// 检查文件是否是通过 HTTP POST
	if(!is_uploaded_file($fileInfo['tmp_name'])){
		exit("不是通过HTTP POST上传");
	}

	$uploadPath="uploads";
	if(!file_exists($uploadPath)){
		mkdir($uploadPath,0777,true);
		chmod($uploadPath, 0777);
	}
	$uniqName=md5(uniqid(microtime(true),true));
	$destination=$uploadPath."/".$uniqName;

	if(!move_uploaded_file($fileInfo['tmp_name'], $destination)){
		exit("文件移动失败");
	}


	return array(
		'newName'=>$destination,
		'size'=>fileInfo['size']
	)

}

?>