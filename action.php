<?php
error_reporting(E_ALL);
require 'mysql.php';
require 'ftp.php';
require 'file.php';
require 'dir.php';
if (isset($_REQUEST['act'])) {
$act=$_REQUEST['act'];
switch ($act) {
	//登录注册
	case 'user':
         $sql=new sql();
         $action=$_REQUEST['action'];
	     switch ($action) {
	     	case 'login':
	     	  $username=$_REQUEST['username'];
              $password=$_REQUEST['password'];
	     		echo $sql->login($username,$password);
	     		break;
	        case 'register':
	     	     $dir=new dir();
	     	     $dir->createFolder("./file/".$_REQUEST['username']);
	     	     $username=$_REQUEST['username'];
                 $password=$_REQUEST['password'];
	     		 echo $sql->adduser($username,$password);
	     		 break;
	        case 'loginout':
	            echo  $sql->loginout();
	        default :
	            echo $sql->logined();
	            break;
	     }
		break;
	
	// ftp文件传输
	case 'ftp':
        $ftp=new ftp('192.168.1.199','sky','123','21','./storage/');
        $action=$_REQUEST['action'];
        $file=new file();
        switch ($action) {
        	case 'upload':
                $file->uploadFile($_FILES['upfile'],'./ftp');//先将文件存储于服务器上
        		echo $ftp->put($_FILES['upfile']['name']);//将服务器上的文件发送到ftp
        		$file->delFile('./ftp/'.$_FILES['upfile']['name']);//将服务器上的文件删除
        		break;
        	default:
        		$remote=$_REQUEST['file'];
        		echo $ftp->get($remote);
        		$file->downFile('./ftp/'.$remote);
        		// $file->delFile('./ftp/'.$remote);
        		break;
        }
	    break;
	//http的文件操作
	case 'file':
	    $file=new file();
	    $action=$_REQUEST['action'];
        switch($action){
        	case 'upload':
        		echo $file->uploadFile($_FILES['upfile'],'./file/'.$_REQUEST['touser'].'/');
        		break;
            case 'delete':
                echo $file->delFile('./file/'.$_SESSION['username'].'/'.$_REQUEST['fileName']);
                break;
        	default:
        	    $remote=$_REQUEST['fileName'];
        		echo $file->downFile('./file/'.$_SESSION['username'].'/'.$remote);
        		break;
        }
        break;
	default:
	  echo $_REQUEST['act'];
		echo json_encode(['status'=>'非法操作']);
		break;
  
}
}else{
	echo json_encode(['status'=>'无操作']);
	header('location:http://localhost/grade/login.html');
}

