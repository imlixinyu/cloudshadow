<?php 

//对于被ask的用户
//后置条件：只能接收一次，接受之后立即处理，并转到sql_reply_ask_follow.php进行处理
//如果这样不方便的话可以转换成每次只取一条，对应字段rfinish暂不更改，到reply去更改。
//返回所有未处理的数量和详细信息。
	include 'conn.php';
	$myid=$_GET['myid']; //当前用户的id
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

	echo json_encode($result);
	$sql="UPDATE `request` SET `rfinish`='1' where `ransid`='$myid' and `rfinish`='0'";
	$result=MySQL_query($sql);
	
	//$infoencode = json_encode($row);
	//echo $infoencode;
	//http://localhost/LMST/1/sql_ask_follow_get.php?myid=2
	
	//返回信息如下：
	/*
	
	{
    "total": "2", 
    "rows": [
        {
            "rid": "1", 
            "rtime": "2015-11-25 18:39:07", 
            "raskid": "1", 
            "ransid": "2", 
            "rleaderid": "2", 
            "rfollowid": "1", 
            "rstatus": "1", 
            "rfinish": "0", 
            "rcomplete": "0"
        }, 
        {
            "rid": "2", 
            "rtime": "2015-11-25 19:22:12", 
            "raskid": "1", 
            "ransid": "2", 
            "rleaderid": "1", 
            "rfollowid": "2", 
            "rstatus": null, 
            "rfinish": "0", 
            "rcomplete": "0"
        }
    ]
	}
	
	*/
	
	

?>