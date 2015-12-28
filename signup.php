<?php
	
	include "conn.php";
	
	$spinfo=array(
		"status"=>0,
		"errorinfo"=>""
	);
	
	function Checknick($name){
		$sql="select `uname` from `user` where `uname`='$name'";
		$a=MySQL_query($sql);
		$row=mysql_fetch_array($a);
		$name=$row ["uname"];
		return $name;
	}

//if(!empty($_POST['submit']))
	//{
		$name=$_POST['name'];
	//	$sex=$_POST['sex'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$phone=$_POST['phone'];
		if(!$name) $error="昵称不能为空噢！~~";
		if((!isset($error)) and (strlen($name)<=3)) $error="昵称要大于等于3位";
		if((!isset($error)) and (Checknick($name))) $error="用户名已存在！请修改";
		if((!isset($error)) and (!$password)) $error="请输入密码！";
		if((!isset($error)) and (!@ereg("^[_0-9A-Za-z?!@#.,]*$", $password))) $error="密码需要由字母、数字或#?!_@.,构成";
		if((!isset($error)) and ($password!=$password2)) $error="两次密码不同喔!!";
		if((!isset($error)) and (!$phone)) $error="请输入手机号~！";
		if(!isset($error))
		{
			//if(!empty($_POST['submit']))
			//{
				$name=$_POST['name'];
				$password=$_POST['password'];
				$phone=$_POST['phone'];
				$sql="insert into `user` (`uid` , `uname` , `upassword`, `uphone`, `ustatus`) values (null, '$name', '$password', '$phone', '0')";
				MySQL_query($sql);
			//}
			$b="select * from `user` where `uname`='$name'";
			$result=MySQL_query($b);
			$row=mysql_fetch_array($result);
			$id=$row["uid"];
			if($id) $spinfo['status']=1;
			else {$spinfo['status']=0; $spinfo['errorinfo']="DATABASE ERROR!";}
		}
		else
		{
			$spinfo['status']=0; $spinfo['errorinfo']=$error;
		}
		
		
		$spinfoencode=json_encode($spinfo);
		echo $spinfoencode;
		exit;
	//}
	
	
	
?>	