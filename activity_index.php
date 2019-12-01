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
			<a href="">社筛活动</a>
			<a><cite>社筛活动安排</cite></a>
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
								<a class="layui-btn layui-btn-normal layui-btn-mini"  onclick="xadmin.open('社筛活动','activity_add.php?act=add')">
									添加社筛活动
								</a>
								<a style="float: right;" class="layui-btn layui-btn-warm layui-btn-mini"  onclick="xadmin.open('活动日历','activity_cal.php')">
									查看活动日历
								</a>
							</div>
							<!--<form class="layui-form layui-col-space5" action="yy_index.php" method="get">
								<div class="layui-inline layui-show-xs-block">
									<input type="text" name="yy_date" id="yy_date"  class="layui-input" placeholder="请选择要查看的日期">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
								</div>
							</form>-->
						</div>
						<div class="layui-card-body layui-table-body layui-table-main">
							<table class="layui-table layui-form">
								<thead> 
									<tr>
										<th>活动日期</th>
										<th>活动时间</th>
										<th>活动星期</th>
										<th>活动地点</th>
										<th>活动内容</th>
										<th>活动备注</th>
										<th>操　作</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$ras = $db->select("activities_list", "*", ["ORDER" => ["al_date" => "DESC"]]);
									if ($ras == ""){
										echo "无数据";
									}else{
										foreach ( $ras as $ra ) {
											echo "<tr class='text-c'>";
											echo "<td>".$ra['al_date']."</td>";
											echo "<td>".$ra['al_time']."</td>";
											$adate=substr($ra['al_date'],0,4)."-".substr($ra['al_date'],4,2)."-".substr($ra['al_date'],6,2);
											echo "<td>".get_week($adate)."</td>";
											echo "<td>".$ra['al_address']."</td>";
											echo "<td>".$ra['al_content']."</td>";
											echo "<td>".$ra['al_note']."</td>";
											echo "<td><a title='编辑'  onclick=\"xadmin.open('编辑','activity_add.php?act=edit&al_id=".$ra['al_id']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe642;</i>
											</a> | <a title='删除' onclick=\"_del(this,'activities_list','al_id','".$ra['al_id']."')\" href='javascript:;'>
											<i class='layui-icon'>&#xe640;</i></a></td>";
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
	<?php
		require_once ("_foot.php");
		function get_week($date){
    //强制转换日期格式
    $date_str=date('Y-m-d',strtotime($date));
    //封装成数组
    $arr=explode("-", $date_str);
    //参数赋值
    //年
    $year=$arr[0];
    //月，输出2位整型，不够2位右对齐
    $month=sprintf('%02d',$arr[1]);
    //日，输出2位整型，不够2位右对齐
    $day=sprintf('%02d',$arr[2]);
    //时分秒默认赋值为0；
    $hour = $minute = $second = 0;
    //转换成时间戳
    $strap = mktime($hour,$minute,$second,$month,$day,$year);
    //获取数字型星期几
    $number_wk=date("w",$strap);
    //自定义星期数组
    $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
    //获取数字对应的星期
    return $weekArr[$number_wk];
  }
	?>
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