<?php
    include "../conn.php";
    //echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
    /*
    function Checknick($nick_input){
    global $name, $id;
    $sql="SELECT * from `user` where `uname`='$nick_input'";
    $result=MySql_query($sql);
    $row=mysql_fetch_array($result);
    $id=$row["ID"];
    $name=$row["name"];
    if(!$row["name"]) return "0";
    }
     */

    /*$id=$_GET['id'];
    $password=$_GET['password'];*/
    $info=array(
        "status"=>0,
        "userinfo"=>array(
                "id"=>"",
                "name"=>"",
                "email"=>"",
                "icon"=>""
        )
    );
    function Checkname($name_input){
        global $name, $id;
        $sql="SELECT * from `user` where `uname`='$name_input'";
        $result=MySql_query($sql);
        $row=mysql_fetch_array($result);
        $name=$row["uname"];
        $id=$row["uid"];
        if(!$row["uname"]) return "error";
    }
    function User_Password($id) //验证密码
    {
        $sql="select `upassword` from `user` where `uid`='$id'";
        $result=MySql_query($sql);
        $row=mysql_fetch_array($result);
        return ($row["upassword"]);
    }
    function getEmail($id)
    {
        $sql="select `uemail` from `user` where `uid`='$id'";
        $result=MySql_query($sql);
        $row=mysql_fetch_array($result);
        return ($row["uemail"]);
    }
    function getIcon($id)
    {
        $sql="select `uimg` from `user` where `uid`='$id'";
        $result=MySql_query($sql);
        $row=mysql_fetch_array($result);
        return ($row["uimg"]);
    }

    //if(!isset($_SESSION['id'])){
        if(true/*!empty($_POST['submit'])*/)
        {
            $name=$_POST['name'];
            $password=$_POST['password'];

            if((!isset($error)) and (Checkname($name))) $error="This name is not in use!";
            if((!isset($error)) and (!$password)) $error="The Password Cannot Be NULL!";
            if(!isset($error))
            {
                $p=User_Password($id);
                if($password!=$p)
                    $error="The Password is Wrong!";
            }
            if(!isset($error))
            {
                $_SESSION['id']=$id;
                $_SESSION['name']=$name;
                //$sql="insert into `online` (`ID`, `name`, `password`, `time`, `idorder`) values ('$id', '$name', '$password', now(),null)";
                //mysql_query($sql);
                $sql="UPDATE `user` SET `ustatus` = '1' WHERE `uid` = '$id'";
                mysql_query($sql);

                $info['status'] = 1;
                $info['userinfo']['name']=$name;
                $info['userinfo']['id']=$id;
                $info['userinfo']['email']=getEmail($id);
                $info['userinfo']['icon']=getIcon($id);
            }
            else
            {
                $info['status'] = 0;
            }
        }
    //}
   /* else{
        $info['status'] = 2;
	    }
        */
	    //var_dump($info);
	    $infoencode = json_encode($info);
	    echo $infoencode;
?>