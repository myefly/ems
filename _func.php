<?php
require_once ("_conn.php"); 
//$act = "";

switch($_GET['act']){
	case 'login_chk':
		session_start();
		$name = $_POST['lgname'];
		$pwd = $_POST['lgpwd'];
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

	case 'login_out':
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
      		setcookie(session_name(), '', time()-42000, '/');
 		}
 		// 最后彻底销毁session.
		session_destroy();
	break;

	case 'del':
		$del_id = $_POST['d_id'];
		$del_table = $_POST['d_table'];

		$dels = $db->delete($del_table, [
			"rl_id" => $del_id,
		]);
		echo $dels ->rowCount();
	break;
	
}

?>
