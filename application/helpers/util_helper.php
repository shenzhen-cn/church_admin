<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('doCurl'))
{
	function doCurl($url, $param = NULL, $method = NULL)
	{
		// echo $url;
		log_message('debug', 'SNB-curl: Call to '.$url.($method == 'POST' ? ' with '.preg_replace('/\n/', '',print_r($param, TRUE)) : '')); 

		$process= curl_init($url);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		if($method == 'POST')
		{
			curl_setopt($process, CURLOPT_POST, TRUE);
			curl_setopt($process, CURLOPT_POSTFIELDS, $param);
			curl_setopt($process, CURLOPT_CUSTOMREQUEST, $method); 
		}
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$content = array();
		$content['output'] = curl_exec($process);
		$content['http_status_code'] = curl_getinfo($process, CURLINFO_HTTP_CODE);
		
		return $content;
	}
}
if ( ! function_exists('alert'))
{
function alert ($msg,$url=""){
    	$str ='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 		$str.= '<script type="text/javascript">'; 
		$str.="alert('".$msg."');"; 

		if ($url != "") 
		{ 
			$str.="window.location.href='{$url}';"; 
		} 
		else 
		{ 
			$str.="window.history.back();"; 
		} 
		echo $str.='</script>';
		return false; 
 	}
}