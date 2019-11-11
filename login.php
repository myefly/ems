<?php
require_once ("_conn.php"); 
session_start();
if(isset($_SESSION['name'])) {
  echo "<script>window.location.href='main.php';</script>";
  exit();
}
?>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title><?php echo constant("EMS_NAME");?> - EMS <?php echo constant("EMS_VERSION");?></title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/login.css">
	  <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message"><?php echo constant("EMS_NAME");?> - EMS <?php echo constant("EMS_VERSION");?></div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            <input id="lgname" name="lgname" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input  id="lgpwd" name="lgpwd" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录"  id="lgbtn" name="lgbtn" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
              //监听提交
              form.on('submit(login)', function(data){
                $.ajax({
                url:'_func.php?act=login_chk',
                data:data.field,
                dataType:'text',
                type:'post',
                success:function (data) {
                    if (data == '1'){
                      layer.msg('    已成功登陆，欢迎使用  ',{time:2500},function(){
                            location.href = "./main.php";
                        });
                        
                    }else{
                        layer.msg('登录名或密码错误,请修改~~~');
                    }
                }
            })
                return false;
              });
            });
        })
    </script>
    <!-- 底部结束 -->
</body>
</html>