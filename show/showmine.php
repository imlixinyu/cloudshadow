<?php

/**
 * showmine short summary.
 *
 * showmine description.
 *
 * @version 1.0
 * @author Xinyu
 */


include "../conn.php";

$uid=$_GET['uid'];

$sql="SELECT ptext,purl,ptime,plongitude,platitude,user.uimg,user.uname,user.ustatus FROM post, user WHERE user.uid = post.uid and post.uid=$uid";
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

