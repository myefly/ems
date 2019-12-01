<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if(@$_GET["r_t"] == ''){
	$rds = $db->select("region_list","*");
}else{
	$rds = $db->select("region_list","*",["rl_township" => $_GET["r_t"]]);
}
?>
<link rel="stylesheet" href="./css/jqueryui.css">
<script type="text/javascript" src="./js/jqueryui.js"></script>
</head>
<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">社筛工作</a>
			<a><cite>筛查区域情况</cite></a>
		</span>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
						<form class="layui-form" action="region_list.php" method="get">
							<div class="layui-form-item">					          
					          <div class="layui-input-inline" >
					            <input type="text" name="r_t" id="r_t" class="layui-input" autocomplete="off" placeholder="输入要查询的镇/区">
					          </div>
					          <div class="layui-input-inline" >
						           <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
					          </div>
					        </div>
					    </form>
						</div>
						<div class="layui-card-body layui-table-body layui-table-main">
							<table class="layui-table layui-form">
								<thead> 
									<tr>
										<th>活动区域</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									if ($rds == ""){
										echo "无数据";
									}else{
										foreach($rds as $rd){
											echo "<tr class='text-c'>";
											echo "<td>".$rd['rl_vc_name']." - ".$rd['rl_township']."</td>";
											echo "<td>";
												$ras = $db->select("activities_list","*",["al_address[~]" => $rd['rl_vc_name']]);
												foreach($ras as $ra){
													echo $ra['al_date'].",";
												}
											echo "</td>";
											echo "</tr>";
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</body>
	<!--_foot 作为公共模版分离出去-->
	<?php require_once ("_foot.php"); ?>
	<!--/_foot 作为公共模版分离出去--> 


	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript">
    $(function() {
        var availableTags = [
        <?php
        	$rbs = $db->select("region_list","*",['GROUP' => 'rl_township']);
			foreach($rbs as $rb){
			    echo "'".$rb['rl_township']."',";

			  }

		?>
 
        ];
        $( "#r_t" ).autocomplete({
            source:
                    function(request, response) {
                        var results = $.ui.autocomplete.filter(availableTags, request.term);
                        response(results.slice(0, 10));//只显示自动提示的前十条数据
                    },
            messages: {
                noResults: '',
                results: function() {}
            },
        });
 
    });
</script>
	<!--请在上方写此页面业务相关的脚本-->
	</html>