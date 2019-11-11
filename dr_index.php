<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if(@$_GET["mzdy_date"] == ''){
	$m_date = date("Ymd");
}else{
	$m_date = @$_GET["mzdy_date"];
}
?>
    </head>
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">每日工作</a>
            <a><cite>社筛日报</cite></a>
              
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
                                <a class="layui-btn layui-btn-normal layui-btn-mini"  onclick="xadmin.open('添加社筛日报','dr_add.php?act=add')" title="添加"><i class="layui-icon"></i>
                                    添加社筛日报
                                </a>
                            </div>
                              
                        </div>

                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                                <thead> 
                                  <tr>
                                    <th>日期</th>
                                    <th>筛查地点</th>
                                    <th>筛查人数</th>
                                    <th>预约人数</th>
                                    <th>到院人数</th>
                                    <th>今日入院</th>
                                    <th>操作</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $ras = $db->select("daily_report", "*", ["ORDER" => ["dr_date" => "DESC"],'LIMIT' => 40]);
                                    if ($ras == ""){
                                    	echo "无数据";
                                    }else{
                                        foreach($ras as $ra){
                                            echo "<tr class='text-c'>";
                                            echo "<td>".$ra['dr_date']."</td>";
                                            echo "<td>".$ra['dr_scdd']."</td>";
                                            echo "<td>".$ra['dr_scrs']."</td>";
                                            echo "<td>".$ra['dr_yyrs']."</td>";
                                            echo "<td>".$ra['dr_dyrs']."</td>";
                                            echo "<td>".$ra['dr_ry']."</td>";
                                            echo "<td><a title='编辑'  onclick=\"xadmin.open('编辑','dr_add.php?act=edit&dr_id=".$ra['dr_id']."')\" href='javascript:;'>
                                                <i class='layui-icon'>&#xe642;</i>
                                                </a> | <a title='删除' onclick=\"_del(this,'daily_report','dr_id',".$ra['dr_id']."')\" href='javascript:;'>
                                                <i class='layui-icon'>&#xe640;</i></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    
                                    $sdb->close();
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
    elem: '#mzdy_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });
  });

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
                });
                return false;
            });
        }

</script>

<!--请在上方写此页面业务相关的脚本-->
</html>