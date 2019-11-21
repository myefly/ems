<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");

if($_GET['act']=='add'){
$szy_date = "";
$szy_name = "";
$szy_sex = "";
$szy_age = "";
$szy_op_date = "";
$szy_pnumb = "";
$szy_address = "";
$szy_od = "";
$szy_os = "";
$szy_idcard = "";
$szy_disease = "";
$szy_opeye = "";
$szy_twoeye = "";
$szy_tedate = "";
$szy_charitable = "";
$szy_opcost = "";
$szy_note = "";
$bt = "添加入院信息";
$lf = "add";
}

if($_GET['act']=='edit'){
$szy_id = $_GET['szy_id'];
$rs = $db->get("inpatient_cst", "*",["ic_id"=>$szy_id]);
  //$e_sql = "select * from inpatient_cst where ic_id = ".$szy_id;
  //$rs = $sdb->querySingle($e_sql,true);

 $szy_date = $rs["ic_date"];
$szy_name = $rs["ic_name"];
$szy_sex = $rs["ic_sex"];
$szy_age = $rs["ic_age"];
$szy_pnumb = $rs["ic_pnumb"];
$szy_op_date = $rs["ic_op_date"];
$szy_address = $rs["ic_address"];
$szy_od = $rs["ic_od"];
$szy_os = $rs["ic_os"];
$szy_idcard = $rs["ic_idcard"];
$szy_disease = $rs["ic_disease"];
$szy_opeye = $rs["ic_opeye"];
$szy_twoeye = $rs["ic_twoeye"];
$szy_tedate = $rs["ic_tedate"];
$szy_charitable = $rs["ic_charitable"];
$szy_opcost = $rs["ic_opcost"];
$szy_note = $rs["ic_note"];

  $bt = "修改信息";
  $lf = "edit";
}
?>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row">
      <form class="layui-form" >
        <input  type="hidden" id="sszy_id" name="sszy_id"  value="<?php echo $szy_id?>">
        <div class="layui-form-item">
          <label  class="layui-form-label">入院时间：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="sszy_date" id="sszy_date"  class="layui-input" lay-verify="required" autocomplete="off" value="<?php echo $szy_date?>">
          </div>
          <label class="layui-form-label">姓　　名：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="sszy_name" id="sszy_name"  class="layui-input" lay-verify="required" autocomplete="off"  value="<?php echo $szy_name?>">
          </div>
          <label  class="layui-form-label">性　　别：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="sszy_sex"  id="sszy_sex" >
              <option value ="男" <?php if($szy_sex == '男'){echo "selected";}?>>男</option>
              <option value ="女" <?php if($szy_sex == '女'){echo "selected";}?>>女</option>
            </select>
          </div>
          <label  class="layui-form-label">年　　龄：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_age" name="sszy_age" class="layui-input" autocomplete="off" value="<?php echo $szy_age?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">手术日期：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_op_date" name="sszy_op_date" class="layui-input" autocomplete="off" value="<?php echo $szy_op_date?>">
          </div>
          <label  class="layui-form-label">联系电话：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_pnumb" name="sszy_pnumb" class="layui-input" autocomplete="off" value="<?php echo $szy_pnumb?>">
          </div>
          <label  class="layui-form-label">地　　址：</label>
          <div class="layui-input-inline" style="width: 320px;">
            <input type="text" id="sszy_address" name="sszy_address" class="layui-input" autocomplete="off" value="<?php echo $szy_address?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">右眼视力：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_od" name="sszy_od" class="layui-input" autocomplete="off" value="<?php echo $szy_od?>">
          </div>
          <label  class="layui-form-label">左眼视力：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_os" name="sszy_os" class="layui-input" autocomplete="off" value="<?php echo $szy_os?>">
          </div>
          <label  class="layui-form-label">身份证号码：</label>
          <div class="layui-input-inline" style="width: 320px;">
            <input type="text" id="sszy_idcard" name="sszy_idcard" class="layui-input" autocomplete="off" value="<?php echo $szy_idcard;?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">病　　症：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="sszy_disease"  id="sszy_disease" >
              <option value ="白内障" <?php if($szy_disease == '白内障'){echo "selected";}?>>白内障</option>
              <option value ="翼状胬肉" <?php if($szy_disease == '翼状胬肉'){echo "selected";}?>>翼状胬肉</option>
            </select>
          </div>
          <label  class="layui-form-label">术　　眼：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="sszy_opeye"  id="sszy_opeye" >
              <option value ="右眼" <?php if($szy_opeye == '右眼'){echo "selected";}?>>右眼</option>
              <option value ="左眼" <?php if($szy_opeye == '左眼'){echo "selected";}?>>左眼</option>
              <option value ="双眼" <?php if($szy_opeye == '双眼'){echo "selected";}?>>双眼</option>
            </select>
          </div>
          <label  class="layui-form-label">是否二眼：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="sszy_twoeye"  id="sszy_twoeye" >
              <option value ="否" <?php if($szy_twoeye == '否'){echo "selected";}?>>否</option>
              <option value ="是" <?php if($szy_twoeye == '是'){echo "selected";}?>>是</option>
            </select>
          </div>
          <label  class="layui-form-label">二眼时间：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_tedate" name="sszy_tedate" class="layui-input" autocomplete="off" value="<?php echo $szy_tedate?>">
          </div>
        </div>

        <div class="layui-form-item">
          <label  class="layui-form-label">是否慈善：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="sszy_charitable"  id="sszy_charitable" >
              <option value ="否" <?php if($szy_charitable == '否'){echo "selected";}?>>否</option>
              <option value ="是" <?php if($szy_charitable == '是'){echo "selected";}?>>是</option>
            </select>
          </div>
          <label  class="layui-form-label" >手术费用：</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" id="sszy_opcost" name="sszy_opcost" class="layui-input"  autocomplete="off" value="<?php echo $szy_opcost?>" >
          </div>
          <div class="layui-input-inline">
            <a  id="myon" class="layui-btn" onclick="show_opcost(this,'<?php echo $szy_date?>','<?php echo $szy_name?>')">查询费用</a>
          </div>
        </div>

        <div class="layui-form-item layui-form-text">
          <label  class="layui-form-label">备　　注：</label>
          <div class="layui-input-block">
            <textarea placeholder="请输入内容" id="sszy_note" name="sszy_note" class="layui-textarea"><?php echo $szy_note?></textarea>
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
<?php
require_once ("_foot.php"); 
?>
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
    elem: '#sszy_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

    laydate.render({
    elem: '#sszy_op_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

  laydate.render({
    elem: '#sszy_tedate'
    ,type: 'date'
    ,format: 'yyyyMMdd'
  });

//监听提交
                form.on('submit(add)',
                  function(data) {
                    $.ajax({
                      url:"_func.php?act=zycst_add",
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

                //监听修改
                form.on('submit(edit)',
                  function(data) {
                    $.ajax({
                      url:"ss_check.php?act=edit",
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

function show_opcost(obj,ia,ib){
   $.ajax({
    url:"ss_check.php?act=sop&sdate="+ia+"&sname="+ib,
    async: false,
    type:"get",
    success: function(data){
      //layer.msg(data,{time:5000});
      document.getElementById("sszy_opcost").value=data;
    }
  })


   
}

</script>
</html>