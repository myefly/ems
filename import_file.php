<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");

switch($_GET['itype']){
	case 'mz':
		$typ = "mz";
		$imp = "门诊";
	break;
	case 'zy':
		$typ = "zy";
		$imp = "住院";
	break;
	case 'sc':
		$typ = "sc";
		$imp = "筛查";
	break;
}

?>
</head>

<body>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">
								注意： <span style="color: red;">文件名</span> 和 <span style="color: red;">文件路径</span> 中不要出现中文~~~
                            </blockquote>
                        </div>
                    </div>
            </div>

			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-body ">
							<div class="layui-form-item">
							<form class="layui-form " action="import_data.php?act=<?php echo $_GET['itype'];?>" method="post" enctype="multipart/form-data">
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="file" name="up_file" id="up_file"  class="layui-btn layui-btn-normal">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  type="file" >上传<?php echo $imp;?>数据</button>
                                </div>
                            </form>
							</div>
					</div>
				</div>
			</div>

			<div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                        	<div class="layui-tab">
							  <ul class="layui-tab-title">
							    <li <?php if($_GET['itype'] == 'mz'){echo "class='layui-this'";}?>>门诊数据样式</li>
							    <li <?php if($_GET['itype'] == 'zy'){echo "class='layui-this'";}?>>住院数据样式</li>
							    <li <?php if($_GET['itype'] == 'sc'){echo "class='layui-this'";}?>>筛查数据样式</li>
							  </ul>
							  <div class="layui-tab-content">
							    <div class="layui-tab-item <?php if($_GET['itype'] == 'mz'){echo "layui-show";}?>">
							    	<table border="1" cellspacing="0" cellpadding="0">
										<tr style="text-align: center; font-weight: bold;">
											<td>就诊日期</td>
											<td>姓名</td>
											<td>性别</td>
											<td>年龄</td>
											<td>诊断</td>
											<td>初诊/复诊</td>
											<td>医生签名</td>
											<td>现住址</td>
											<td>联系电话</td>
										</tr>
										<tr style="text-align: center;">
											<td style="padding-left: 20px;padding-right: 20px;">20190101</td>
											<td style="padding-left: 20px;padding-right: 20px;">张三</td>
											<td style="padding-left: 20px;padding-right: 20px;">男</td>
											<td style="padding-left: 20px;padding-right: 20px;">88</td>
											<td style="padding-left: 20px;padding-right: 20px;">干眼症</td>
											<td style="padding-left: 20px;padding-right: 20px;">复诊</td>
											<td style="padding-left: 20px;padding-right: 20px;">王医生</td>
											<td style="padding-left: 20px;padding-right: 20px;">浙江湖州吴兴区</td>
											<td style="padding-left: 20px;padding-right: 20px;">18888888888</td>
										</tr>
									</table>
								</div>
							    <div class="layui-tab-item <?php if($_GET['itype'] == 'zy'){echo "layui-show";}?>">
							    	<table border="1" cellspacing="0" cellpadding="0">
										<tr style="text-align: center; font-weight: bold;">
											<td>住院登记号</td>
											<td>住院日期</td>
											<td>姓名</td>
											<td>合作医疗号</td>
											<td>性别</td>
											<td>年龄</td>
											<td>主治医生</td>
											<td>病种诊断</td>
											<td>联系人电话</td>
										</tr>
										<tr style="text-align: center;">
											<td style="padding-left: 20px;padding-right: 20px;">2019001569</td>
											<td style="padding-left: 20px;padding-right: 20px;">20190101</td>
											<td style="padding-left: 20px;padding-right: 20px;">张三</td>
											<td style="padding-left: 20px;padding-right: 20px;">B01016701</td>
											<td style="padding-left: 20px;padding-right: 20px;">男</td>
											<td style="padding-left: 20px;padding-right: 20px;">88</td>
											<td style="padding-left: 20px;padding-right: 20px;">王医生</td>
											<td style="padding-left: 20px;padding-right: 20px;">白内障</td>
											<td style="padding-left: 20px;padding-right: 20px;">18888888888</td>
										</tr>
									</table>
							    </div>
							    <div class="layui-tab-item <?php if($_GET['itype'] == 'sc'){echo "layui-show";}?>">
							    	<table border="1" cellspacing="0" cellpadding="0">
										<tr style="text-align: center; font-weight: bold;">
											<td>创建时间</td>
											<td>姓名</td>
											<td>性别</td>
											<td>年龄</td>
											<td>手机</td>
											<td>预约否</td>
											<td>说明</td>
										</tr>
										<tr style="text-align: center;">
											<td style="padding-left: 20px;padding-right: 20px;">20190101</td>
											<td style="padding-left: 20px;padding-right: 20px;">张三</td>
											<td style="padding-left: 20px;padding-right: 20px;">男</td>
											<td style="padding-left: 20px;padding-right: 20px;">88</td>
											<td style="padding-left: 20px;padding-right: 20px;">18888888888</td>
											<td style="padding-left: 20px;padding-right: 20px;">否</td>
											<td style="padding-left: 20px;padding-right: 20px;">胬肉，湖州</td>
										</tr>
									</table>
							    </div>
							  </div>
							</div> 
                        </div>
                    </div>
                </div>
		</div>
	</div>



</body>

</html>