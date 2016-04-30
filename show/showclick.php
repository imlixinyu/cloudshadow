<?php

/**
 * showclick short summary.
 *
 * showclick description.
 *
 * @version 1.0
 * @author Xinyu
 */


include "../conn.php";

$pid=$_GET['pid'];

$b="select count(uid) from `click` where `pid`='$pid'";
$bresult=MySQL_query($b);
$brow=mysql_fetch_array($bresult);
$num=$brow[0];

$sql="select uid,uname,uimg from user where uid in (SELECT uid FROM `click` WHERE pid='$pid');";
$result=Mysql_query($sql);
$flist=array();
$i=0;
while($row=mysql_fetch_array($result))
{
    $flist[$i]=$row;
    $i++;
}
//echo json_encode(array('dataList'=>$flist));
echo json_encode(array('num'=>$num, 'data'=>$flist));

