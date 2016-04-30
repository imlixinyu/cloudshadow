<?php

    //头像默认为default 防止出错
    //更新、上传头像 头像命名与用户id一致，例如id是1，则头像为1.jpg（或1.png）
    //post方式，cloudshadow.sinaapp.com/upload/upload_icon.php
    include '../conn.php';
    use sinacloud\sae\Storage as Storage;

    $info=array(
    "status"=>0,
    "message"=>"");

    $s = new Storage();
    if ($_FILES["file"]["error"] > 0){
        $info["status"]=0;
        $info["message"]="Error: " . $_FILES["file"]["error"] . "<br />";
    }
     /*else{
       
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];
        
    }*/

    $s =new Storage();
    $i='pic_user/'.$_FILES['file']['name']; //文件名
    $domain='yunying'; //storage名
    $s->putObjectFile($_FILES['file']['tmp_name'], $domain, $i);

    //$filename=$_FILES['file']['name'];
    //$id = substr($filename,0,-4);
    $id=$_POST["id"];

    $sql="UPDATE `user` SET `uimg`=\"http://cloudshadow-yunying.stor.sinaapp.com/pic_user%2F".$_FILES['file']['name']."\" where `uid`='$id'"; //更新数据库头像URL
    //echo $sql;
    MySQL_query($sql);
    $info["status"]=1;
    
    $infoencode = json_encode($info);

    echo $infoencode;
?>