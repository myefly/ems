<?php


/** Error reporting */
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// 首行
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:Q1");
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:Q1")->getFont()->setSize(16)->setBold(true); //设置第一行字体大小和加粗
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "爱眼基金会____________________________项目受助对象花名册(".$_GET["sd"]."至".$_GET["ed"].")");





// Add some data
$objPHPExcel->setActiveSheetIndex(0)
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
->setCellValue("Q2", "备注"); //写入标题行

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('花名册');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
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
exit;
