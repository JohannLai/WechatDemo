<?php
date_default_timezone_set("Asia/Shanghai");  //设置默认时区

define("APPID","wx3dc8172320f8e0e4");
define("APPSECRET",  "41c1f037f44f8e2a4dc7151b8412be36") ;

//获取access_token请求的url地址 ， GET 方法
$token_access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;

$res =getCatch($token_access_url );
$arr_result = json_decode($res, true);   //将获取的返回的JSON返回值转换为数组格式

define ("ACCESS_TOKEN" , $arr_result['access_token']);
//将ACCESS_TOKEN定义为常量。便于使用


function postMsg($url, $data) {      //POST方式提交数据
	$ch = curl_init() ;
	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST") ;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0  (compatible; MSIE5.01; Window NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$info = curl_exec($ch);

if(curl_errno($ch))  {
	echo 'Errno'.curl_error($ch);
}

curl_close($ch);
	return $info;
}


function getMsg($url) {    //GET方式获取数据
    if (function_exists("file_get_content")) {
    	$result = getFileGetContent($url) ; return $result;
    }else{
        $retult = getCatch($url) ;
	}
}

function getCatch($url) {    //curl 的 GET 方式获取数据
	$ch = curl_init() ;
	curl_setopt($ch, CURLOPT_URL, $url) ;
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) chrome/23.0.1271.1 Safari/537.11');
    $res = curl_exec($ch);
    $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE) ;
    curl_close($ch);
    return $res;	
}

function getFileGetContent($url){  //GET方式获取数据
    $result = file_get_contents($url);
    return $retult ;
}

//格式化输出
function p($arr){ echo "<pre>";	var_dump($arr);	echo "</pre>";}


?>
