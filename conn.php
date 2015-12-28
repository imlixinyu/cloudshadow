<?php 
session_start();
//echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
	@$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

	// 连从库
	// $link=mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

	if($link)
	{
    	mysql_select_db(SAE_MYSQL_DB,$link);
    	//your code goes here
        //echo "数据库正常！";
	}
	mysql_set_charset("utf8");
	mysql_query("set names 'utf8'");
	//echo "数据库正常！";
?>