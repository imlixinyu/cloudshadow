<?php

/**
 * click short summary.
 *
 * click description.
 *
 * @version 1.0
 * @author Xinyu
 */
include "../conn.php";

$info=array(
    "status"=>0,
    "message"=>""
    );


$pid=$_POST["pid"];
$uid=$_POST["uid"];
$chksql="SELECT * FROM `click` WHERE pid=$pid and uid=$uid ";
$result=MySQL_query($chksql);
$row=mysql_fetch_array($result);
$cid=$row["cid"];
if($cid){
    $info['status']=0;
    $info['message']="已经赞过咯！";
}
else{
    $time=date('Y-m-d H:i:s', time());
    echo time();
    $sql="INSERT INTO `click`(`pid`, `uid`, `ctime`) VALUES ( $pid, $uid, '$time')";
    MySQL_query($sql);

    $b="SELECT * FROM `click` WHERE pid=$pid and uid=$uid";
    $bresult=MySQL_query($b);
    $brow=mysql_fetch_array($bresult);
    $bcid=$brow["cid"];
    if($bcid){
        $info['status']=1;
        $info['message']="蟹蟹蛤！~";
    }
    else{
        $info['status']=0;
        $info['message']="查询或推送错误！";
    }

}

$infoencode=json_encode($info);
echo $infoencode;


?>

