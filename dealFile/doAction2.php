<?php


header("content-type:text/html;charset=utf-8");


$fileInfo=$_FILES['myFile'];
var_dump($fileInfo);

$maxSize=200000;
$allowExt=array("jpg","png","gif");
$path="uploads";

if($fileInfo['error']===UPLOAD_ERR_OK){
	// 判断上传文件的大小
	if($fileInfo['size']>$maxSize){
		exit("上传文件过大");
	}

	// 判断类型 
	## in_array(search,array,type) 搜索数组中是否存在指定的值
	# type ： 检查搜索的数据与数组的值类型是否相同。。如果search为字符串，则区分大小写
	# 找到返回true 没找到返回false
	## explode(separator,string,limit) 把字符串打散为数组 
	#	limit  。。。
	## end(array)
	#如果成功则返回数组中最后一个元素值，如果数组为空则返回false
	## strtolower(string)  把字符串转换为小写
	#
	## pathinfo(path,options)  以数组的形式返回关于文件路径的信息
	# path : 规定要检查的路径
	# options ：规定要返回的数组元素，默认是all
	# PATHINFO_DIRNAME  只返回 dirname
	# PATHINFO_BASENAME       basename
	# PATHINFO_EXTENSION      extension
	# 如果不是请求所有的元素，则pathinfo()函数返回字符串
	# 
	## exit()  输出一条消息，并退出当前脚本  是die()的别名 

// 获取扩展名
// $ext=strtolower(end(explode(".", $fileInfo['tmp_name'])));
		$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
		echo $ext;
	if(!in_array($ext, $allowExt)){
		exit( "非法的文件类型");
	}

	// 判断文件是否通过HTTP POST方式
	## is_uploaded_file(file)  判断指定的文件是否通过HTTP POST上传
	#是返回true 
	#该函数可以用于确保恶意用户无法欺骗脚本去访问本不能访问的文件  如passwd
	#这种检查显得格外重要，如果上传的文件有可能会造成对用户或本系统的其他用户显示其内容的话
	#本函数的结果会被缓存，请使用clearstatcache 来清除缓存

	if(!is_uploaded_file($fileInfo['tmp_name'])){
		exit("文件不是通过HTTP POST上传");
	}

	// 确保文件名唯一，防止重名覆盖
	## micortiem(get_as_float)  返回当前Unix时间戳的微妙数，
	#默认返回字符串，如果get_as_float 参数设置为true，返回浮点数
	## uniqid(prefix,more_entropy) 基于以微秒计的当前时间，生成一个唯一的id
	#more_entropy ： 规定位于返回值末尾的更多地嘀
	## md5(string) 
	
		echo "<br/>";
		// echo microtime(true);
		echo "<br/>";
		// echo uniqid("abc");
		echo "<br/>";

		$uniqName=md5(uniqid(microtime(true),true)).".".$ext;


		// 检查目录是否存在
		## file_exists(path)   检查文件或目录是否存在
		#存在返回true，否则返回false
		## mkdir(path,mode,recursive,context) 函数创建目录
		#path : 规定要创建的目录的名称   。。。。必须
		#成功返回true
		## chmod(file,mode) 改变文件模式 
		#chmod(file,0777);
		if(!file_exists($path)){
			echo "no exists";
			mkdir("uploads",0777,true);
		}


// 检查是否是真实的图片类型
		## getimagesize(string)  用于获取图像大小及相关信息
		#成功返回一个数组，失败返回false，并产生一条E_WARNING级的错误信息
		## list()  在一次操作中给一组变量赋值
		# list($a,$b,$c)=array("dog","cat","horse")

		// if(!getimagesize($fileInfo['tmp_name'])){
		// 	exit("不是真正的图片类型");
		// }


	# move_uploaded_file() 是移动  copy()是拷贝
	if(move_uploaded_file($fileInfo['tmp_name'], $path."/".$uniqName)){
		echo "文件".$fileInfo['name']."上传成功";
	}else{
		echo "上传失败";
	}
}else{
	switch($fileInfo['error']){
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