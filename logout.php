<?php 
	include "conn.php";
	//echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
	$id = $_GET['id'];
	$sql="UPDATE `user` SET `ustatus` = '1' WHERE `uid` = '$id'";
	mysql_query($sql);

	session_destroy();

?>