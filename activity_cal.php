<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
?>
<script type="text/javascript" src="./js/calendar.js"></script>
<link rel="stylesheet" type="text/css" href="./css/calendar.css" />
</head>
<body>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body layui-table-body layui-table-main">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</body>
	<!--_foot 作为公共模版分离出去-->
	<?php
		require_once ("_foot.php");
	
	?>
	<!--/_foot 作为公共模版分离出去--> 


	<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript">

var data = [
<?php
	$rds = $db->select("activities_list", "*", ["ORDER" => ["al_date" => "DESC"]]);
	foreach($rds as $rd){
		echo "{startDate: '".substr($rd['al_date'],0,4)."-".substr($rd['al_date'],4,2)."-".substr($rd['al_date'],6,2)."',name:'".$rd['al_time'].":".$rd['al_address']."]'},";
	}
?>
	
]

$("#calendar").calendar({
	data: data,
	mode: "month",
	maxEvent: 2,
	showModeBtn: false,
  //  newDate: "2018-04-1",
	cellClick: function (events) {
		//viewCell的事件列表
		//layer.msg('删除成功~');
	},
})
</script>

	<!--请在上方写此页面业务相关的脚本-->
	</html>