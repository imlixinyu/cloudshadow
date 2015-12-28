<?php
	
	include 'conn.php';

	$reply=$_GET['reply'];
	$idf=$_GET['idf'];
	$idl=$_GET['idl'];
	$status=array(
		"status"=>$reply,
		"flinfo"=>array(
				"idf"=>$idf,
				"idl"=>$idl
		)
	);
	
	$statusencode = json_encode($status);
	echo $statusencode;

?>