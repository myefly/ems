<?php
require_once("lib/chk.php");
require_once("_conn.php");
require_once("_meta.php");

if ($_GET['act'] == 'add') {
  $r_id = "";
  $r_date = date("Ymd");
  $r_scdd = "无";
  $r_scrs = "0";
  $r_yyrs = "0";
  $r_dyrs = $db->count("outpatient_cst", "*", ["oc_date" => $r_date]);
  $y_jg = "0";
  $y_bnz = $db->count("inpatient_cst", "*", ["AND" => ["ic_disease" => '白内障', "ic_date" => $r_date]]);
  $y_nr = $db->count("inpatient_cst", "*", ["AND" => ["ic_disease" => '翼状胬肉', "ic_date" => $r_date]]);
  $y_yd = "0";
  $y_ld = "0";
  $y_other = "0";
  $s_jg = "0";
  $s_bnz = "0";
  $s_nr = "0";
  $s_yd = "0";
  $s_ld = "0";
  $s_other = "0";
  $r_pj = "0";
  $r_ry = $db->count("inpatient_cst", "*", ["ic_date" => $r_date]);
  $r_note = "无";
  $bt = "添 加 日 报";
  $lf = "add";
}
if ($_GET['act'] == 'edit') {
  $r_id = $_GET['dr_id'];
  $ry = $db->get("daily_report", "*", ["dr_id" => $r_id]);
  $r_date = $ry["dr_date"];
  $r_scdd = $ry["dr_scdd"];
  $r_scrs = $ry["dr_scrs"];
  $r_yyrs = $ry["dr_yyrs"];
  $r_dyrs = $ry["dr_dyrs"];
  $y_jg = $ry["yy_jg"];
  $y_bnz = $ry["yy_bnz"];
  $y_nr = $ry["yy_nr"];
  $y_yd = $ry["yy_yd"];
  $y_ld = $ry["yy_ld"];
  $y_other = $ry["yy_other"];
  $s_jg = $ry["ss_jg"];
  $s_bnz = $ry["ss_bnz"];
  $s_nr = $ry["ss_nr"];
  $s_yd = $ry["ss_yd"];
  $s_ld = $ry["ss_ld"];
  $s_other = $ry["ss_other"];
  $r_pj = $ry["dr_pj"];
  $r_ry = $ry["dr_ry"];
  $r_note = $ry["dr_note"];
  $bt = "修 改 日 报";
  $lf = "edit";
}
?>
<link rel="stylesheet" href="./css/jqueryui.css">
<script type="text/javascript" src="./js/jqueryui.js"></script>
</head>

