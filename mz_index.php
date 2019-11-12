<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if(@$_GET["start_date"] == '' and @$_GET["end_date"] == ''){
	$s_date = date("Ymd");
	$e_date = date("Ymd");
}else{
	$s_date = @$_GET["start_date"];
	$e_date = @$_GET["end_date"];
}
?>
</head>
<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">每日工作</a>
			<a><cite>门诊到院</cite></a>
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
							<form class="layui-form layui-col-space5" action="mz_index.php" method="get">
								<div class="layui-inline layui-show-xs-block">
									<input type="text" name="start_date" id="start_date"  class="layui-input"  value="<?php echo $s_date?>">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<input type="text" name="end_date" id="end_date"  class="layui-input"  value="<?php echo $e_date?>">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
								</div>
							</form>
						</div>
						<div class="layui-card-body layui-table-body layui-table-main" style="text-align: center;">
							<table class="layui-table layui-form">
								<thead> 
									<tr>
										<th>门诊日期</th>
										<th>门诊姓名</th>
										<th>门诊性别</th>
										<th>门诊年龄</th>
										<th>报备年龄</th>
										<th>报备性别</th>
										<th>报备日期</th>
										<th>是否已入清单</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$ras = $db->query("select * from outpatient_log,customers_log WHERE (ol_date BETWEEN '".$s_date."' AND '".$e_date."') and outpatient_log.ol_name = customers_log.cl_name ORDER by ol_name") ->fetchAll();
									if ($ras == ""){
										echo "无数据";
									}else{
										foreach($ras as $ra){
											echo "<tr class='text-c'>";
											echo "<td>".$ra['ol_date']."</td>";
											echo "<td title='".$ra['ol_address']."'>".$ra['ol_name']."</td>";
											echo "<td>".$ra['ol_sex']."</td>";
											echo "<td title='".$ra['ol_pnumb']."'>".$ra['ol_age']."</td>";
											echo "<td title='".$ra['cl_pnumb']."'>".$ra['cl_age']."</td>";
											echo "<td>".$ra['cl_sex']."</td>";
											echo "<td>".$ra['cl_date']."</td>";
											$rb = $db->count("outpatient_cst", "*",["AND" => ["oc_name" => $ra['ol_name'],"oc_date" =>$ra['ol_date']]]);
											$rc = $db->get("outpatient_cst","*",["AND" => ["oc_name" => $ra['ol_name'],"oc_date" =>$ra['ol_date']]]);
											if ($rb == '0' ){
												echo "<td><a title='点击添加' onclick=\"mcst_add(this,'".$ra['ol_id']."')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-mini'>未添加</span></a></td>";
												
											}else{
												echo "<td><a title='点击删除' onclick=\"_del(this,'outpatient_cst','oc_id','".$rc['oc_id']."')\" href='javascript:;'><span class='layui-btn layui-btn-normal layui-btn-mini'>已添加</span></a></td>";
											}
											
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
			
  //开始日期
  laydate.render({
  	elem: '#start_date'
  	,type: 'date'
  	,format: 'yyyyMMdd'
  });

  laydate.render({
  	elem: '#end_date'
  	,type: 'date'
  	,format: 'yyyyMMdd'
  });

});

		/*添加*/
		function mcst_add(obj,id){
			$.ajax({
				type: "get",
				url: "_func.php?act=mcst_add&m_id=" + id,
				success:function (data) {
					if (data == '1'){
						layer.msg('已加入每日到院清单!',{
							time:1000,
							end:function () {
								location.reload(); 
							}
						})	
					}else{
						layer.msg('加入错误，请查询问题',{icon:1,time:2000});
					}
				}
			});
			return false;	
		}

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