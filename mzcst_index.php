<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if(@$_GET["s_date"] == '' or @$_GET["e_date"] == ''){
	$ss_date = date("Ymd");
	$ee_date = date("Ymd");
}else{
	$ss_date = @$_GET["s_date"];
	$ee_date = @$_GET["e_date"];
}
?>
</head>
<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">报表清单</a>
			<a><cite>门诊客户清单</cite></a>
		</span>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
<!-- 主内容开始 -->
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
							<div>
								<a class="layui-btn layui-btn-normal layui-btn-mini" style="float:right" onclick="xadmin.open('导出花名册','mzcst_roster.php?sd=<?php echo $ss_date; ?>&ed=<?php echo $ee_date; ?>',1,1);location.reload();" title="导出本页花名册">导出门诊业绩清单	
								</a>
							</div>
							<form class="layui-form layui-col-space5" action="mzcst_index.php" method="get">
								<div class="layui-inline layui-show-xs-block">
									<input type="text" name="s_date" id="s_date" class="layui-input"  autocomplete="off" value="<?php echo $ss_date;?>">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<input type="text" name="e_date" id="e_date" class="layui-input" autocomplete="off" value="<?php echo $ee_date;?>" >
								</div>
								<div class="layui-inline layui-show-xs-block">
									<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
								</div>
							</form>
							
						</div>

						<div class="layui-card-body layui-table-body layui-table-main">
							<table class="layui-table layui-form" style="text-align: center;">
								<thead> 
									<tr>
										<th style="width: 10px;">操作</th>
										<th>到院日期</th>
										<th>到院姓名</th>
										<th>到院性别</th>
										<th>到院年龄</th>
										<th>现住地址</th>
										<th>到院诊断</th>
										<th>初诊/复诊</th>
										<th>联系电话</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$ras = $db->select("outpatient_cst", "*", ["oc_date[<>]" => [$ss_date,$ee_date]]);
									if ($ras == ""){
										echo "无数据";
									}else{
										foreach($ras as $ra){
											echo "<tr class='text-c'>";
											echo "<td><a title='删除' onclick=\"_del(this,'outpatient_cst','oc_id','".$ra['oc_id']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe640;</i></a></td>";
											echo "<td>".$ra['oc_date']."</td>";
											echo "<td>".$ra['oc_name']."</td>";
											echo "<td>".$ra['oc_sex']."</td>";
											echo "<td>".$ra['oc_age']."</td>";
											echo "<td>".$ra['oc_address']."</td>";
											echo "<td>".$ra['oc_diagnosis']."</td>";
											echo "<td>".$ra['oc_dtype']."</td>";
											echo "<td>".$ra['oc_pnumb']."</td>";
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
		layui.use(['form', 'layedit', 'laydate'], function(){
			var form = layui.form
			,layer = layui.layer
			,layedit = layui.layedit
			,laydate = layui.laydate;

  //日期
  laydate.render({
  	elem: '#s_date'
  	,type: 'date'
  	,format: 'yyyyMMdd'
  });

  laydate.render({
  	elem: '#e_date'
  	,type: 'date'
  	,format: 'yyyyMMdd'
  });
});


		/*删除*/
		function _del(obj,table,id,idv){
			layer.confirm('确认要删除吗？',function(index){
				$.ajax({
					type: "get",
					url: "_func.php?act=del&d_id=" + id + "&d_table=" + table + "&d_idv=" + idv,
					success:function (data) {
						if (data == '1'){
							//$(obj).parents("tr").remove();
							layer.msg('删除成功~',
                                  {icon:1,time:1000},
                                    function() {
                                      //关闭当前frame
                                     //xadmin.close();
                                      // 可以对父窗口进行刷新 
                                     location.reload();
                                    }
                          );
						}else{
							layer.msg('删除错误，请查询问题',{icon:1,time:1000});
						}
					}
				});
				return false;
			});
		}
	</script>

	<!--请在上方写此页面业务相关的脚本-->
	</html>