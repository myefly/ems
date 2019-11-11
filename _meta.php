<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="./css/font.css">
        <link rel="stylesheet" href="./css/xadmin.css">
        <link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="./css/buttons.dataTables.min.css" />
        <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="./js/xadmin.js"></script>
        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="./js/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/jqueryui.css">
        <script type="text/javascript" src="./js/jqueryui.js"></script>


        <script type="text/javascript">
        $(function () {
            setInterval(getTime, 1000);
        });
 
        function getTime() {
            var dateTime = new Date();
            var hours = dateTime.getHours();
            var minutes = dateTime.getMinutes();
            var seconds = dateTime.getSeconds();
            $("#ntime").text(hours + ":" + minutes + ":" + seconds);
        }
    </script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="./js/html5.min.js"></script>
            <script src="./js/respond.min.js"></script>
        <![endif]-->
        