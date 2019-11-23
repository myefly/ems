<?php
require_once("lib/chk.php");
require_once("_conn.php");
require_once("_meta.php");
if (@$_GET["cs_date"] == '' or @$_GET["ce_date"] == '') {
	$css_date = date("Ymd");
	$cee_date = date("Ymd");
} else {
	$css_date = @$_GET["cs_date"];
	$cee_date = @$_GET["ce_date"];
}
//echo dirname(__FILE__) . '\Classes\PHPExcel.php';
?>
</head>

<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">报表清单</a>
			<a><cite>慈善光明行清单</cite></a>

		</span>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
	</div>
	<form name="cs_excel" action="cs_excel.php" method="post">
		<input type="hidden" name="cs_excel_sdate" value="<?php echo $css_date; ?>" />
		<input type="hidden" name="cs_excel_edate" value="<?php echo $cee_date; ?>" />
	</form>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-body ">
						<div>
							<a class="layui-btn layui-btn-normal layui-btn-mini" style="float:right" onclick="xadmin.open('导出花名册','cscst_roster.php?sd=<?php echo $css_date; ?>&ed=<?php echo $cee_date; ?>',1,1);" title="导出本页花名册">
								导出花名册
							</a>
						</div>
						<form class="layui-form layui-col-space5" action="cscst_index.php" method="get">
							<div class="layui-inline layui-show-xs-block">
								<input type="text" name="cs_date" id="cs_date" class="layui-input" value="<?php echo $css_date; ?>">
							</div>
							<div class="layui-inline layui-show-xs-block">
								<input type="text" name="ce_date" id="ce_date" class="layui-input" value="<?php echo $cee_date; ?>">
							</div>
							<div class="layui-inline layui-show-xs-block">
								<button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
							</div>
						</form>

					</div>
					<div class="layui-card-body layui-table-body layui-table-main">
						<table class="layui-table layui-form">
							<thead>
								<tr align="center">
									<th>入院日期</th>
									<th>姓名</th>
									<th>性别</th>
									<th>联系电话</th>
									<th>眼疾病种</th>
									<th>术眼</th>
									<th>慈善资料</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$ras = $db->select("inpatient_cst", "*", [
									"AND" => [
										"ic_date[<>]" => [$css_date, $cee_date],
										"ic_charitable" => "是"
									]
								]);

								if ($ras == "") {
									echo "无数据";
								} else {
									foreach ($ras as $ra) {
										echo "<tr class='text-c'>";
										echo "<td>" . $ra['ic_date'] . "</td>";
										echo "<td>" . $ra['ic_name'] . "</td>";
										echo "<td>" . $ra['ic_sex'] . "</td>";
										echo "<td>" . $ra['ic_pnumb'] . "</td>";
										echo "<td>" . $ra['ic_disease'] . "</td>";
										echo "<td>" . $ra['ic_opeye'] . "</td>";

										$rb = $db->count("charitable_cst", "*", ["AND" => ["cc_name" => $ra['ic_name'], "cc_in_date" => $ra['ic_date']]]);

										$rc = $db->get("charitable_cst", "*", ["AND" => ["cc_name" => $ra['ic_name'], "cc_in_date" => $ra['ic_date']]]);
										//$sql2 = "select count(*),cc_id,cc_idcard,cc_ybjs_date from charitable_cst where cc_name = '" . $rr['ic_name'] . "' and cc_in_date = '" . $rr['ic_date'] . "'";


										//$rs = $sdb->querySingle($sql2, true);
										if ($rb == '0') {
											echo "<td><a title='点击添加' onclick=\"cs_add(this,'" . $ra['ic_id'] . "')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-mini'>未添加</span></a></td>";
										} else {
											if ($rc['cc_ybjs_date'] !== '') {
												echo "<td><a title='' onclick=\"xadmin.open('查看','cscst_edit.php?cc_id=" . $rc['cc_id'] . "')\" href='javascript:;'><span class='layui-btn l layui-btn-mini'>资料完整</span></a></td>";
											} else {
												echo "<td><a title='补充修改慈善资料' onclick=\"xadmin.open('补充修改慈善资料','cscst_edit.php?cc_id=" . $rc['cc_id'] . "')\" href='javascript:;'><span class='layui-btn layui-btn-normal layui-btn-mini'>需补充</span></a></td>";
											}
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
<?php require_once("_foot.php"); ?>
<!--/_foot 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->


<script type="text/javascript">
	layui.use(['form', 'layedit', 'laydate'], function() {
		var form = layui.form,
			layer = layui.layer,
			layedit = layui.layedit,
			laydate = layui.laydate;

		//日期
		laydate.render({
			elem: '#cs_date',
			type: 'date',
			format: 'yyyyMMdd'
		});

		laydate.render({
			elem: '#ce_date',
			type: 'date',
			format: 'yyyyMMdd'
		});
	});

	/*添加*/
	function cs_add(obj, id) {
		$.ajax({
			type: "get",
			url: "_func.php?act=cs_add&cc_id=" + id,
			success: function(data) {
				if (data == '1') {
					layer.msg('已加入到慈善清单!', {
						time: 2000,
						end: function() {
							location.reload();
						}
					})
				} else {
					layer.msg('加入错误，请查询问题', {
						icon: 1,
						time: 2000
					});
				}
			}
		});
		return false;
	}

	function m_del(obj, id) {
		layer.confirm('确认要删除吗？', function(index) {
			$.ajax({
				type: "get",
				url: "mz_check.php?act=del&mm_id=" + id,
				success: function(data) {
					if (data == '1') {
						$(obj).parents("tr").remove();
						layer.msg('已删除!', {
							icon: 1,
							time: 1000
						});
					} else {
						layer.msg('删除错误，请查询问题', {
							icon: 1,
							time: 1000
						});
					}
				}
			});
			return false;
		});
	}
</script>

<!--请在上方写此页面业务相关的脚本-->

</html>