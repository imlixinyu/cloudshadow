<?php 
	include 'conn.php';
	$id=$_GET['id'];
	$token=$_GET['token'];
	
	$sql="UPDATE `user` SET `utoken`='$token' where `uid`='$id'"; //更新token
	MySQL_query($sql);

	$info=array("status"=>1);
	$infoencode = json_encode($info);

	echo $infoencode;
?>