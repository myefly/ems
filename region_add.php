<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");

if($_GET['act']=='add'){
  $rl_id = "";
  $rl_vc_name = "";
  $rl_township = "";
  $rl_county = "";
  $rl_ll = "";
  $bt = "添加区域";
  $lf = "add";
}
if($_GET['act']=='edit'){
  $rl_id = $_GET['r_id'];
  $e_sql = "select * from region_list where r_id = ".$r_id;
  $rs = $ydb->querySingle($e_sql,true);
  $r_vc_name = $rs["r_vc_name"];
  $r_township = $rs["r_township"];
  $r_county = $rs["r_county"];
  $r_ll = $rs["r_ll"];
  $bt = "修改区域信息";
  $lf = "edit";
}
?>
<!--<script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=xv1A6VGWKRIlCCeiVXmgHwohGgc3yKCB"></script>-->
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form">
        <div class="layui-form-item">
          <label class="layui-form-label">村/街道：</label>
          <div class="layui-input-inline">
            <input type="text" name="rl_vc_name" id="rl_vc_name" class="layui-input" autocomplete="off" placeholder="请单击选择日期" value="<?php echo $rl_vc_name?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入村名或者街道名称</div>
        </div>

        <input  type="hidden" id="rl_id" name="rl_id"  value="<?php echo $rl_id?>">

        <div class="layui-form-item">
          <label class="layui-form-label">镇/区：</label>
          <div class="layui-input-inline">
            <input type="text" id="rl_township" name="rl_township" class="layui-input" autocomplete="off" value="<?php echo $rl_township?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入镇名或者区名</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">县/区：</label>
          <div class="layui-input-inline">
            <input type="text" id="rl_county" name="rl_county" class="layui-input" autocomplete="off" value="<?php echo $rl_county?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入县或者区名</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">地图位置：</label>
          <div class="layui-input-inline">
            <input type="text" id="rl_ll" name="rl_ll" class="layui-input" autocomplete="off" value="<?php echo $rl_ll?>">
          </div>
          
        <div class="layui-form-item">
          <label class="layui-form-label">
          </label>
          <button  class="layui-btn" lay-filter="<?php echo $lf?>" lay-submit="">
            <?php echo $bt?>
          </button>
        </div>
      </form>
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

              //监听提交
                form.on('submit(add)',
                  function(data) {
                    $.ajax({
                      url:"region_check.php?act=add",
                      async: false,
                      type:"POST",
                      data:data.field,
                      success: function(data){
                        if (data == '1'){
                          layer.msg('添加成功~',
                                  {icon:1,time:1000},
                                    function() {
                                      //关闭当前frame
                                     xadmin.close();
                                      // 可以对父窗口进行刷新 
                                     xadmin.father_reload();
                                    }
                          );
                        }else{
                          layer.msg('添加失败~~~',{icon:2,time:1000});
                        }
                        
                      }
                      
                   })
                    return false;

                  });
                

//监听编辑
                form.on('submit(edit)',
                  function(data) {
                    $.ajax({
                      url:"region_check.php?act=edit",
                      async: false,
                      type:"POST",
                      data:data.field,
                      success: function(data){
                        if (data == '1'){
                          layer.msg('修改成功~',
                                  {icon:1,time:1000},
                                    function() {
                                      //关闭当前frame
                                     xadmin.close();
                                      // 可以对父窗口进行刷新 
                                     xadmin.father_reload();
                                    }
                          );
                        }else{
                          layer.msg('修改失败~~~',{icon:2,time:1000});
                        }
                        
                      }
                      
                   })
                    return false;

                  });

});
</script>

<!--请在上方写此页面业务相关的脚本-->
</html>