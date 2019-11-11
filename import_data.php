<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
require_once './Classes/PHPExcel/IOFactory.php';

//判断上传是否出错，没有出错则继续
if ($_FILES["up_file"]["error"] > 0){
  echo "<script>layui.use('layer', function(){
    var layer = layui.layer; 
    layer.msg('上传错误，错误代码：".$_FILES["up_file"]["error"] ."！',
      {icon:1,time:2000},
        function() {
          xadmin.close();
        });
    });</script>";
  exit();
}

// 将文件复制到 upload 目录下并覆盖
move_uploaded_file($_FILES["up_file"]["tmp_name"], "upload/" . $_FILES["up_file"]["name"]);
$fileName = "upload/".$_FILES["up_file"]["name"];

//启用PHPEXCEL
$objPHPExcel = PHPExcel_IOFactory::load($fileName);

//获取sheet表格数目
$sheetCount = $objPHPExcel->getSheetCount();

//默认选中第一张表并加载
$sheetSelected = 0;
$objPHPExcel->setActiveSheetIndex($sheetSelected);

//获取表格行数
$rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();

//判断是表格类型
switch($_GET['act']){
  case 'mz':
    //获取门诊表格第一行内容并判断是否内容齐全
    $z1 = $objPHPExcel->getActiveSheet()->getCell('A'.'1')->getValue();//时间
    $z2 = $objPHPExcel->getActiveSheet()->getCell('B'.'1')->getValue();//姓名
    $z3 = $objPHPExcel->getActiveSheet()->getCell('C'.'1')->getValue();//性别
    $z4 = $objPHPExcel->getActiveSheet()->getCell('D'.'1')->getValue();//年龄
    $z5 = $objPHPExcel->getActiveSheet()->getCell('E'.'1')->getValue();//诊断
    $z6 = $objPHPExcel->getActiveSheet()->getCell('F'.'1')->getValue();//初复查
    $z7 = $objPHPExcel->getActiveSheet()->getCell('G'.'1')->getValue();//医生
    $z8 = $objPHPExcel->getActiveSheet()->getCell('H'.'1')->getValue();//地址
    $z9 = $objPHPExcel->getActiveSheet()->getCell('I'.'1')->getValue();//电话
    if($z1 !== '就诊日期' or $z2 !== '姓名' or $z3 !== '性别' or $z4 !== '年龄' or $z5 !== '诊断'or $z6 !== '初诊/复诊' or $z7 !== '医师签名' or $z8 !== '现住址' or $z9 !== '联系电话' ){
       echo "<script>layui.use('layer', function(){
            var layer = layui.layer; 
            layer.msg('导入门诊表格错误，请检查后再导入',
              {icon:2,time:2000},
              function() {
                xadmin.close();
              });
            });</script>";
      unlink($fileName);
      exit();
      break;
    }
                
    //门诊行数循环
    for ($row = 2; $row <= $rowCount; $row++){
      $ol_date[] = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();//时间
      $ol_name[] = $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue();//姓名
      $ol_sex[] = $objPHPExcel->getActiveSheet()->getCell('C'.$row)->getValue();//性别
      $ol_age[] = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue();//年龄
      $ol_diagnosis[] = $objPHPExcel->getActiveSheet()->getCell('E'.$row)->getValue();//诊断
      $ol_dtype[] = $objPHPExcel->getActiveSheet()->getCell('F'.$row)->getValue();//初复查
      $ol_doctor[] = $objPHPExcel->getActiveSheet()->getCell('G'.$row)->getValue();//医生
      $ol_address[] = $objPHPExcel->getActiveSheet()->getCell('H'.$row)->getValue();//地址
      $ol_pnumb[] = $objPHPExcel->getActiveSheet()->getCell('I'.$row)->getValue();//电话
    }
    //门诊数据循环添加
    for ($i = 0; $i <= $rowCount-2; $i++){
      $o_n = $db->insert("outpatient_log", 
        [
          "ol_date" => $ol_date[$i],
          "ol_name" => $ol_name[$i],
          "ol_sex" => $ol_sex[$i],
          "ol_age" => $ol_age[$i],
          "ol_diagnosis" => $ol_diagnosis[$i],
          "ol_dtype" => $ol_dtype[$i],
          "ol_doctor" => $ol_doctor[$i],
          "ol_address" => $ol_address[$i],
          "ol_pnumb" => $ol_pnumb[$i] 
        ]
      );
    }

    //判断执行行数是否等于内容行数
    if($o_n !== ''){
      //删除复制的文件
      unlink ( $fileName );
      echo "<script>layui.use('layer', function(){
      var layer = layui.layer;
      
      layer.msg('成功导入 ".($rowCount-2)." 条门诊数据',
        {icon:1,time:2000},
          function() {
            //关闭当前frame
           xadmin.close();
            // 可以对父窗口进行刷新 
           xadmin.father_reload();
          }
         );
      });  
      </script>";
    }else{
      echo "门诊数据导入错误";
      unlink ( $fileName );
    }
  break;

  case 'zy':
    //获取门诊表格第一行内容并判断是否内容齐全
    $z1 = $objPHPExcel->getActiveSheet()->getCell('A'.'1')->getValue();
    $z2 = $objPHPExcel->getActiveSheet()->getCell('B'.'1')->getValue();
    $z3 = $objPHPExcel->getActiveSheet()->getCell('C'.'1')->getValue();
    $z4 = $objPHPExcel->getActiveSheet()->getCell('D'.'1')->getValue();
    $z5 = $objPHPExcel->getActiveSheet()->getCell('E'.'1')->getValue();
    $z6 = $objPHPExcel->getActiveSheet()->getCell('F'.'1')->getValue();
    $z7 = $objPHPExcel->getActiveSheet()->getCell('G'.'1')->getValue();
    $z8 = $objPHPExcel->getActiveSheet()->getCell('H'.'1')->getValue();
    $z9 = $objPHPExcel->getActiveSheet()->getCell('I'.'1')->getValue();
    if($z1 !== '住院登记号' or $z2 !== '住院日期' or $z3 !== '姓名' or $z4 !== '合作医疗号' or $z5 !== '性别'or $z6 !== '年龄' or $z7 !== '主治医生' or $z8 !== '病种诊断' or $z9 !== '联系人电话' ){
       echo "<script>layui.use('layer', function(){
            var layer = layui.layer; 
            layer.msg('导入住院表格错误，请检查后再导入',
              {icon:2,time:2000},
              function() {
                xadmin.close();
              });
            });</script>";
      unlink($fileName);
      exit();
      break;
    }
                
    //门诊行数循环
    for ($row = 2; $row <= $rowCount; $row++){
      $ip_numb[] = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();
      $ip_in_date[] = $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue();
      $ip_name[] = $objPHPExcel->getActiveSheet()->getCell('C'.$row)->getValue();
      $ip_cid[] = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue();
      $ip_sex[] = $objPHPExcel->getActiveSheet()->getCell('E'.$row)->getValue();
      $ip_age[] = $objPHPExcel->getActiveSheet()->getCell('F'.$row)->getValue();
      $ip_doctor[] = $objPHPExcel->getActiveSheet()->getCell('G'.$row)->getValue();
      $ip_disease[] = $objPHPExcel->getActiveSheet()->getCell('H'.$row)->getValue();
      $ip_pnumb[] = $objPHPExcel->getActiveSheet()->getCell('I'.$row)->getValue();
    }
    //门诊数据循环添加
    $s = 0;
    for ($i = 0; $i <= $rowCount-2; $i++){
      $sql = "INSERT INTO inpatient_log VALUES (NULL,'".$ip_numb[$i]."','".$ip_in_date[$i]."','".$ip_name[$i]."','".$ip_cid[$i]."','".$ip_sex[$i]."','".$ip_age[$i]."','".$ip_doctor[$i]."','".$ip_disease[$i]."','".$ip_pnumb[$i]."')";
      $rs = $sdb->exec($sql); 
      $s = $rs+$s;
    }

    //判断执行行数是否等于内容行数
    if($s == $rowCount-1){
      //删除复制的文件
      unlink ( $fileName );
      echo "<script>layui.use('layer', function(){
      var layer = layui.layer;
      
      layer.msg('成功导入 ".$s." 条住院数据',
        {icon:1,time:2000},
          function() {
            //关闭当前frame
           xadmin.close();
            // 可以对父窗口进行刷新 
           xadmin.father_reload();
          }
         );
      });  
      </script>";
    }else{
      echo "住院数据导入错误".$s;
      unlink ( $fileName );
    }
    $sdb->close();
  break;

  case 'sc':
    //获取门诊表格第一行内容并判断是否内容齐全
    $z1 = $objPHPExcel->getActiveSheet()->getCell('A'.'1')->getValue();
    $z2 = $objPHPExcel->getActiveSheet()->getCell('B'.'1')->getValue();
    $z3 = $objPHPExcel->getActiveSheet()->getCell('C'.'1')->getValue();
    $z4 = $objPHPExcel->getActiveSheet()->getCell('D'.'1')->getValue();
    $z5 = $objPHPExcel->getActiveSheet()->getCell('E'.'1')->getValue();
    $z6 = $objPHPExcel->getActiveSheet()->getCell('F'.'1')->getValue();
    $z7 = $objPHPExcel->getActiveSheet()->getCell('G'.'1')->getValue();

    if($z1 !== '创建时间' or $z2 !== '姓名' or $z3 !== '性别' or $z4 !== '年龄' or $z5 !== '手机'or $z6 !== '预约否' or $z7 !== '说明'){
       echo "<script>layui.use('layer', function(){
            var layer = layui.layer; 
            layer.msg('导入筛查数据表格错误，请检查后再导入',
              {icon:2,time:2000},
              function() {
                xadmin.close();
              });
            });</script>";
      unlink($fileName);
      exit();
      break;
    }
                
    //行数循环
    for ($row = 2; $row <= $rowCount; $row++){
      $cl_date[] = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();
      $cl_name[] = $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue();
      $cl_sex[] = $objPHPExcel->getActiveSheet()->getCell('C'.$row)->getValue();
      $cl_age[] = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue();
      $cl_pnumb[] = $objPHPExcel->getActiveSheet()->getCell('E'.$row)->getValue();
      $cl_order[] = $objPHPExcel->getActiveSheet()->getCell('F'.$row)->getValue();
      $cl_note[] = $objPHPExcel->getActiveSheet()->getCell('G'.$row)->getValue();
    }
    //数据循环添加
    $s = 0;
    for ($i = 0; $i <= $rowCount-2; $i++){
      $sql = "INSERT INTO customers_log VALUES (NULL,'".$cl_date[$i]."','".$cl_name[$i]."','".$cl_sex[$i]."','".$cl_age[$i]."','".$cl_pnumb[$i]."','".$cl_order[$i]."','".$cl_note[$i]."')";
      $rs = $sdb->exec($sql); 
      $s = $rs+$s;
    }

    //判断执行行数是否等于内容行数
    if($s == $rowCount-1){
      //删除复制的文件
      unlink ( $fileName );
      echo "<script>layui.use('layer', function(){
      var layer = layui.layer;
      
      layer.msg('成功导入 ".$s." 条筛查数据！',
        {icon:1,time:2000},
          function() {
            //关闭当前frame
           xadmin.close();
            // 可以对父窗口进行刷新 
           xadmin.father_reload();
          }
         );
      });  
      </script>";
    }else{
      echo "筛查数据导入错误".$s;
      unlink ( $fileName );
    }
    $sdb->close();
  break;

}


?>
</head>
</html>