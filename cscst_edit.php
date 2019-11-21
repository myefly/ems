<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
$cc_id = @$_GET["cc_id"];
$rs = $db->get("charitable_cst","*",["cc_id" => $cc_id]);
?>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form">
        <input  type="hidden" id="cc_id" name="cc_id"  value="<?php echo $cc_id?>">
        <div class="layui-form-item">
          <label class="layui-form-label">姓　　名：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="cc_name" id="cc_name"  class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_name"]?>">
          </div>
          <label  class="layui-form-label">性　　别：</label>
          <div class="layui-input-inline" style="width: 100px;">
				<select name="cc_sex"  id="cc_sex" >
            <option value ="男" <?php if ($rs["cc_sex"] == '男'){echo "selected";}?>>男</option>
            <option value ="女"<?php if ($rs["cc_sex"] == '女'){echo "selected";}?>>女</option>
				</select>
          </div>
          <label  class="layui-form-label">年　　龄：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_age" name="cc_age"   class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_age"]?>">
          </div>
          <label  class="layui-form-label">身份证：</label>
          <div class="layui-input-inline" style="width: 200px;">
            <input type="text" id="cc_idcard" name="cc_idcard"   class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_idcard"]?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">联系电话：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_pnumb" name="cc_pnumb"  class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_pnumb"]?>">
          </div>
          <label  class="layui-form-label">地　　址：</label>
          <div class="layui-input-inline" style="width: 200px;">
            <input type="text" id="cc_address" name="cc_address" class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_address"]?>">
          </div>
          <label  class="layui-form-label">眼疾病种：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_disease" name="cc_disease"  class="layui-input" autocomplete="off" value="<?php echo $rs["cc_disease"]?>">
          </div>
          <label  class="layui-form-label">手术眼别：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="cc_opeye"  id="cc_opeye" >
              <option value ="右眼" <?php if ($rs["cc_opeye"] == '右眼'){echo "selected";}?>>右眼</option>
                <option value ="左眼"<?php if ($rs["cc_opeye"] == '左眼'){echo "selected";}?>>左眼</option>
        </select>
          </div>
        </div>
        <div class="layui-form-item">
          <label  class="layui-form-label">入院时间：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="cc_in_date" id="cc_in_date"   class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_in_date"]?>">
          </div>
          <label  class="layui-form-label">手术时间：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="cc_op_date" id="cc_op_date"   class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_op_date"]?>">
          </div>
          <label  class="layui-form-label" style="width: 150px;">医保结算时间：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="cc_ybjs_date" id="cc_ybjs_date"   class="layui-input"  autocomplete="off" value="<?php echo $rs["cc_ybjs_date"]?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">总费用：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_all_money" name="cc_all_money" class="layui-input" autocomplete="off" value="<?php echo $rs["cc_all_money"]?>">
          </div>
          <label  class="layui-form-label">医保报销：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_yb_money" name="cc_yb_money" class="layui-input" autocomplete="off" value="<?php echo $rs["cc_yb_money"]?>">
          </div>
          <label  class="layui-form-label">资助金额：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_zz_money" name="cc_zz_money" class="layui-input" autocomplete="off" value="<?php echo $rs["cc_zz_money"]?>">
          </div>
          
        </div>



        <div class="layui-form-item">
          <label  class="layui-form-label">补贴金额：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_bt_money" name="cc_bt_money" class="layui-input" autocomplete="off" value="<?php echo $rs["cc_bt_money"]?>">
          </div>
          <label  class="layui-form-label">自费：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="cc_own_money" name="cc_own_money"  class="layui-input" autocomplete="off" value="<?php echo $rs["cc_own_money"]?>">
          </div>
          
        </div>

        <div class="layui-form-item">
          <label for="L_email" class="layui-form-label">
            备　　注：
          </label>
          <div class="layui-input-inline" style="width: 400px;">
            <textarea  id="cc_note" name="cc_note" class="layui-textarea"><?php echo $rs["cc_note"]?></textarea>
          </div>
        </div>
        
        <div class="layui-form-item">
          <label class="layui-form-label">
          </label>
          <button  class="layui-btn" lay-filter="edit" lay-submit="" type="submit" >
            修改慈善光明行资料
          </button>
          <div class="layui-input-inline">
            <a  id="mycst" class="layui-btn  layui-btn-danger" onclick="show_cost(this,'<?php echo $rs["cc_in_date"]?>','<?php echo $rs["cc_name"]?>')">查询并填入费用</a>
          </div>
        </div>

      </form>
    </div>
  </div>
  

              </body>

              <!--_foot 作为公共模版分离出去-->
              <?php 
			  require_once ("_foot.php"); ?>
              <!--/_foot 作为公共模版分离出去--> 


              <!--请在下方写此页面业务相关的脚本-->


 <script type="text/javascript">
  function show_cost(obj,ia,ib){
   $.ajax({
    url:"_func.php?act=show_cst&sdate="+ia+"&sname="+ib,
    async: false,
    type:"get",
    success: function(data){
      //layer.msg(data,{time:5000});
      var strs = new Array(); //定义一数组
      strs = data.split("-"); //字符分割
      document.getElementById("cc_all_money").value=strs[0];
      document.getElementById("cc_yb_money").value=strs[1];
      document.getElementById("cc_own_money").value=strs[2];
      var x=document.getElementById("cc_disease").value;
      if (x=='白内障'){
          document.getElementById("cc_zz_money").value='1500';
          document.getElementById("cc_bt_money").value='1500';
      }
      if (x=='翼状胬肉'){
          document.getElementById("cc_zz_money").value='500';
          document.getElementById("cc_bt_money").value='500';
      }
      //document.getElementById("sszy_opcost").value=data;
    }
  });}

                layui.use(['form', 'layedit', 'laydate'], function(){
                  var form = layui.form
                  ,layer = layui.layer
                  ,layedit = layui.layedit
                  ,laydate = layui.laydate;

  //日期
  laydate.render({
    elem: '#cc_in_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

  laydate.render({
    elem: '#cc_op_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

  laydate.render({
    elem: '#cc_ybjs_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

//监听编辑
                form.on('submit(edit)',
                  function(data) {
                    $.ajax({
                      url:"_func.php?act=cscst_edit",
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