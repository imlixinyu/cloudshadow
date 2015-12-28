<?php 
	include 'conn.php';
	
	$id=$_GET['id'];
	$latitude=$_GET['latitude'];
	$longitude=$_GET['longitude'];
	
	$location=array(
		"id"=>$id,
		"latitude"=>$latitude,
		"longitude"=>$longitude
	);

	$result_loc=json_encode($location);
	
	$sql2="SELECT `utoken` FROM `user` WHERE `uid`='$id'";
	$result=MySql_query($sql2);
	$row=mysql_fetch_array($result);
	$token_get=($row["utoken"]);
	
	$appid = 24170;
	$token = $token_get;
	$title = "to_leader";
	$msg = $result_loc;
	$acts = "[\"4,www.baidu.com\"]";
	$extra = array(
		'handle_by_app'=>'1'
	);

	$adpns = new SaeADPNS();
	$result = $adpns->push($appid, $token, $title, $msg, $acts, $extra);
	if ($result && is_array($result)) {
		//echo '发送成功！';
		$st=array("status"=>1);
		echo json_encode($st);
		var_dump($result);
	} else {
		$st=array("status"=>0);
		echo json_encode($st);
		var_dump($apns->errno(), $apns->errmsg());
	}

	//http://lmst.sinaapp.com/to_leader.php?id=1&&latitude=24&&longtitude=120


?>