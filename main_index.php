<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");

$rcl = $db->select("customers_log", "cl_date", ["ORDER" => ["cl_date" => "DESC"],'LIMIT' => 1]);
$rmz = $db->select("outpatient_log", "ol_date", ["ORDER" => ["ol_date" => "DESC"],'LIMIT' => 1]);
$rzy = $db->select("inpatient_log", "ip_in_date", ["ORDER" => ["ip_in_date" => "DESC"],'LIMIT' => 1]);
$rcs = $db->select("charitable_cst", "cc_in_date", ["ORDER" => ["cc_in_date" => "DESC"],'LIMIT' => 1]);
$rie = $db->select("inpatient_exp", "ie_date", ["ORDER" => ["ie_date" => "DESC"],'LIMIT' => 1]);
?>
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">欢迎用户：
                                <span class="x-red"><?php echo $_SESSION['fullname'];?></span>！当前时间 : <span id="ntime"></span>
                            </blockquote>
                        </div>
                    </div>
                </div>

                 <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                        	最新<span class="layui-badge layui-bg-cyan layuiadmin-badge">患者报备</span>日期
                        	<a onclick="xadmin.open('导入门诊数据','import_file.php')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">                        	                        	
                            <p class="layuiadmin-big-font">
                            	<a  class="x-admin-backlog-body"><h3></h3>
                                        <p><cite><?php echo $rcl[0];?></cite></p>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                        	最新<span class="layui-badge layui-bg-cyan layuiadmin-badge">门诊到院</span>日期
                        	<a onclick="xadmin.open('导入门诊数据','import_file.php')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">                        	                        	
                            <p class="layuiadmin-big-font">
                            	<a  class="x-admin-backlog-body"><h3></h3>
                                        <p><cite><?php echo $rmz[0];?></cite></p>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                        	最新<span class="layui-badge layui-bg-cyan layuiadmin-badge">手术住院</span>日期
                        	<a onclick="xadmin.open('导入门诊数据','import_file.php')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">                        	                        	
                            <p class="layuiadmin-big-font">
                            	<a  class="x-admin-backlog-body"><h3></h3>
                                        <p><cite><?php echo $rzy[0];?></cite></p>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                        	最新<span class="layui-badge layui-bg-cyan layuiadmin-badge">慈善光明行</span>日期
                        	<a onclick="xadmin.open('导入门诊数据','import_file.php')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">                        	                        	
                            <p class="layuiadmin-big-font">
                            	<a  class="x-admin-backlog-body"><h3></h3>
                                        <p><cite><?php echo $rcs[0];?></cite></p>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            最新<span class="layui-badge layui-bg-cyan layuiadmin-badge">住院收费</span>日期
                            <a onclick="xadmin.open('导入门诊数据','import_file.php')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">                                                     
                            <p class="layuiadmin-big-font">
                                <a  class="x-admin-backlog-body"><h3></h3>
                                        <p><cite><?php echo $rie[0];?></cite></p>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class=" layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge"><?php echo date('Ymd');?></span>
                            -
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge"><?php echo date('Ymd')+4;?></span>
                            近五日预约患者
                        	<a onclick="xadmin.open('预约信息','yy_add.php?act=add')"><i class="iconfont">&#xe718;</i></a>
                        </div>
                        <div class="layui-card-body  ">
                        	<?php
                                $rys = $db->select("appointment_log", "*", ["ap_date[<>]" => [date('Ymd'),(date('Ymd')+4)]]);
                                foreach($rys as $ry){
                                    echo "<a class='layui-btn layui-btn-normal' title='".$ry['ap_pnumb'].",".$ry['ap_note']."'> ".$ry['ap_date']."：".$ry['ap_name']."</a>";
                                }
                        		
                        	?> 
                        </div>
                    </div>
                </div>


<?php
$sc_numb = $db->count("customers_log", ["cl_date[<>]" => [date('Ym').'00', date('Ym').'99']]);
$mz_numb = $db->count("outpatient_cst", ["oc_date[<>]" => [date('Ym').'00', date('Ym').'99']]);
$zy_numb = $db->count("inpatient_cst", ["ic_date[<>]" => [date('Ym').'00', date('Ym').'99']]);
?>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">本月数据统计：<?php echo date('Y')."年".date('m')."月";?></div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>筛查建档人数</h3>
                                        <p>
                                            <cite><?php echo $sc_numb;?></cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>门诊到院人数</h3>
                                        <p>
                                            <cite><?php echo $mz_numb;?></cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>住院手术人数</h3>
                                        <p>
                                            <cite><?php echo $zy_numb;?></cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                

                

                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由 SleepyCOW 提供技术支持。</blockquote></div>
            </div>
        </div>
        </div>
    </body>


</html>