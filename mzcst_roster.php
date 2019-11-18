<?php
require_once ("_conn.php"); 
require_once './Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel(); //新建phpexcel实例
$objSheet = $objPHPExcel->getActiveSheet(); //获取到sheet
$objSheet->setTitle("门诊业绩清单"); //设置sheet名字
$objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //设置excel文件默认水平垂直方向居中

$objSheet->mergeCells("A1:K1"); // 合并单元格
$objSheet->getStyle("A1:K1")->getFont()->setSize(16)->setBold(true); //设置第一行字体大小和加粗
$objSheet->setCellValue("A1", "门诊业绩清单_".$_GET["sd"]."-".$_GET["ed"]." ");
$objSheet->getStyle("A2:K2")->getFont()->setBold(true); //设置第二行字体大小和加粗
$objSheet->setCellValue("A2", "序号")
    ->setCellValue("B2", "报备日期")
    ->setCellValue("C2", "报备性别")
    ->setCellValue("D2", "报备年龄")
    ->setCellValue("E2", "姓名")
    ->setCellValue("F2", "年龄")
    ->setCellValue("G2", "性别")
    ->setCellValue("H2", "日期")
    ->setCellValue("I2", "地址")
    ->setCellValue("J2", "诊断")
    ->setCellValue("K2", "联系方式");

$ras = $db->select("outpatient_cst", "*", ["oc_date[<>]" => [$_GET["sd"],$_GET["ed"]]]);
$si = 1;
$sj = 3;
if ($ras == "") {
    echo "无数据";
} else {
    foreach($ras as $ra){
        $rb = $db->get("customers_log", "*", ["cl_id" => $ra['oc_cid']]);
        $objSheet->setCellValue("A" . $sj, $si)
            ->setCellValue("B" . $sj, $rb['cl_date'])
            ->setCellValue("C" . $sj, $rb['cl_sex'])
            ->setCellValue("D" . $sj, $rb['cl_age'])
            ->setCellValue("E" . $sj, $ra['oc_name'])
            ->setCellValue("F" . $sj, $ra['oc_age'])
            ->setCellValue("G" . $sj, $ra['oc_sex'])
            ->setCellValue("H" . $sj, $ra['oc_date'])
            ->setCellValue("I" . $sj, $ra['oc_address'])
            ->setCellValue("J" . $sj, $ra['oc_diagnosis'])
            ->setCellValue("K" . $sj, $ra['oc_pnumb']); //写值        
        $si = $si + 1;
        $sj = $sj + 1;
    }
}
$lastline = "A1:K".($sj-1);
$styleThinBlackBorderOutline = array(
    'borders' => array(
        'allborders' => array( //设置全部边框
            'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle($lastline)->applyFromArray($styleThinBlackBorderOutline);//四周细线

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //生成excel文件 如：Excel2007

$files = $_GET["sd"]."-".$_GET["sd"]."_门诊业绩清单.xls";
browser_export('Excel5', $files); //输出到浏览器 设置游览器保存文件名
$objWriter->save("php://output");

function browser_export($type, $filename)
{
    if ($type == "Excel5") {
        header('Content-Type: application/vnd.ms-excel'); //告诉浏览器将要输出excel03文件
    } else {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //告诉浏览器数据excel07文件
    }
    header("Content-Type:text/html;charset=utf-8");
    header('Content-Disposition: attachment;filename="' . $filename . '"'); //告诉浏览器将输出文件的名称
    header('Cache-Control: max-age=0'); //禁止缓存
}
