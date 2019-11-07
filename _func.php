<?php
require_once ("_conn.php"); 
//$act = "";

switch($_GET['act']){
	case 'login_chk':
		session_start();
		$name = $_POST['lgname'];
		$pwd = $_POST['lgpwd'];
		//$sql = "select user_name,user_fullname,user_auth from hz_user where user_name = '".$name."' and user_pwd = '".md5($pwd)."'";
		$rs = $db->get("ems_user", "*",["AND" => ["eu_name" => $name,"eu_pwd" => md5($pwd)]]);
		if ((count($rs)) == 0){
			echo '0';
		}else{
			$_SESSION['name'] = $rs['eu_name'];
			$_SESSION['fullname'] = $rs['eu_fullname'];
			$_SESSION['auth'] = $rs['eu_auth'];
			echo '1';
	}
	break;
		
}

?>
