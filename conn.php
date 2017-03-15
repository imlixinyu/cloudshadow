<!-- meta http-equiv="content-type" content="text/html; charset=UTF-8" /> -->
<?php

	$LOGIN="users";
	//$ONLINE="`online`";
	@mysql_connect("localhost", "root", "") or die("404-mysql连接失败");
	@mysql_select_db("yunying") or die("数据库连接失败");
	mysql_set_charset("utf8");
    date_default_timezone_set('PRC');
	mysql_query("set names 'utf8'");
	//echo "数据库正常！";
?>
