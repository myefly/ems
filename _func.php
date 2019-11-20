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
		$del_id = $_GET['d_id'];
		$del_table = $_GET['d_table'];
		$del_idv = $_GET['d_idv'];

		$dels = $db->delete($del_table, [
			$del_id => $del_idv,
		]);
		echo $dels ->rowCount();
	break;

	case 'daily_search':
		$d_date = $_GET['d_date'];
		$cl_date_numb = $db->count("customers_log", ["cl_date" => $d_date]);
		$oc_date_numb = $db->count("outpatient_cst", ["oc_date" => $d_date]);
		$ic_date_numb = $db->count("inpatient_cst", ["ic_date" => $d_date]);
		echo $cl_date_numb."-".$oc_date_numb."-".$ic_date_numb;
	break;

	case 'month_search':
		$m_date = $_GET['m_date'];
		$mcl_date_numb = $db->count("customers_log", ["cl_date[<>]" => [$m_date.'00', $m_date.'99']]);
		$moc_date_numb = $db->count("outpatient_cst", ["oc_date[<>]" => [$m_date.'00', $m_date.'99']]);
		$mic_date_numb = $db->count("inpatient_cst", ["ic_date[<>]" => [$m_date.'00', $m_date.'99']]);
		echo $mcl_date_numb."-".$moc_date_numb."-".$mic_date_numb;
	break;

	case 'yy_add':
		$ap_date = $_POST['ap_date'];
		$ap_name = $_POST['ap_name'];
		$ap_sex = $_POST['ap_sex'];
		$ap_age = $_POST['ap_age'];
		$ap_pnumb = $_POST['ap_pnumb'];
		$ap_tdate = $_POST['ap_tdate'];
		$ap_note = $_POST['ap_note'];

		$ist_id = $db->insert("appointment_log", [
		    "ap_date" => $ap_date,
		    "ap_name" => $ap_name,
		    "ap_sex" => $ap_sex,
		    "ap_age" => $ap_age,
		    "ap_pnumb" => $ap_pnumb,
		    "ap_tdate" => $ap_tdate,
		    "ap_note" => $ap_note
		]);

		if($ist_id !== ''){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'yy_edit':
		$ap_id = $_POST['ap_id'];
		$ap_date = $_POST['ap_date'];
		$ap_name = $_POST['ap_name'];
		$ap_sex = $_POST['ap_sex'];
		$ap_age = $_POST['ap_age'];
		$ap_pnumb = $_POST['ap_pnumb'];
		$ap_tdate = $_POST['ap_tdate'];
		$ap_note = $_POST['ap_note'];
		
		$upd_id = $db->update("appointment_log", [
			"ap_date" => $ap_date,
		    "ap_name" => $ap_name,
		    "ap_sex" => $ap_sex,
		    "ap_age" => $ap_age,
		    "ap_pnumb" => $ap_pnumb,
		    "ap_tdate" => $ap_tdate,
		    "ap_note" => $ap_note
		], [
			"ap_id" => $ap_id
		]);

		$upd_numb = $upd_id->rowCount();

		if($upd_numb == '1'){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'activity_add':
		$al_date = $_POST['al_date'];
		$al_time = $_POST['al_time'];
 		$al_address = $_POST['al_address'];
 		$al_content = $_POST['al_content'];
 		$al_note = $_POST['al_note'];

		$alt_id = $db->insert("activities_list", [
		    "al_date" => $al_date,
		    "al_time" => $al_time,
		    "al_address" => $al_address,
		    "al_content" => $al_content,
		    "al_note" => $al_note
		]);

		if($alt_id !== ''){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'activity_edit':
		$al_id = $_POST['al_id'];
		$al_date = $_POST['al_date'];
		$al_time = $_POST['al_time'];
 		$al_address = $_POST['al_address'];
 		$al_content = $_POST['al_content'];
 		$al_note = $_POST['al_note'];

		$aled_id = $db->update("activities_list", [
			"al_date" => $al_date,
		    "al_time" => $al_time,
		    "al_address" => $al_address,
		    "al_content" => $al_content,
		    "al_note" => $al_note
		], [
			"al_id" => $al_id
		]);


		if($aled_id !== ''){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'mcst_add':
		$m_id = $_GET['m_id'];
		$c_id = $_GET['c_id'];
		$rm = $db->get("outpatient_log", "*", ["ol_id" => $m_id]);
			$oc_date = $rm["ol_date"];
			$oc_name = $rm["ol_name"];
			$oc_sex = $rm["ol_sex"];
			$oc_age = $rm["ol_age"];
			$oc_address = $rm["ol_address"];
			$oc_diagnosis = $rm["ol_diagnosis"];
			$oc_dtype = $rm["ol_dtype"];
			$oc_doctor = $rm["ol_doctor"];
			$oc_pnumb = $rm["ol_pnumb"];
$add1_sql2 = "INSERT INTO outpatient_cst VALUES (NULL,'".$oc_date."','".$oc_name."','".$oc_sex."','".$oc_age."','".$oc_address."','".$oc_diagnosis."','".$oc_dtype."','".$oc_doctor."','".$oc_pnumb."')";
		$mcst_id = $db->insert("outpatient_cst", [
		    "oc_date" => $oc_date,
		    "oc_name" => $oc_name,
		    "oc_sex" => $oc_sex,
		    "oc_age" => $oc_age,
		    "oc_address" => $oc_address,
		    "oc_diagnosis" => $oc_diagnosis,
		    "oc_dtype" => $oc_dtype,
		    "oc_doctor" => $oc_doctor,
		    "oc_pnumb" => $oc_pnumb,
		    "oc_cid" => $c_id
		]);

		if($mcst_id !== ''){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'csinfo':
	$c_id = $_GET['cc_id'];
	$ra = $db->get("inpatient_cst","*",["ic_id" => $c_id]);
	$ci_name = $ra["ic_name"];
	$ci_date = $ra["ic_date"];
	if ($ci_name  ==  "" or $ci_date == ""){
		echo "0";
		exit();
		break;
	}
	$cs_id = $db->insert("charitable_info", [
		    "ci_date" => $ci_date,
		    "ci_name" => $ci_name,
		    "ci_sfz" => "0",
		    "ci_blb" => "0",
		    "ci_cszl" => "0"
		]);			
	if($cs_id !== ''){
		echo "1";
		exit();
	}else{
		echo "0";
		exit();
		}
	break;
	
	case 'cswi':
		$ci_v = $_GET["ci_v"];
		$ci_id = $_GET["ci_id"];
		$ci_t = "ci_".$_GET["ci_t"];

		$swid = $db->update("charitable_info", [
		    $ci_t => $ci_v
		], [
			"ci_id" => $ci_id
		]);
		
		if($swid == '1'){
			echo '1';
			exit();
		}else{
			echo '1';
			exit();
		}
	break;

	case 'cs_add':
	$c_id = $_GET['cc_id'];
	$rdm = $db->get("inpatient_cst","*",["ic_id" => $c_id]);
	//$add1_sql = "select * from inpatient_cst where ic_id = ".$c_id;
	//$rdm = $sdb->querySingle($add1_sql,true);
	$cc_name = $rdm["ic_name"];
	$cc_sex = $rdm["ic_sex"];
	$cc_age = $rdm["ic_age"];
	$cc_in_date = $rdm["ic_date"];
	$cc_pnumb = $rdm["ic_pnumb"];
	$cc_address = $rdm["ic_address"];
	$cc_disease = $rdm["ic_disease"];
	$cc_opeye = $rdm["ic_opeye"];

	$csadd_id = $db->insert("charitable_cst", [
		    "ci_date" => $ci_date,
		    "ci_name" => $ci_name,
		    "ci_sfz" => "0",
		    "ci_blb" => "0",
		    "ci_cszl" => "0"
		]);
	$add1_sql2 = "INSERT INTO charitable_cst VALUES (NULL,'".$cc_name."','".$cc_sex."','".$cc_age."','','".$cc_pnumb."','".$cc_address."','".$cc_in_date."','','','".$cc_disease."','".$cc_opeye."','','','','','','')";
	$rsm = $sdb->exec($add1_sql2);				
	if($rsm == '1'){
		echo '1';
		$sdb->close();
		exit();
	}else{
		echo '1';
		$sdb->close();
		exit();
	}
	break;


}

?>
