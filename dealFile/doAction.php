<?php

// $_FILES
# print 是打印字符串   print_r 是打印复合类型如 对象 数组
// 如果输出为空 检查method 和 enctype  。检查服务器配置信息是否支持http上传文件file_uploads=On;
print_r($_FILES) ;


#$_FILES 中保存着上传文件的信息
# Array(input的name  => Array(
# name=>上传文件的名称,type=>上传文件的MIME类型,
# tmp_name=>上传到服务器上的临时文件名,size=>上传文件的大小,error=>上传文件的错误号))
# 
# error 错误号：
# 0 ： 上传成功  UPLOAD_ERR_OK
# 1 : 上传文件超过了 php.ini 中 upload_max_filesize选项限制的值
# 2 ： 上传文件的大小超过了html表单中 MAX_FILE_SIZE 的值
# 3 ：文件只有部分被上传
# 4 : 没有文件被上传
# 6 ：找不到临时文件
# 7 ：文件写入失败
# 
# 
$filename=$_FILES['myFile']['name'];
$type=$_FILES['myFile']['type'];
$tmp_name=$_FILES['myFile']['tmp_name'];
$size=$_FILES['myFile']['size'];
$error=$_FILES['myFile']['error'];

# 函数将上传的文件移动到新位置，若成功，则返回true，否则返回false
# move_uploaded_file(file,newloc);  将服务器上的临时文件移动到指定目录下
# 如果file不是合法的上传文件，不会出现任何操作，move_uploaded_file()将返回false
# 如果file是合法的上传文件，但出于某些原因无法移动，不会出现任何操作，move_uploaded_file()将返回false，此外还会发出一条警告
# 本函数仅用于通过 HTTP POST 上传的文件
# 如果目标文件已经存在，将会被覆盖

// move_uploaded_file($tmp_name, "uploads/".$filename);


#copy(source,destination)   拷贝文件
#将文件从source拷贝到destination，如果成功则返回TRUE，否则返回false
// echo copy($tmp_name, "uploads/1.jpg");




?>