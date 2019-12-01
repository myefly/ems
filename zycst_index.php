<?php
require_once("lib/chk.php");
require_once("_conn.php");
require_once("_meta.php");
if (@$_GET["s_date"] == '' or @$_GET["e_date"] == '') {
  $ss_date = date("Ymd");
  $ee_date = date("Ymd");
} else {
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
      <a><cite>手术住院清单</cite></a>
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
              <a class="layui-btn layui-btn-normal layui-btn-mini" style="float:right" onclick="xadmin.open('入院信息','zycst_add.php?act=add',1080,600)" title="添加"><i class="layui-icon"></i>
                添加入院信息
              </a>
            </div>
            <form class="layui-form layui-col-space5" action="zycst_index.php" method="get">
              <div class="layui-inline layui-show-xs-block">
                <input type="text" name="s_date" id="s_date" class="layui-input" value="<?php echo $ss_date; ?>">
              </div>
              <div class="layui-inline layui-show-xs-block">
                <input type="text" name="e_date" id="e_date" class="layui-input" value="<?php echo $ee_date; ?>">
              </div>
              <div class="layui-inline layui-show-xs-block">
                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
              </div>
            </form>
          </div>
          <div class="layui-card-body layui-table-body layui-table-main">
            <table class="layui-table layui-form">
              <thead>
                <tr>
                  <th>入院日期</th>
                  <th>姓名</th>
                  <th>性别</th>
                  <th>年龄</th>
                  <th>电话</th>
                  <th>病症</th>
                  <th>术眼</th>
                  <th>慈善</th>
                  <th>备注</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $rrs = $db->select("inpatient_cst", "*", ["ic_date[<>]" => [$ss_date, $ee_date]]);
                if ($rrs == "") {
                  echo "无数据，请选择正确的时间~~";
                } else {
                  foreach ($rrs as $rr) {
                    echo "<tr class='text-c'>";
                    echo "<td>" . $rr['ic_date'] . "</td>";
                    echo "<td title='" . $rr['ic_address'] . "'>" . $rr['ic_name'] . "</td>";
                    echo "<td>" . $rr['ic_sex'] . "</td>";
                    echo "<td>" . $rr['ic_age'] . "</td>";
                    echo "<td>" . $rr['ic_pnumb'] . "</td>";
                    echo "<td>" . $rr['ic_disease'] . "</td>";
                    echo "<td>" . $rr['ic_opeye'] . "</td>";
                    echo "<td>" . $rr['ic_charitable'] . "</td>";
                    echo "<td>" . $rr['ic_note'] . "</td>";
                    echo "<td><a title='编辑' onclick=\"xadmin.open('编辑','zycst_add.php?act=edit&szy_id=" . $rr['ic_id'] . "',1080,600)\" href='javascript:;'><i class='layui-icon'>&#xe642;</i></a> | <a title='删除' onclick=\"_del(this,'inpatient_cst','ic_id','" . $rr['ic_id'] . "')\" href='javascript:;'><i class='layui-icon'>&#xe640;</i></a></td>";
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
      elem: '#s_date',
      type: 'date',
      format: 'yyyyMMdd'
    });

    laydate.render({
      elem: '#e_date',
      type: 'date',
      format: 'yyyyMMdd'
    });
  });

  /*删除*/
  function _del(obj, table, id, idv) {
    layer.confirm('确认要删除吗？', function(index) {
      $.ajax({
        type: "get",
        url: "_func.php?act=del&d_id=" + id + "&d_table=" + table + "&d_idv=" + idv,
        success: function(data) {
          if (data == '1') {
            //$(obj).parents("tr").remove();
            layer.msg('删除成功~', {
                icon: 1,
                time: 1000
              },
              function() {
                //关闭当前frame
                //xadmin.close();
                // 可以对父窗口进行刷新 
                location.reload();
              }
            );
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