<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form">
        <input type="hidden" id="dr_id" name="dr_id" value="<?php echo $r_id ?>">
        <div class="layui-form-item">
          <label class="layui-form-label">日报时间：</label>
          <div class="layui-input-inline">
            <input type="text" name="dr_date" id="dr_date" class="layui-input" lay-verify="required" autocomplete="off" value="<?php echo $r_date; ?>">
          </div>
          <label class="layui-form-label">筛查地点：</label>
          <div class="layui-input-inline">
            <input type="text" id="dr_scdd" name="dr_scdd" class="layui-input" autocomplete="off" value="<?php echo $r_scdd; ?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">筛查人数：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="dr_scrs" name="dr_scrs" class="layui-input" autocomplete="off" value="<?php echo $r_scrs; ?>">
          </div>
          <label class="layui-form-label">预约人数：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="dr_yyrs" name="dr_yyrs" class="layui-input" autocomplete="off" value="<?php echo $r_yyrs; ?>">
          </div>
          <label class="layui-form-label">到院人数：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="dr_dyrs" name="dr_dyrs" class="layui-input" autocomplete="off" value="<?php echo $r_dyrs; ?>">
          </div>
        </div>

        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">预约手术量：</label>
          <div class="layui-input-inline">
            <table class="layui-table" style="width: 400px;">
              <tbody>
                <tr align="center" style=" font-weight: bold;">
                  <td>激　光</td>
                  <td>白内障</td>
                  <td>胬　肉</td>
                  <td>眼　底</td>
                  <td>泪　道</td>
                  <td>其　他</td>
                </tr>
                <tr align="center">
                  <td><input type="text" id="yy_jg" name="yy_jg" class="layui-input" autocomplete="off" value="<?php echo $y_jg; ?>"></td>
                  <td><input type="text" id="yy_bnz" name="yy_bnz" class="layui-input" autocomplete="off" value="<?php echo $y_bnz; ?>"></td>
                  <td><input type="text" id="yy_nr" name="yy_nr" class="layui-input" autocomplete="off" value="<?php echo $y_nr; ?>"></td>
                  <td><input type="text" id="yy_yd" name="yy_yd" class="layui-input" autocomplete="off" value="<?php echo $y_yd; ?>"></td>
                  <td><input type="text" id="yy_ld" name="yy_ld" class="layui-input" autocomplete="off" value="<?php echo $y_ld; ?>"></td>
                  <td><input type="text" id="yy_other" name="yy_other" class="layui-input" autocomplete="off" value="<?php echo $y_other; ?>"></td>
                </tr>
              </tbody>
            </table>
          </div>
          　
        </div>

        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">当日手术量：</label>
          <div class="layui-input-inline">
            <table class="layui-table" style="width: 400px;">
              <tbody>
                <tr align="center" style=" font-weight: bold;">
                  <td>激　光</td>
                  <td>白内障</td>
                  <td>胬　肉</td>
                  <td>眼　底</td>
                  <td>泪　道</td>
                  <td>其　他</td>
                </tr>
                <tr align="center">
                  <td><input type="text" id="ss_jg" name="ss_jg" class="layui-input" autocomplete="off" value="<?php echo $s_jg; ?>"></td>
                  <td><input type="text" id="ss_bnz" name="ss_bnz" class="layui-input" autocomplete="off" value="<?php echo $s_bnz; ?>"></td>
                  <td><input type="text" id="ss_nr" name="ss_nr" class="layui-input" autocomplete="off" value="<?php echo $s_nr; ?>"></td>
                  <td><input type="text" id="ss_yd" name="ss_yd" class="layui-input" autocomplete="off" value="<?php echo $s_yd; ?>"></td>
                  <td><input type="text" id="ss_ld" name="ss_ld" class="layui-input" autocomplete="off" value="<?php echo $s_ld; ?>"></td>
                  <td><input type="text" id="ss_other" name="ss_other" class="layui-input" autocomplete="off" value="<?php echo $s_other; ?>"></td>
                </tr>
              </tbody>
            </table>
          </div>
          　
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">配镜量：</label>
          <div class="layui-input-inline">
            <input type="text" id="dr_pj" name="dr_pj" class="layui-input" autocomplete="off" value="<?php echo $r_pj; ?>">
          </div>

          <label class="layui-form-label">今日入院：</label>
          <div class="layui-input-inline">
            <input type="text" id="dr_ry" name="dr_ry" class="layui-input" autocomplete="off" value="<?php echo $r_ry; ?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">
            备　　注：
          </label>
          <div class="layui-input-block">
            <textarea id="dr_note" name="dr_note" class="layui-textarea" autocomplete="off"><?php echo $r_note ?></textarea>
          </div>
        </div>

        <div class="layui-form-item">
          <label for="L_repass" class="layui-form-label">
          </label>
          <button class="layui-btn" lay-filter="<?php echo $lf ?>" lay-submit="">
            <?php echo $bt ?>
          </button>
        </div>
      </form>
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

    //监听提交
    form.on('submit(add)',
      function(data) {
        $.ajax({
          url: "_func.php?act=dr_add",
          async: false,
          type: "POST",
          data: data.field,
          success: function(data) {
            if (data == '1') {
              layer.msg('添加成功~', {
                  icon: 1,
                  time: 1000
                },
                function() {
                  //关闭当前frame
                  xadmin.close();
                  // 可以对父窗口进行刷新 
                  xadmin.father_reload();
                }
              );
            } else {
              layer.msg('添加失败~~~', {
                icon: 2,
                time: 1000
              });
            }

          }

        })
        return false;

      });

    //监听修改
    form.on('submit(edit)',
      function(data) {
        $.ajax({
          url: "_func.php?act=dr_edit",
          async: false,
          type: "POST",
          data: data.field,
          success: function(data) {
            if (data == '1') {
              layer.msg('修改成功~', {
                  icon: 1,
                  time: 1000
                },
                function() {
                  //关闭当前frame
                  xadmin.close();
                  // 可以对父窗口进行刷新 
                  xadmin.father_reload();
                }
              );
            } else {
              layer.msg('修改失败~~~', {
                icon: 2,
                time: 1000
              });
            }

          }

        })
        return false;

      });

    //日期
    laydate.render({
      elem: '#dr_date',
      type: 'date',
      format: 'yyyyMMdd'
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    var availableTags = [
      <?php
      $rrs = $db->select("region_list", "*");
      foreach ($rrs as $rr) {
        echo "'" . $rr['rl_vc_name'] . " - " . $rr['rl_township'] . " - " . $rr['rl_county'] . "',";
      }

      ?>

    ];
    $("#dr_scdd").autocomplete({
      source: function(request, response) {
        var results = $.ui.autocomplete.filter(availableTags, request.term);
        response(results.slice(0, 10)); //只显示自动提示的前十条数据
      },
      messages: {
        noResults: '',
        results: function() {}
      },
    });

  });
</script>
<!--请在上方写此页面业务相关的脚本-->

</html>