<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('uploadFiles'))
{
	function uploadFiles($fileInfo,$uploadPath="../public/upload",$flag = true,$allowExt = array('jpeg','jpg','png','bmp'),$maxSize = 2097152)
	{
			//$_FILES 文件上传变量
			// print_r($_FILES);
			# code...
			// $data_return = array();	
			// var_dump($data_return);exit;
			$headpho_name 		= $fileInfo['name'];
			// var_dump($headpho_name);exit();
			$headpho_type   	= $fileInfo['type'];
			$headpho_temp_name 	= $fileInfo['tmp_name'];
			// var_dump(function_exists('imagecreatefromjpeg'));exit();
			// var_dump(@imagecreatefrompng($headpho_temp_name));exit();
			$src = '' ;
			if (@imagecreatefrompng($headpho_temp_name)) {
				
				$src = imagecreatefrompng($headpho_temp_name);
			}else if (@imagecreatefromjpeg($headpho_temp_name)) {
				
				$src = imagecreatefromjpeg($headpho_temp_name);
			}else if (@imagecreatefromwbmp($headpho_temp_name)) {
				
				$src = imagecreatefromwbmp($headpho_temp_name);
			}else  {
				$data_return['msg'] = "头像上传失败！";
				return 	$data_return;
			}


			list($width,$height) = getimagesize($headpho_temp_name);

			$newwidth=128;
			$newheight=128;
			$tmp=imagecreatetruecolor($newwidth,$newheight);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			

			// var_dump($tmp);exit();


			$headpho_size 		= $fileInfo['size'];
			$headpho_error 		= $fileInfo['error'];

			//$maxSize = 2*1024*1024;
			//$allowExt = array('jpeg','jpg','png','bmp');
			//$flag = true;


			if ($headpho_error == UPLOAD_ERR_OK) {

				$nameExc  			= fileext($headpho_name); 	
				$name2       		= random(10);

				$stringtime =  date("Y-m-d H:i:s",time());	
				$re = array('-',' ',':');

				$name3 =  str_replace($re,"",$stringtime);
				$destination = $name2.'-'.$name3.'.'.$nameExc;

				//将服务器上的临时文件移动到指定目录
				//move_uploaded_file(file,newloc);返回布尔值
				if ($headpho_size > $maxSize) {
					$data_return['msg'] = "文件大于2M";
					return 	$data_return;
				}

				//	方法二：获取文件后缀名函数
				$ext = pathinfo($headpho_name,PATHINFO_EXTENSION);
				// var_dump($ext);exit;

				if (!in_array($ext, $allowExt)) {
					$data_return['msg'] = "非法文件名！";
					return 	$data_return;
				}

				// $data_return = array();		
				if (!is_uploaded_file($headpho_temp_name)) {
// 					$data_return['msg'] = "文件不是通过HTTP POST	方式上传过来的！";
					// return 	$data_return;
					exit('文件不是通过HTTP POST	方式上传过来的！');
				}

				if ($flag) {
					if (!getimagesize($headpho_temp_name)) {
						// exit('');
						$data_return['msg'] = "不是真实的图片！";
						return 	$data_return;
					}
				}
				//文件唯一
				//$uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
				// $uniName = md5("zlsjdlfjsdfs");
				// var_dump($uniName);exit;

				// 如果目录不存在，自定义创建目录
				//$uploadPath = "../public/upload/";
				if (!file_exists($uploadPath)) {
					mkdir($uploadPath,0777,true);
					chmod($uploadPath,0777);
				}
				// $filename = $uploadPath.'/'.$destination;
				imagejpeg($tmp,$uploadPath.'/'.$destination,100);
				// var_dump($destination);exit();
				// var_dump(imagejpeg($tmp,$filename,100));exit();

				// var_dump(move_uploaded_file($headpho_temp_name,$uploadPath.$destination));exit;
				// if(! move_uploaded_file($headpho_temp_name,$uploadPath.'/'.$destination)){
				// 	echo "文件上传失败！";
				// }
				if (!imagejpeg($tmp,$uploadPath.'/'.$destination,100)) {
					// echo "";
					$data_return['msg'] = "文件上传失败！";
					return 	$data_return;
				}

				imagedestroy($src);
				// var_dump(imagedestroy($src));exit();
				imagedestroy($tmp);

				$data_return =  array(

					'newName' => $destination,
					'size' 	  => $headpho_size,
					'type' 	  => $headpho_type
					);
				return $data_return;

			}else {
				switch ($headpho_error) {
					case 1:
						$msg =  "php_uploaderror:1";
						break;
					case 2:
						$msg =  "php_uploaderror:2";
						break;
					case 3:
						$msg =  "php_uploaderror:文件部分被上传";
						break;
					case 4:
						$msg =  "php_uploaderror:没有上传文件";
						break;
					case 6:
						$msg =  "php_uploaderror:没有找到临时文件";
						break;
					case 7:
					case 8:
						$msg =  "system:error";
						break;
				}
				return $msg;
			}



	}	
}

if ( ! function_exists('fileext'))
{
	//方法一： 获取文件后缀名函数
	 function fileext($filename)
    {
        return substr(strrchr($filename, '.'), 1);
    }
}

if ( ! function_exists('random'))
{
     //生成随机文件名函数 
    function random($length)
    {
        $hash = 'UH-';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
            for($i = 0; $i < $length; $i++)
            {
                $hash .= $chars[mt_rand(0, $max)];
            }
        return $hash;
    }
}

 ?>