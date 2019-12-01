<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");

if($_GET['act']=='add'){
  $l_id = "";
  $l_date = "";
  $l_time = "";
  $l_address = "";
  $l_content = "";
  $l_note = "";
  $bt = "添加社筛活动";
  $lf = "add";
}
if($_GET['act']=='edit'){
  $l_id = $_GET['al_id'];
  $rs = $db->get("activities_list","*",["al_id" => $l_id]);
  $l_date = $rs['al_date'];
  $l_time = $rs['al_time'];
  $l_address = $rs['al_address'];
  $l_content = $rs['al_content'];
  $l_note = $rs['al_note'];
  $bt = "修改社筛活动";
  $lf = "edit";
}
?>

</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form">
        <div class="layui-form-item">
          <label class="layui-form-label">活动日期：</label>
          <div class="layui-input-inline">
            <input type="text" name="al_date" id="al_date" class="layui-input" lay-verify="required" autocomplete="off" placeholder="请单击选择日期" value="<?php echo $l_date?>">
          </div>
          <div class="layui-form-mid layui-word-aux">选择活动日期</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">活动时间：</label>
          <div class="layui-input-inline" >
             <input type="text" name="al_time" id="al_time" class="layui-input" lay-verify="required" autocomplete="off" placeholder="请选择时间" value="<?php echo $l_time?>">
          </div>
          <div class="layui-form-mid layui-word-aux">选择活动开始时间</div>
        </div>

        <input  type="hidden" id="al_id" name="al_id"  value="<?php echo $l_id?>">

        <div class="layui-form-item">
          <label class="layui-form-label">活动地点：</label>
          <div class="layui-input-inline">
            <input type="text" id="al_address" name="al_address" lay-verify="required" autocomplete="off"  class="layui-input" value="<?php echo $l_address?>">
          </div>
          <div class="layui-form-mid layui-word-aux">输入活动地点</div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">活动内容：</label>
          <div class="layui-input-inline" >
            <select name="al_content"  id="al_content" >
              <option value ="筛查"<?php if($l_content == '筛查'){echo "selected";}?>>筛查</option>
              <option value ="讲座"<?php if($l_content == '讲座'){echo "selected";}?>>讲座</option>
            </select>
          </div>
          <div class="layui-form-mid layui-word-aux">选择活动内容</div>
        </div>

        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">活动备注：</label>
          <div class="layui-input-block">
            <textarea placeholder="请输入内容" id="al_note" name="al_note" class="layui-textarea"><?php echo $l_note?></textarea>
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
                      url:"_func.php?act=activity_add",
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
    elem: '#al_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

  laydate.render({
  elem: '#al_time'
  ,type: 'time'
  ,format: 'HH:mm'
});

//监听编辑
                form.on('submit(edit)',
                  function(data) {
                    $.ajax({
                      url:"_func.php?act=activity_edit",
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
<script type="text/javascript">
    $(function() {
        var availableTags = [
          <?php
            $rds = $db->select("region_list", "*");
            foreach($rds as $rd){
              echo "'".$rd['rl_vc_name']." - ".$rd['rl_township']." - ".$rd['rl_county']."',";
            }
          ?>
        ];

    $( "#al_address" ).autocomplete({
            source:
                    function(request, response) {
                        var results = $.ui.autocomplete.filter(availableTags, request.term);
                        response(results.slice(0, 10));//只显示自动提示的前十条数据
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