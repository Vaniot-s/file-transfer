<?php
/**
* ftp上传下载文件
* edit www.jbxue.com
*/
class ftp{
	protected $ftp_server;//服务器
	protected $ftp_user_name;//用户名
	protected $ftp_user_pass;//密码
	protected $ftp_port;//端口
	protected $ftp_put_dir;//上传目录
	protected $ftp_conn_id;
	protected $ftp_login_result;

	function __construct($ftp_server,$ftp_user_name,$ftp_user_pass,$ftp_port,$ftp_put_dir){
		$this->ftp_server=$ftp_server;//服务器
		$this->ftp_user_name=$ftp_user_name;//用户名
		$this->ftp_user_pass=$ftp_user_pass;//密码
		$this->ftp_port=$ftp_port;//端口
		$this->ftp_put_dir=$ftp_put_dir;//上传目录
		$this->ftp_conn_id = ftp_connect($this->ftp_server,$this->ftp_port);
		$this->ftp_login_result = ftp_login($this->ftp_conn_id, $this->ftp_user_name, $this->ftp_user_pass);
		if ((!$this->ftp_conn_id) || (!$this->ftp_login_result)) {
		 echo "连接到ftp服务器失败";
		 exit;
		}
		ftp_pasv($this->ftp_conn_id,true); //是否被动模式
	}

	public function put($locale){
	// ftp_pasv($this->ftp_conn_id,true);
	 //上传文件
	 ftp_chdir($this->ftp_conn_id, $this->ftp_put_dir);
	  $ftp_upload = ftp_put($this->ftp_conn_id, $locale,'./ftp/'.$locale, FTP_BINARY);//返回布尔值
	 // return json_encode(['status'=> $ftp_upload]);
	 return json_encode($locale);
	}

	public function get($remote){
	ftp_chdir($this->ftp_conn_id, $this->ftp_put_dir);
	$ftp_get=ftp_get($this->ftp_conn_id, './ftp/'.$remote,$remote, FTP_BINARY);
	return json_encode(['status'=> $ftp_get]);
	}
}

// $ftp_server='192.168.1.199';//服务器
// $ftp_user_name='sky';//用户名
// $ftp_user_pass='123';//密码
// $ftp_port='21';//端口
// $ftp_put_dir='./';//上传目录

// $ftp_conn_id = ftp_connect($ftp_server,$ftp_port);
// $ftp_login_result = ftp_login($ftp_conn_id, $ftp_user_name, $ftp_user_pass);

// if ((!$ftp_conn_id) || (!$ftp_login_result)) {
//  echo "连接到ftp服务器失败";
//  exit;
// } else {

//  ftp_pasv ($ftp_conn_id,true); //是否被动模式
 
//  ftp_chdir($ftp_conn_id, $ftp_put_dir);
//  $ftp_upload = ftp_put($ftp_conn_id, '5.png', 
//  	".\/5.png", FTP_BINARY);
//  //var_dump($ftp_upload);//看看写入成功否？
//  ftp_close($ftp_conn_id); //断开
// }