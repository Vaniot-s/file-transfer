<?php 

class dir
{
	
	function __construct()
	{
		
	}
	//打开指定目录
/**
 * 遍历目录函数，只读取目录中的最外层的内容
 * @param string $path
 * @return array
 */
public function readDirectory($path) {
	$handle = opendir ( $path );
	while ( ($item = readdir ( $handle )) !== false ) {
		//.和..这2个特殊目录
		if ($item != "." && $item != "..") {
			if (is_file ( $path . "/" . $item )) {
				$arr ['file'] [] = $item;
			}
			if (is_dir ( $path . "/" . $item )) {
				$arr ['dir'] [] = $item;
			}
		}
	}
	closedir ( $handle );
	return $arr;
}

/**
 * 得到文件夹大小
 * @param string $path
 * @return int 
 */
public function dirSize($path){
	$sum=0;
	global $sum;
	$handle=opendir($path);
	while(($item=readdir($handle))!==false){
		if($item!="."&&$item!=".."){
			if(is_file($path."/".$item)){
				$sum+=filesize($path."/".$item);
			}
			if(is_dir($path."/".$item)){
				$func=__FUNCTION__;
				$func($path."/".$item);
			}
		}
		
	}
	closedir($handle);
	return $sum;
}
//$path="file";
//echo dirSize($path);

public function createFolder($dirname){
	//检测文件夹名称的合法性
	if($this->checkFilename(basename($dirname))){
		//当前目录下是否存在同名文件夹名称
		if(!file_exists($dirname)){
			if(mkdir($dirname,0777,true)){
				$mes="文件夹创建成功";
			}else{
				$mes="文件夹创建失败";
			}
		}else{
			$mes="存在相同文件夹名称";
		}
	}else{
		$mes="非法文件夹名称";
	}
	return $mes;
}


/**
 * 检查文件名
 * @param  [type] $filename [description]
 * @return [type]           [description]
 */
public function checkFilename($filename){
	$pattern = "/[\/,\*,<>,\?\|]/";
	if (preg_match ( $pattern,  $filename )) {
		return false;
	}else{
		return true;
	}
}

/**
 * 重命名文件夹
 * @param string $oldname
 * @param string $newname
 * @return string
 */
public function renameFolder($oldname,$newname){
	//检测文件夹名称的合法性
	if(checkFilename(basename($newname))){
		//检测当前目录下是否存在同名文件夹名称
		if(!file_exists($newname)){
			if(rename($oldname,$newname)){
				$mes="重命名成功";
			}else{
				$mes="重命名失败";
			}
		}else{
			$mes="存在同名文件夹";
		}
	}else{
		$mes="非法文件夹名称";
	}
	return $mes;
}

public function copyFolder($src,$dst){
	//echo $src,"---",$dst."----";
	if(!file_exists($dst)){
		mkdir($dst,0777,true);
	}
	$handle=opendir($src);
	while(($item=readdir($handle))!==false){
		if($item!="."&&$item!=".."){
			if(is_file($src."/".$item)){
				copy($src."/".$item,$dst."/".$item);
			}
			if(is_dir($src."/".$item)){
				$func=__FUNCTION__;
				$func($src."/".$item,$dst."/".$item);
			}
		}
	}
	closedir($handle);
	return "复制成功";
	
}

/**
 * 剪切文件夹
 * @param string $src
 * @param string $dst
 * @return string
 */
public function cutFolder($src,$dst){
	//echo $src,"--",$dst;
	if(file_exists($dst)){
		if(is_dir($dst)){
			if(!file_exists($dst."/".basename($src))){
				if(rename($src,$dst."/".basename($src))){
					$mes="剪切成功";
				}else{
					$mes="剪切失败";
				}
			}else{
				$mes="存在同名文件夹";
			}
		}else{
			$mes="不是一个文件夹";
		}
	}else{
		$mes="目标文件夹不存在";
	}
	return $mes;
}

/**
 * 删除文件夹
 * @param string $path
 * @return string
 */
public function delFolder($path){
	$handle=opendir($path);//打开文件
	while(($item=readdir($handle))!==false){//读取句柄条目
		if($item!="."&&$item!=".."){
			if(is_file($path."/".$item)){//是文件
				unlink($path."/".$item);//删除文件
			}
			if(is_dir($path."/".$item)){//是文件夹
				$func=__FUNCTION__;//魔术常量
				$func($path."/".$item);//调用函数
			}
		}
	}
	closedir($handle);//关闭句柄
	rmdir($path);//删除目录
	return "文件夹删除成功";
}


}
