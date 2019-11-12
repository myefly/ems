<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
?>
<script>
// 是否开启刷新记忆tab功能
var is_remember = false;
</script>
<title><?php echo constant("EMS_NAME");?> - EMS <?php echo constant("EMS_VERSION");?></title>
</head>

<body class="index">
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo">
            <a href="./main.php"><?php echo constant("EMS_NAME");?>EMS</a></div>
        <div class="left_open">
            <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;">+导入数据</a>
                <dl class="layui-nav-child">
                    <!-- 二级菜单 -->
                    <dd>
                        <a onclick="xadmin.open('导入门诊数据','import_file.php?itype=mz',1000,400)">
                            <i class="iconfont">&#xe718;</i>导入门诊数据</a>
                    </dd>
                    <dd>
                        <a onclick="xadmin.open('导入住院数据','import_file.php?itype=zy',1000,400)">
                            <i class="iconfont">&#xe718;</i>导入住院数据</a>
                    </dd>
                    <dd>
                        <a onclick="xadmin.open('导入筛查数据','import_file.php?itype=sc',1000,400)">
                            <i class="iconfont">&#xe718;</i>导入筛查数据</a>
                    </dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav left fast-add" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;">+快捷添加</a>
                <dl class="layui-nav-child">
                    <dd>
                        <a onclick="xadmin.open('添加预约信息','yy_add.php?act=add',500,580)">
                            <i class="iconfont">&#xe6b9;</i>添加患者预约信息</a>
                    </dd>
                    <dd>
                        <a onclick="xadmin.open('添加入院信息','sscst_add.php?act=add',1080,600)">
                            <i class="iconfont">&#xe6b9;</i>快速添加入院信息</a>
                    </dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;">用户：<?php echo $_SESSION['fullname']; ?></a>
                <dl class="layui-nav-child">
                    <dd>
                        <a onclick="login_out();" href='javascript:;'>退出</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    <!-- 左侧菜单开始 -->
    <div class="left-nav">
        <div id="side-nav">
            <ul id="nav">
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="社筛工作">&#xe6bf;</i>
                        <cite>社筛工作</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('社筛日报','dr_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>社筛日报</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('社筛活动安排','activity_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>社筛活动安排</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('社筛区域情况','region_list.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>社筛区域情况</cite></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="门诊相关">&#xe723;</i>
                        <cite>门诊相关</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('门诊到院','mz_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>门诊到院确认</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('门诊客户清单','mzcst_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>门诊客户清单</cite></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="住院相关">&#xe723;</i>
                        <cite>住院相关</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('手术住院','zy_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>手术住院确认</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('手术住院清单','sscst_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>手术住院清单</cite></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="慈善相关">&#xe723;</i>
                        <cite>慈善相关</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('慈善光明行清单','cscst_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>慈善光明行清单</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('慈善光明行资料','csinfo_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>慈善光明行资料</cite></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="客户管理">&#xe6b8;</i>
                        <cite>患者管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('患者预约列表','yy_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>患者预约列表</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('客户列表','excel.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>患者跟踪拜访列表</cite></a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="统计报表">&#xe6ce;</i>
                        <cite>统计报表</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('数据查询','data_search.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>数据查询</cite></a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="其它功能">&#xe6b4;</i>
                        <cite>其它功能</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('区域管理','region_index.php')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>区域管理</cite></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
            <ul class="layui-tab-title">
                <li class="home">
                    <i class="layui-icon">&#xe68e;</i>我的桌面</li>
            </ul>
            <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                <dl>
                    <dd data-type="this">关闭当前</dd>
                    <dd data-type="other">关闭其它</dd>
                    <dd data-type="all">关闭全部</dd>
                </dl>
            </div>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src='./main_index.php' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                </div>
            </div>
            <div id="tab_show"></div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <style id="theme_style"></style>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->

</body>
<script type="text/javascript">
	function login_out() {
		$.ajax({
			url: "_func.php?act=login_out",
			success: function(data) {
					layer.msg('已退出!', {
						time: 2000,
						end: function() {
							location.href='login.php';
						}
					})
			}
		});
		return false;
	}
</script>
</html>