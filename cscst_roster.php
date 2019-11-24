<?php
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// 首行
$objPHPExcel->setActiveSheetIndex(0)->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //设置excel文件默认水平垂直方向居中
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:Q1");
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:Q1")->getFont()->setSize(16)->setBold(true); //设置第一行字体大小和加粗
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "爱眼基金会____________________________项目受助对象花名册(".$_GET["sd"]."至".$_GET["ed"].")");
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2:Q2")->getFont()->setBold(true); //设置第二行字体大小和加粗

//写入标题行
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A2", "序号")
->setCellValue("B2", "受助对象姓名")
->setCellValue("C2", "性别")
->setCellValue("D2", "身份证")
->setCellValue("E2", "联系电话")
->setCellValue("F2", "家庭住址")
->setCellValue("G2", "入院时间")
->setCellValue("H2", "眼疾病种")
->setCellValue("I2", "眼别(右/左)")
->setCellValue("J2", "医保结算时间")
->setCellValue("K2", "治疗总费用(元)")
->setCellValue("L2", "医保报销(元)")
->setCellValue("M2", "项目资助金额(元)")
->setCellValue("N2", "自费(元)")
->setCellValue("O2", "基金补助额(元)")
->setCellValue("P2", "贫困类型")
->setCellValue("Q2", "备注"); 


$sdb = new SQLite3("lib/ems.db");
$sql = "SELECT * from charitable_cst where cc_in_date >=" . $_GET["sd"] . " and cc_in_date <=" . $_GET["ed"]." order by cc_in_date";
$rd = $sdb->query($sql);
$si = 1;
$sj = 3;
if ($rd == "") {
    echo "无数据";
} else {
    while ($rr = $rd->fetchArray(SQLITE3_ASSOC)) {
        $objPHPExcel->getActiveSheet()
            ->setCellValue("A" . $sj, $si)
            ->setCellValue("B" . $sj, $rr['cc_name'])
            ->setCellValue("C" . $sj, $rr['cc_sex'])
            ->setCellValue("D" . $sj, " ".$rr['cc_idcard'])
            ->setCellValue("E" . $sj, " ".$rr['cc_pnumb'])
            ->setCellValue("F" . $sj, $rr['cc_address'])
            ->setCellValue("G" . $sj, $rr['cc_in_date'])
            ->setCellValue("H" . $sj, $rr['cc_disease'])
            ->setCellValue("I" . $sj, $rr['cc_opeye'])
            ->setCellValue("J" . $sj, $rr['cc_ybjs_date'])
            ->setCellValue("K" . $sj, $rr['cc_all_money'])
            ->setCellValue("L" . $sj, $rr['cc_yb_money'])
            ->setCellValue("M" . $sj, $rr['cc_zz_money'])
            ->setCellValue("N" . $sj, $rr['cc_own_money'])
            ->setCellValue("O" . $sj, $rr['cc_bt_money'])
            ->setCellValue("P" . $sj, "")
            ->setCellValue("Q" . $sj, $rr['cc_note']); //写值        
        $si = $si + 1;
        $sj = $sj + 1;
    }
}
$sdb->close();
$objPHPExcel->getActiveSheet()->mergeCells("A".$sj.":F".$sj); // 合并单元格
$objPHPExcel->getActiveSheet()->setCellValue("A".$sj, "合计：");
$sj2 = $sj+2;
$sj3 = $sj+3;
$sj4 = $sj+4;
$objPHPExcel->getActiveSheet()->setCellValue("N".$sj2, "填报人：")->setCellValue("N".$sj3, "所在单位全名：")->setCellValue("N".$sj4, "联系电话：");
$lastline = "A1:Q".$sj;
$styleThinBlackBorderOutline = array(
    'borders' => array(
        'allborders' => array( //设置全部边框
            'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle($lastline)->applyFromArray($styleThinBlackBorderOutline);//四周细线




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('花名册');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$files = substr($_GET["sd"],0,6)."_受助对象花名册.xls";
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $files. '"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>