<?php



define("TOKEN","weixin");

class wechatCallbackapiTest
{
  	   public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
    public function responseMsg()
    {
	
      $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获取微信服务器提交过来的数据
       
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//将获取的处理处理
      
      $fromUsername = $postObj->FromUserName;  //用户的openid ，不是唯一的，相同的用户关注不同的公众号后，获取的openid是不同的
      $toUsername = $postObj->ToUserName; //发送方微信号（来自用户 故为openid）
        
      $get_msg_by_openid = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".ACCESS_TOKEN."&openid=".$fromUsername."&lang=zh_CN";
        
       $result_json = file_get_contents( $get_msg_by_openid ); 
       
       $user_msg = json_decode($result_json, true);
      
      $keyword = trim($postObj->Content); //用户发送的消息内容
      $MsgType = $postObj->MsgType; //消息的类型为"text"，微信会根据用户发送不同消息自动识别返回给BAE不同值(text, image, event, voice, video,location)
      
      $Ticket = $postObj->Ticket;
        
      $Event = $postObj->Event;
        
      $EventKey = $postObj->EventKey;  

      $time = time(); //回复消息的时间戳  
        
       $subscribe_time = date("Y-m-d H:i:s",  $user_msg['subscribe_time']);
        
      $msg = "关注用户：". $user_msg['nickname'] ."\n";
       $msg .= "关注时间：". $subscribe_time ."\n";
       $msg .= "所在地：". $user_msg['country'] . $user_msg['province'] .$user_msg['city']."\n";
       $msg .= "头像链接：".$user_msg['headimgurl'] ."\n"; 
      $msg .= "用户id：".$fromUsername."\n";
      $msg .= "消息类型：".$MsgType."\n";
      $msg .= "事件类型：".$Event."\n";
      $msg .= "事件的key值：".$EventKey."\n";
      $msg .= "当前扫描二维码的ticket值：".$Ticket."\n";
      $msg .= "事件发送过来的时间戳：".$time."\n";  
        
      $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
			</xml>"; 
          
      $msgType = "text"; //回复消息的类型
      $contentStr = $msg; //回复给微信用户的内容
      
      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);//经过sprintf处理过后，
      echo $resultStr;
      exit;

    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>
