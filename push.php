<?php

$appid = 24170;
$token = $_POST['token'];
$title = $_POST['title'];
$msg = $_POST['msg'];
$acts = "[\"4,www.baidu.com\"]";
$extra = array(
    'handle_by_app'=>'1'
);

$adpns = new SaeADPNS();
//appid 是应用的标识，从SAE的推送服务页面申请
//token 是SDK通道标识，从SDK的onPush中获取
$result = $adpns->push($appid, $token, $title, $msg, $acts, $extra);
if ($result && is_array($result)) {
    echo '发送成功！';
    var_dump($result);
} else {
    echo '发送失败。';
    var_dump($apns->errno(), $apns->errmsg());
}

?>