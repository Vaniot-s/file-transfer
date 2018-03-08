<?php
header('charset=utf8');
/**
* 
*/
session_cache_expire(30);//设置缓存到期的时间
session_start();
class sql{
  protected $mysqli;
  function __construct(){
    $this->mysqli=new mysqli('localhost','root','','file');
    if ($this->mysqli->connect_errno) {
      die("connect error");
    }
  }

  //增加用户
  public function adduser($username,$password){
      $sql="insert into user(username,password) values("."'".$username."'".",'".$password."')";
      $result;
      if($this->mysqli->query($sql)>0){
        $result['status']='sucess';
        $_SESSION['username']=$username;
        $result['username']=$username;
      }else{
        $result['status']='fail';
      }
      return json_encode($result);
  }

  //登录
  public function login($username,$password){
  $sql="select*from user where username="."'".$username."' and"." password="."'".$password."'";
  $mysqli_result=$this->mysqli->query($sql);
      $result;
      if($mysqli_result->num_rows>0){
        $result['status']='sucess';
        $_SESSION['username']=$username;
        $result['username']=$username;
      }else{
        $result['status']='fail';
      }
      return json_encode( $result);
  }

/**
 *  判断是否已经登录
 * @return [type] [description]
 */
public function logined(){
     $result;
     if (isset($_SESSION['username'])) {
       $result['status']='logined';
     }else{
      $result['status']='no';
     }
     return json_encode($result);
}
/**
 * 登出
 * @return [type] [description]
 */
public function loginout(){
   session_destroy();
   $result;
   if(!isset($_SESSION['username'])){
    $result['status']='success';
   }else{
    $result['status']='fail';
   }
}
}
?>