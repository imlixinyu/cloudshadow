<?php

	include 'conn.php';

	//$nid=$_GET['nid'];
	$oid=$_GET['id']; //目标id
	if($_GET['fls']){
		$follow_state=$_GET['fls'];
	}
	else $follow_state='leader';
	
	$sql="SELECT `ustatus` from `user` where `uid`='$oid'";
	$result=MySql_query($sql);
	$row=mysql_fetch_array($result);
	$status=$row["ustatus"];
	
	
	$info = array("status"=> $status);
	$statusencode = json_encode($info);
	echo $statusencode;
	

?>