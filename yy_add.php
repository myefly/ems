<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
if($_GET['act']=='add'){
  $p_id = "";
  $p_date = "";
  $p_name = "";
  $p_sex = "";
  $p_age = "";
  $p_pnumb = "";
  $p_tdate = date('Ymd');
  $p_note = "";
  $bt = "添加预约信息";
  $lf = "add";
}
if($_GET['act']=='edit'){
  $p_id = $_GET['ap_id'];
  $rs = $db->get("appointment_log","*",["ap_id" => $p_id]);
  $p_date = $rs["ap_date"];
  $p_name = $rs["ap_name"];
  $p_sex = $rs["ap_sex"];
  $p_age = $rs["ap_age"];
  $p_pnumb = $rs["ap_pnumb"];
  $p_tdate = $rs["ap_tdate"];
  $p_note = $rs["ap_note"];
  $bt = "修改预约信息";
  $lf = "edit";
}
?>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form">
        <div class="layui-form-item">
          <label class="layui-form-label">预约日期：</label>
          <div class="layui-input-inline">
            <input type="text" name="ap_date" id="ap_date" class="layui-input" lay-verify="required" autocomplete="off" placeholder="请单击选择日期" value="<?php echo $p_date?>">
          </div>
          <div class="layui-form-mid layui-word-aux">选择患者来院日期</div>
        </div>

        <input  type="hidden" id="ap_id" name="ap_id"  value="<?php echo $p_id?>">

        <div class="layui-form-item">
          <label class="layui-form-label">患者姓名：</label>
          <div class="layui-input-inline">
            <input type="text" id="ap_name" name="ap_name" class="layui-input" lay-verify="required" autocomplete="off" value="<?php echo $p_name?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入患者姓名</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">患者性别：</label>
          <div class="layui-input-inline" >
            <select name="ap_sex"  id="ap_sex" >
              <option value ="男"<?php if($p_sex == '男'){echo "selected";}?>>男</option>
              <option value ="女"<?php if($p_sex == '女'){echo "selected";}?>>女</option>
            </select>
          </div>
          <div class="layui-form-mid layui-word-aux">选择患者性别</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">患者年龄：</label>
          <div class="layui-input-inline">
            <input type="text" id="ap_age" name="ap_age" class="layui-input" autocomplete="off" value="<?php echo $p_age?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入患者年龄</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">联系方式：</label>
          <div class="layui-input-inline">
            <input type="text" id="ap_pnumb" name="ap_pnumb" class="layui-input" autocomplete="off" value="<?php echo $p_pnumb?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入手机号或者其他联系方式</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">添加时间：</label>
          <div class="layui-input-inline">
            <input type="text" id="ap_tdate" name="ap_tdate" class="layui-input" autocomplete="off" value="<?php echo $p_tdate?>">
          </div>
          <div class="layui-form-mid layui-word-aux">预约添加的时间</div>
        </div>

        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">预约情况：</label>
          <div class="layui-input-block">
            <textarea placeholder="请输入内容" id="ap_note" name="ap_note" class="layui-textarea"><?php echo $p_note?></textarea>
          </div>
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
          <?php require_once ("_foot.php");?>
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
                      url:"_func.php?act=yy_add",
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
                
  //日期
  laydate.render({
    elem: '#ap_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

//监听编辑
                form.on('submit(edit)',
                  function(data) {
                    $.ajax({
                      url:"_func.php?act=yy_edit",
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