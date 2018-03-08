<?php
// require 'file.php';
require 'dir.php';
session_start();
$dir=new dir();
header("Content-type:text/event-stream");//返回为sse设计的mime类型 text/event-stream(由此证明是文本协议)
// while (true) {
	 $file="";
	 foreach ($dir->readDirectory('./file/'.$_SESSION['username'])['file'] as $key => $value) {
	    $file.=$value.";";
	 }
	// echo "data:".date("Y-m-d H:i:s")."\n";
	echo "data:".$file."\n\n";
	// 不缓存成批，立即发送
	@ob_flush();
	@flush();
	sleep(1);//每次调用一秒间隔
// }