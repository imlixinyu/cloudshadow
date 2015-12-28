<?php 

//对于被请求（被ask）的用户
//废弃之前的reply_ask_follow.php
//目的：修改回复状态rstatus，即是否同意
//对对应的request id处理
//用到sql_ask_follow_get.php得到的rid
	include 'conn.php';

	$rid=$_GET['rid'];
	$rstatus=$_GET['rstatus'];
	
	$sql="UPDATE `request` SET `rstatus`='$rstatus' where `rid`='$rid'"; //如果之后修改状态可以放在这里，对应前面的sql_ask_follow_get.php
	MySQL_query($sql);

	
	//合并sql_reply_ask_follow_get.php
	$raskid=$_GET['raskid'];
	
	$result = array();	
	$rs = mysql_query("select count(*) from `request` where `raskid`='$raskid' and `rcomplete`='0' and rstatus is not NULL");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];

	$sql="select * from `request` where `raskid`='$raskid' and `rcomplete`='0' and rstatus is NOT NULL";
	$rs = mysql_query($sql);
  
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	$result_sql_ans=json_encode($result);
	$sql="UPDATE `request` SET `rcomplete`='1' where `raskid`='$raskid' and `rcomplete`='0' and rstatus is NOT NULL";
	$result=MySQL_query($sql);
	
	$sql2="SELECT `utoken` FROM `user` WHERE `uid`='$raskid'";
	$result=MySql_query($sql2);
	$row=mysql_fetch_array($result);
	$token_get=($row["utoken"]);
	
	
	$appid = 24170;
	$token = $token_get;
	$title = "sql_reply_ask_follow";
	$msg = $result_sql_ans;
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

	
	//http://localhost/LMST/1/sql_reply_ask_follow.php?rid=2&&rstatus=1&&raskid=2
	
?>