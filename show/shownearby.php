<?php

/**
 * shownearby short summary.
 *
 * shownearby description.
 *
 * @version 1.0
 * @author Xinyu
 */


include "../conn.php";
$longitude=$_POST['longitude'];
$latitude=$_POST['latitude'];
$radius=0.05;

$sql="SELECT ptext,purl,ptime,plongitude,platitude,user.uid,user.uimg,user.uname,user.ustatus FROM `post`,`user` WHERE user.uid=post.uid and post.plongitude<=$longitude+$radius and post.platitude<=$latitude+$radius and post.plongitude>=$longitude-$radius and post.platitude>=$latitude-$radius ";
//echo $sql;
$result=Mysql_query($sql);
$flist=array();
$i=0;
while($row=@mysql_fetch_array($result))
{
    $flist[$i]=$row;
    $i++;
}

echo json_encode(array('status'=>1,'dataList'=>$flist));

