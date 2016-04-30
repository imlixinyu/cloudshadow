<?php

/**
 * comment short summary.
 *
 * comment description.
 *
 * @version 1.0
 * @author Xinyu
 */

include "../conn.php";

$info=array(
    "status"=>0,
    "message"=>"0"
    );

//echo 1;
$pid=$_POST["pid"];
$uid=$_POST["uid"];
$text=$_POST["text"];
$time=date('Y-m-d H:i:s', time());

$sql="INSERT INTO `comment`(`uid`, `pid`, `comtext`, `comtime`) VALUES ($uid, $pid, '$text', '$time')";
//echo $sql;
    MySQL_query($sql);

    $b="SELECT * FROM `comment` WHERE comtime='$time' and uid=$uid";
    //echo $b;
    $bresult=MySQL_query($b);
    $brow=@mysql_fetch_array($bresult);
    $bcomid=$brow["comid"];
    if($bcomid){
        $info['status']=1;
        $info['message']="评论成功！";
    }
    else{
        $info['status']=0;
        $info['message']="推送或查询错误！";
    }

    //var_dump($info);
    $infoencode=json_encode($info);
    echo $infoencode;
    exit;

?>