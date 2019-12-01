<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if (@$_GET["is_date"] == '' or @$_GET["ie_date"] == '') {
	$iss_date = date("Ymd");
	$iee_date = date("Ymd");
} else {
	$iss_date = @$_GET["is_date"];
	$iee_date = @$_GET["ie_date"];
}
?>
</head>

<body>
	<div class="x-nav">
		<span class="layui-breadcrumb">
			<a href="">首页</a>
			<a href="">报表清单</a>
			<a><cite>慈善光明行资料</cite></a>

		</span>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
			onclick="location.reload()" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
	</div>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-body ">
						<!--<div>
							<a class="layui-btn layui-btn-normal layui-btn-mini" style="float:right" onclick="xadmin.open('导出花名册','cscst_roster.php?sd=<?php echo $css_date; ?>&ed=<?php echo $cee_date; ?>',1,1);location.reload();" title="导出本页花名册">
								导出花名册
							</a>
						</div>-->
						<form class="layui-form layui-col-space5" action="csinfo_index.php" method="get">
							<div class="layui-inline layui-show-xs-block">
								<input type="text" name="is_date" id="is_date" class="layui-input"
									value="<?php echo $iss_date; ?>">
							</div>
							<div class="layui-inline layui-show-xs-block">
								<input type="text" name="ie_date" id="ie_date" class="layui-input"
									value="<?php echo $iee_date; ?>">
							</div>
							<div class="layui-inline layui-show-xs-block">
								<button class="layui-btn" lay-submit="" lay-filter="sreach"><i
										class="layui-icon">&#xe615;</i></button>
							</div>
						</form>

					</div>
					<div class="layui-card-body layui-table-body layui-table-main">
						<table class="layui-table layui-form">
							<thead>
								<tr style="text-align: center;">
									<th>入院日期</th>
									<th>姓名</th>
									<th>性别</th>
									<th>地址</th>
									<th>眼疾病种</th>
									<th>资料记录</th>
									<th>身份证<br>照片</th>
									<th>病历本<br>照片</th>
									<th>慈善盖章</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$ras = $db->select("inpatient_cst", "*", [
									"AND" => [
											"ic_date[<>]" => [$iss_date, $iee_date],
											"ic_charitable" => "是"
									]
								]);
								//$sql = "SELECT * from inpatient_cst where ic_date >= " . $iss_date . " and ic_date <= " . $iee_date . " and ic_charitable = '是' ORDER BY ic_date desc";
								//$rd = $sdb->query($sql);
								if ($ras == "") {
									echo "无数据";
								} else {
									foreach($ras as $ra) {
										echo "<tr class='text-c'>";
										echo "<td>" . $ra['ic_date'] . "</td>";
										echo "<td>" . $ra['ic_name'] . "</td>";
										echo "<td>" . $ra['ic_sex'] . "</td>";
										echo "<td>" . $ra['ic_address'] . "</td>";
										echo "<td>" . $ra['ic_disease'] . "</td>";

										$rb = $db->count("charitable_info", "*",["AND" => ["ci_name" => $ra['ic_name'],"ci_date" =>$ra['ic_date']]]);
										$rc = $db->get("charitable_info","*",["AND" => ["ci_name" => $ra['ic_name'],"ci_date" =>$ra['ic_date']]]);

										if ($rb == '1') {
											if ($rc['ci_sfz'] !== '0' and $rc['ci_blb'] !== '0' and $rc['ci_cszl'] !== '0') {
												echo "<td><a title='资料完整' <span class='layui-btn l layui-btn-mini'>资料完整</span></a></td>";
											} else {
												echo "<td><a title='缺少资料' <span class='layui-btn layui-btn-normal layui-btn-mini'>缺少资料</span></a></td>";
											}
										} else {

											echo "<td><a title='点击添加' onclick=\"c_add(this,'" . $ra['ic_id'] . "')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-mini'>未添加记录</span></a></td>";
										}

										if ($rc['ci_sfz'] == '0') {
											echo "<td><a onclick=\"c_swi(this,'sfz','1','".$rc['ci_id']."')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-radius'>点击添加</span></a></td>";
										}elseif($rc['ci_sfz'] == '1'){
											echo "<td><span class='layui-btn llayui-btn-primary layui-btn-radius layui-btn-mini'>OK</span></td>";
										}else{
											echo "<td></td>";
										}
										
										if ($rc['ci_blb'] == '0') {
											echo "<td><a onclick=\"c_swi(this,'blb','1','".$rc['ci_id']."')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-radius'>点击添加</span></a></td>";
										}elseif($rc['ci_blb'] == '1'){
											echo "<td><span class='layui-btn llayui-btn-primary layui-btn-radius layui-btn-mini'>OK</span></td>";
										}else{
											echo "<td></td>";
										}

										if ($rc['ci_cszl'] == '0') {
											echo "<td><a onclick=\"c_swi(this,'cszl','1','".$rc['ci_id']."')\" href='javascript:;'><span class='layui-btn layui-btn-danger layui-btn-radius'>点击添加</span></a></td>";
										}elseif($rc['ci_cszl'] == '1'){
											echo "<td><span class='layui-btn llayui-btn-primary layui-btn-radius layui-btn-mini'>OK</span></td>";
										}else{
											echo "<td></td>";
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
	layui.use(['form', 'jquery', 'layer', 'laydate'], function () {
		var form = layui.form,
			layer = layui.layer,
			jquery = layui.jquery,
			laydate = layui.laydate;

		//日期
		laydate.render({
			elem: '#is_date',
			type: 'date',
			format: 'yyyyMMdd'
		});

		laydate.render({
			elem: '#ie_date',
			type: 'date',
			format: 'yyyyMMdd'
		});



	});


	/*添加*/
	function c_add(obj, id) {
		$.ajax({
			type: "get",
			url: "_func.php?act=csinfo&cc_id=" + id,
			success: function (data) {
				if (data == '1') {
					layer.msg('已加入到慈善资料!', {
						time: 2000,
						end: function () {
							location.reload();
						}
					});
				} else {
					layer.msg('加入失败!', {
						icon: 1,
						time: 2000
					});
				}
			}
		});
		return false;
	}


	function c_swi(obj, id1, id2, id3) {
		$.ajax({
			type: "get",
			url: "_func.php?act=cswi&ci_t=" + id1 + "&ci_v=" + id2 + "&ci_id=" + id3,
			success: function (data) {
				if (data == '1') {
					layer.msg('资料已准备!', {
						time: 1000,
						end: function () {
							location.reload();
						}
					})
				} else {
					layer.msg('资料准备错误，请查询问题', {
						icon: 1,
						time: 1000
					});
				}
			}
		});
		return false;
	}
</script>

<!--请在上方写此页面业务相关的脚本-->

</html>