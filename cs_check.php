<?php
header("Content-Type:text/html;charset=utf-8");
include_once ("conn/chk.php");
include_once ("conn/config.php"); 
date_default_timezone_set("PRC");
$sdb = new SQLite3($mysqlite);
$act = "";


switch($_GET['act']){
	case 'info':
	$c_id = $_GET['cc_id'];
	$info_sql = "select ic_date,ic_name from inpatient_cst where ic_id = ".$c_id;
	$rdm = $sdb->querySingle($info_sql,true);
	$ci_name = $rdm["ic_name"];
	$ci_date = $rdm["ic_date"];
	if ($ci_name  ==  "" or $ci_date == ""){
		echo "0";
		$sdb->close();
		exit();
		break;
	}

	$info_sql2 = "INSERT INTO charitable_info VALUES (NULL,'".$ci_date."','".$ci_name."','0','0','0')";
	$rsm = $sdb->exec($info_sql2);				
	if($rsm == '1'){
		echo "1";
		$sdb->close();
		exit();
	}else{
		echo "0";
		$sdb->close();
		exit();
	}
	break;


	case 'edit':
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


	$e_sql = "update charitable_cst set cc_name = '".$cc_name."',cc_sex = '".$cc_sex."',cc_age = '".$cc_age."',cc_idcard = '".$cc_idcard."',cc_pnumb = '".$cc_pnumb."',cc_address = '".$cc_address."',cc_disease = '".$cc_disease."',cc_opeye = '".$cc_opeye."',cc_in_date = '".$cc_in_date."',cc_op_date = '".$cc_op_date."',cc_ybjs_date = '".$cc_ybjs_date."',cc_all_money = '".$cc_all_money."',cc_yb_money = '".$cc_yb_money."',cc_zz_money = '".$cc_zz_money."',cc_bt_money = '".$cc_bt_money."',cc_own_money = '".$cc_own_money."',cc_note = '".$cc_note."' where cc_id=".$cc_id;
	$ret2 = $sdb->exec($e_sql);
	if($ret2 == '1'){
		echo "1";
		$sdb->close();
		exit();
	}else{
		echo "0";
		$sdb->close();
		exit();
	}
	break;


case 'swi':
$ci_v = $_GET["ci_v"];
$ci_id = $_GET["ci_id"];
if (@$_GET["ci_t"] == 'sfz') {
	$e_sql = "update charitable_info set ci_sfz = '".$ci_v."' where ci_id=".$ci_id;
}
if (@$_GET["ci_t"] == 'blb') {
	$e_sql = "update charitable_info set ci_blb = '".$ci_v."' where ci_id=".$ci_id;
}
if (@$_GET["ci_t"] == 'cszl') {
	$e_sql = "update charitable_info set ci_cszl = '".$ci_v."' where ci_id=".$ci_id;
}
	
	$rsf = $sdb->exec($e_sql);
	if($rsf == '1'){
		echo '1';
		$sdb->close();
		exit();
	}else{
		echo '1';
		$sdb->close();
		exit();
	}
	break;




	case 'del':
	$m_id = $_GET['mm_id'];
	$del_sql ="Delete from outpatient_cst where oc_id='".$m_id."'";
	$rdel = $mdb->exec($del_sql);
	if($rdel == '1'){
		echo "1";
		exit();
	}else{
		echo "0";
		exit();
	}
	break;

	case 'add1':
	$c_id = $_GET['cc_id'];
	$add1_sql = "select * from inpatient_cst where ic_id = ".$c_id;
	$rdm = $sdb->querySingle($add1_sql,true);
	$cc_name = $rdm["ic_name"];
	$cc_sex = $rdm["ic_sex"];
	$cc_age = $rdm["ic_age"];
	$cc_in_date = $rdm["ic_date"];
	$cc_pnumb = $rdm["ic_pnumb"];
	$cc_address = $rdm["ic_address"];
	$cc_disease = $rdm["ic_disease"];
	$cc_opeye = $rdm["ic_opeye"];

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

	case 'cst':
		$sdate = $_GET['sdate'];
		$cname = $_GET['sname'];
		$edate = date('Ymd',strtotime('+5 day',strtotime($sdate)));
		
		$sop_sql = "select * from inpatient_exp where ie_name = '".$cname."' and ie_date >= ".$sdate." and ie_date <= ".$edate;
		$rdm = $sdb->query($sop_sql);
		if ($rdm == ""){
			echo "无数据，请选择正确的时间~~";
		}else{
			while($rm = $rdm->fetchArray(SQLITE3_ASSOC) ){
				//echo $rm['ie_date']."：".$rm['ie_all']."<br>";
				echo $rm['ie_all']."-".$rm['ie_rei']."-".$rm['ie_per'];
			}
		}
	break;

}
?>