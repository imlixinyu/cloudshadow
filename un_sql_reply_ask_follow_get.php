<?php 
//回应发起请求的用户
//可以用到sql_ask_follow.php发送请求之后返回的rid值，只对单条显示

	include 'conn.php';
	
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

	echo json_encode($result);
	$sql="UPDATE `request` SET `rcomplete`='1' where `raskid`='$raskid' and `rcomplete`='0' and rstatus is NOT NULL";
	$result=MySQL_query($sql);
	
	//http://localhost/LMST/1/sql_reply_ask_follow_get.php?raskid=1
	//返回格式如下：
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
            "rfinish": "1", 
            "rcomplete": "0"
        }, 
        {
            "rid": "2", 
            "rtime": "2015-11-25 19:22:12", 
            "raskid": "1", 
            "ransid": "2", 
            "rleaderid": "1", 
            "rfollowid": "2", 
            "rstatus": "1", 
            "rfinish": "1", 
            "rcomplete": "0"
        }
    ]
	}


	
	*/
	//rcomplete=0 and rstatus NOT NULL
?>