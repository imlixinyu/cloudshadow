<?php

/**
 * showcomment short summary.
 *
 * showcomment description.
 *
 * @version 1.0
 * @author Xinyu
 */
include "../conn.php";

$pid=$_GET['pid'];

$sql="SELECT comment.uid,comment.comtext,comment.comtime,user.uimg,user.uname,user.ustatus FROM comment, user WHERE user.uid = comment.uid and pid=$pid";
echo $sql;
$result=Mysql_query($sql);
$flist=array();
$i=0;
while($row=@mysql_fetch_array($result))
{
    $flist[$i]=$row;
    $i++;
}
//echo json_encode(array('dataList'=>$flist));
echo json_encode(array('data'=>$flist));

