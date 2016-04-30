<?php

    include "../conn.php";

    //echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
    $id = $_GET['id'];
    $sql="UPDATE `user` SET `ustatus` = '0' WHERE `uid` = '$id'";
    mysql_query($sql);

    session_destroy();

    $info=array(
    "status"=>0,
    "message"=>"");

    $b="select ustatus from `user` where `uid` = '$id'";
    $result=MySQL_query($b);
    $row=mysql_fetch_array($result);
    $ustatus=$row["ustatus"];
    if($ustatus=="0"){
        $info['status']=1;
        $info['message']="Success!";
    }
    else
    {
        $info['status']=0;
        $info['message']="CannotPull!";
    }

    $infoencode=json_encode($info);
    echo $infoencode;

?>