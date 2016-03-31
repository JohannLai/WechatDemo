<?php
require_once "lib.php";
require_once "send_text_msg.php";
//require_once "downloadfile.php";




$make_menu_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".ACCESS_TOKEN ;


$menudata = ' {

    "button": [
        {
            "name": "扫码",
            "sub_button": [
                {
                    "type": "scancode_waitmsg",
                    "name": "扫码带提示",
                    "key": "rselfmenu_0_0",
                    "sub_button": [ ]
                },
                {
                    "type": "scancode_push",
                    "name": "扫码推事件",
                    "key": "rselfmenu_0_1",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_weixin",
                    "name": "微信相册发图",
                    "key": "rselfmenu_1_2",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发送位置",
            "type": "location_select",
            "key": "rselfmenu_2_0"
        },

    ]


}';




//$info = postMSg($make_menu_url, $menudata);
//print_r($info);

$get_msg_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".ACCESS_TOKEN;

$rand_area = "520";  //设置场景的ID值

//$expire_seconds = 420 ;

$post_er_array = array (
    //"expire_seconds" => $expire_seconds,
     "action_name" => "QR_LIMIT_SCENE",
     "action_info" =>array(
     "scene" => array(
         	"scene_id" => $rand_area
      )
    )
);

$post_json = json_encode($post_er_array);

$result = postMSg($get_msg_url, $post_json);

$arr = json_decode($result, true);

$ticket = $arr["ticket"];
p($ticket);
define("TICKET", urlencode($ticket));   //把TICKET定义为全局方便以后使用


$get_erweima_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".TICKET;
echo '<img style="-webkit-user-select: none" src="'.$get_erweima_url .'">';




$wechatObj = new wechatCallbackapiTest();
$wechatObj ->valid();
$wechatObj-> responseMsg();

?>































