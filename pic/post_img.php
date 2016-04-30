<?php

//头像默认为default 防止出错
//更新、上传头像 头像命名与用户id一致，例如id是1，则头像为1.jpg（或1.png）
//post方式，cloudshadow.sinaapp.com/upload/upload_icon.php
include '../conn.php';

$info=array(
    "status"=>0,
    "message"=>"",
    "postinfo"=>array(
            	"pid"=>"",
                "text"=>"",
                "pic"=>"",
                "time"=>"",
                "longitude"=>"",
                "latitude"=>""
		)
    )

use sinacloud\sae\Storage as Storage;
$s = new Storage();
if ($_FILES["file"]["error"] > 0){
    $str="Error: " . $_FILES["file"]["error"] . "<br />";
    $info['message']=$str;
}
else{
    $info['message']=0;
}

$s =new Storage();
$i='pic_post/'.$_FILES['file']['name']; //文件名
$domain='yunying'; //storage名
$s->putObjectFile($_FILES['file']['tmp_name'], $domain, $i);

/*
$filename=$_FILES['file']['name'];
$id = substr($filename,0,-4);
*/
$uid=$_POST ["uid"];
$ptext=$_POST["ptext"];
$purl="http://cloudshadow-yunying.stor.sinaapp.com/pic_post%2F".$_FILES['file']['name'];
$ptime=date('Y-m-d H:i:s', time());
$plongitude=$_POST["plongitude"];
$platitude=$_POST["platitude"];

$sql="INSERT INTO `post`(`uid`, `ptext`, `purl`, `ptime`, `plongitude`, `platitude`) VALUES ($uid,'$ptext','$purl','$ptime',$plongitude, $platitude)";
//echo $sql;
MySQL_query($sql);

$b="select * from `post` where `ptime`='$ptime' and uid=$uid";
$result=MySQL_query($b);
$row=mysql_fetch_array($result);
$pid=$row["pid"];
if($pid){
    $info['status']=1;
    $info['postinfo']['pid']=$row["pid"];
    $info['postinfo']['text']=$row["ptext"];
    $info['postinfo']['pic']=$row["purl"];
    $info['postinfo']['time']=$row["ptime"];
    $info['postinfo']['longitude']=$row["plongitude"];
    $info['postinfo']['latitude']=$row["platitude"];

}
else
{
    $info['status']=0;
    $info['message']="CannotPull";
}
$infoencode=json_encode($info);
echo $infoencode;

?>