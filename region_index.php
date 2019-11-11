<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
?>
</head>
<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">其他功能</a>
			<a><cite>区域管理</cite></a>
		</span>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
							<div>
								<a class="layui-btn layui-btn-normal layui-btn-mini"  onclick="xadmin.open('添加区域','region_add.php?act=add')">
									添加筛查区域
								</a>
							</div>
						</div>
						<div class="layui-card-body layui-table-body layui-table-main">
							<table class="layui-table layui-form">
								<thead> 
									<tr>
										<th>村/街道</th>
										<th>镇/区</th>
										<th>县/区</th>
										<th>地图</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$dbs = $db->select("region_list", "*");
									foreach ( $dbs as $rs ) {
											echo "<tr class='text-c'>";
											echo "<td>".$rs['rl_vc_name']."</td>";
											echo "<td>".$rs['rl_township']."</td>";
											echo "<td>".$rs['rl_county']."</td>";
											echo "<td><a title='编辑'  onclick=\"xadmin.open('查看地图','region_map.php?r_ll=".$rs['rl_ll']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe715;</i>
											</a></td>";
											echo "<td><a title='编辑'  onclick=\"xadmin.open('编辑','region_add.php?act=edit&r_id=".$rs['rl_id']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe642;</i>
											</a> | <a title='删除' onclick=\"_del(this,'region_list','rl_id','".$rs['rl_id']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe640;</i></a></td>";
											echo "</tr>";
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