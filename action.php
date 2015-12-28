<?php
	function actionCh($action){
		switch (action){
			case 'login':
				header("Location: login.php?name=$name");
		}
	}
	
?>