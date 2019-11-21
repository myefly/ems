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

	case 'show_cst':
		$sdate = $_GET['sdate'];
		$cname = $_GET['sname'];
		$edate = date('Ymd',strtotime('+5 day',strtotime($sdate)));
		
		$rm = $db->get("inpatient_exp", "*",["AND" => ["ie_name" => $cname,"ie_date[>=]" => $sdate,"ie_date[<=]"=>$edate]]);

		if ($rm == ""){
			echo "无数据，请选择正确的时间~~";
		}else{
			
			echo $rm['ie_all']."-".$rm['ie_rei']."-".$rm['ie_per'];

		}
	break;

	case 'cscst_edit':
	$cc_id = $_POST["cc_id"];

	$cc_name = $_POST["cc_name"];
	$cc_sex = $_POST["cc_sex"];
	$cc_age = $_POST["cc_age"];
	$cc_idcard = $_POST["cc_idcard"];
	$cc_pnumb = $_POST["cc_pnumb"];
	$cc_address = $_POST["cc_address"];
	$cc_disease = $_POST["cc_disease"];
	$cc_opeye = $_POST["cc_opeye"];
	$cc_in_date = $_POST["cc_in_date"];
	$cc_op_date = $_POST["cc_op_date"];
	$cc_ybjs_date = $_POST["cc_ybjs_date"];
	$cc_all_money = $_POST["cc_all_money"];
	$cc_yb_money = $_POST["cc_yb_money"];
	$cc_zz_money = $_POST["cc_zz_money"];
	$cc_bt_money = $_POST["cc_bt_money"];
	$cc_own_money = $_POST["cc_own_money"];
	$cc_note = $_POST["cc_note"];

	$cst_id = $db->update("charitable_cst", [
			"cc_name" => $cc_name,
		    "cc_sex" => $cc_sex,
		    "cc_age" => $cc_age,
		    "cc_idcard" => $cc_idcard,
		    "cc_pnumb" => $cc_pnumb,
		    "cc_address" => $cc_address,
		    "cc_disease" => $cc_disease,
		    "cc_opeye" => $cc_opeye,
		    "cc_in_date" => $cc_in_date,
		    "cc_op_date" => $cc_op_date,
		    "cc_ybjs_date" => $cc_ybjs_date,
		    "cc_all_money" => $cc_all_money,
		    "cc_yb_money" => $cc_yb_money,
		    "cc_zz_money" => $cc_zz_money,
		    "cc_bt_money" => $cc_bt_money,
		    "cc_own_money" => $cc_own_money,
		    "cc_note" => $cc_note
		], [
			"cc_id" => $cc_id
		]);


		if($cst_id !== ''){
			echo "1";
			exit();
		}else{
			echo "0";
			exit();
		}
	break;

	case 'zy_add':
		$s_id = $_GET['ss_id'];
		$rdm = $db->get("inpatient_log", "*",["ip_id"=>$s_id]);
		//$add1_sql = "select * from inpatient_log where ip_id = ".$s_id;
		//$rdm = $sdb->querySingle($add1_sql,true);
			$ic_date = $rdm["ip_in_date"];
			$ic_name = $rdm["ip_name"];
			$ic_sex = $rdm["ip_sex"];
			$ic_age = $rdm["ip_age"];
			$ic_pnumb = $rdm["ip_pnumb"];
			$ic_disease = $rdm["ip_disease"];

		$zyadd_id = $db->insert("inpatient_cst", [
		    "ic_date" => $ic_date,
		    "ic_name" => $ic_name,
		    "ic_sex" => $ic_sex,
		    "ic_age" => $ic_age,
		    "ic_pnumb" => $ic_pnumb,
		    "ic_disease" => $ic_disease
		]);

			if($zyadd_id !== ''){
				echo "1";
				exit();
			}else{
				echo "0";
				exit();
			}
	break;

	case 'zycst_add':
		$sszy_date = $_POST["sszy_date"];
		$sszy_name = $_POST["sszy_name"];
		$sszy_sex = $_POST["sszy_sex"];
		$sszy_age = $_POST["sszy_age"];
		$sszy_pnumb = $_POST["sszy_pnumb"];
		$sszy_op_date = $_POST["sszy_op_date"];
		$sszy_address = $_POST["sszy_address"];
		$sszy_od = $_POST["sszy_od"];
		$sszy_os = $_POST["sszy_os"];
		$sszy_idcard = $_POST["sszy_idcard"];
		$sszy_disease = $_POST["sszy_disease"];
		$sszy_opeye = $_POST["sszy_opeye"];
		$sszy_twoeye = $_POST["sszy_twoeye"];
		$sszy_tedate = $_POST["sszy_tedate"];
		$sszy_charitable = $_POST["sszy_charitable"];
		$sszy_opcost = $_POST["sszy_opcost"];
		$sszy_note = $_POST["sszy_note"];

		$zycst_id = $db->insert("inpatient_cst", [
		    "ic_date" => $sszy_date,
		    "ic_name" => $sszy_name,
		    "ic_sex" => $sszy_sex,
		    "ic_age" => $sszy_age,
		    "ic_op_date" => $sszy_op_date,
		    "ic_pnumb" => $sszy_pnumb,
		    "ic_address" => $sszy_address,
		    "ic_od" => $sszy_od,
		    "ic_os" => $sszy_os,
		    "ic_idcard" => $sszy_idcard,
		    "ic_disease" => $sszy_disease,
		    "ic_opeye" => $sszy_opeye,
		    "ic_twoeye" => $sszy_twoeye,
		    "ic_tedate" => $sszy_tedate,
		    "ic_charitable" => $sszy_charitable,
		    "ic_opcost" => $sszy_opcost,
		    "ic_note" => $sszy_note
		]);
		
		//$p_sql = "INSERT INTO inpatient_cst VALUES (NULL,'".$sszy_date."','".$sszy_name."','".$sszy_sex."','".$sszy_age."','".$sszy_pnumb."','".$sszy_address."','".$sszy_od."','".$sszy_os."','".$sszy_reod."','".$sszy_reos."','".$sszy_disease."','".$sszy_opeye."','".$sszy_twoeye."','".$sszy_tedate."','".$sszy_charitable."','".$sszy_opcost."','".$sszy_note."')";
			//$ret1 = $sdb->exec($p_sql);			
		
		if($zycst_id !== ''){
				echo "1";
				exit();
			}else{
				echo "0";
				exit();
			}
		break;


}

?>
