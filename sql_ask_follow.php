<?php 

//对于发起请求的用户
//前置条件：ask_follow成功（即对方在线）
	include 'conn.php';
	$raskid=$_GET['raskid'];
	$ransid=$_GET['ransid'];
	$rleaderid=$_GET['rleaderid'];
	$rfollowid=$_GET['rfollowid'];
	
	$sql="INSERT INTO `request` (`raskid`, `ransid`, `rleaderid`, `rfollowid`) VALUES('$raskid', '$ransid', '$rleaderid', '$rfollowid')";
	MySQL_query($sql);

	//$sql2="SELECT TOP 1 `rid` FROM `request` WHERE `raskid`='$raskid' ORDER BY `rtime` DESC";
	$sql2="SELECT `rid` FROM `request` WHERE `raskid`='$raskid' ORDER BY `rtime` DESC LIMIT 1";
	$result=MySql_query($sql2);
	$row=mysql_fetch_array($result);

	$infoencode = json_encode($row["rid"]);
//echo $infoencode;
	//返回为刚插入数据的id
	
	
	$myid=$_GET['myid']; //当前用户的id //合并之前的sql_ask_follow_get.php
	/*
	$sql="select * from `request` where  `ransid`='$myid' and `rfinish`='0'";
	$result=MySQL_query($sql);
	$row=mysql_fetch_array($result);
	*/
	
	$result = array();	
	$rs = mysql_query("select count(*) from `request` where  `ransid`='$myid' and `rfinish`='0'");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];

	$sql="select * from `request` where  `ransid`='$myid' and `rfinish`='0'";
	$rs = mysql_query($sql);
  
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	$result_sql_ask=json_encode($result);

	echo $result_sql_ask;

	$sql="UPDATE `request` SET `rfinish`='1' where `ransid`='$myid' and `rfinish`='0'";
	$result=MySQL_query($sql);
	
	
	$sql2="SELECT `utoken` FROM `user` WHERE `uid`='$ransid'";
	$result=MySql_query($sql2);
	$row=mysql_fetch_array($result);
	$token_get=($row["utoken"]);
	
	$appid = 24170;
	$token = $token_get;
	$title = "sql_ask_follow";
	$msg = $result_sql_ask;
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

//http://localhost/LMST/1/sql_ask_follow.php?raskid=1&&ransid=2&&rleaderid=1&&rfollowid=2&&myid=1
	
	
?>