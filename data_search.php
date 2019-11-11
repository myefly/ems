<?php
require_once ("lib/chk.php"); 
require_once ("_conn.php"); 
require_once ("_meta.php");
?>
    </head>
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">统计报表</a>
            <a><cite>数据查询</cite></a>
              
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                    	<div class="layui-card-body ">

                            <div class="layui-card-header">
                              <label class="layui-form-label">日查询：</label>
                                <div class="layui-inline layui-show-xs-block">
                                   <input type="text" name="d_date" id="d_date" class="layui-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="layui-card-body ">
                                <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>日筛查人数：</h3>
                                            <p>
                                                <cite id="d_scrs">0</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>日门诊到院人数：</h3>
                                            <p>
                                                <cite id="d_mzrs">0</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>日手术住院人数</h3>
                                            <p>
                                                <cite id="d_zyrs">0</cite></p>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                          </div></div>

                          <div class="layui-card">
                          <div class="layui-card-body ">
                            <div class="layui-card-header">
                              <label class="layui-form-label">月查询：</label>
                                <div class="layui-inline layui-show-xs-block">
                                   <input type="text" name="m_date" id="m_date" class="layui-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="layui-card-body ">
                                <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>月筛查人数：</h3>
                                            <p>
                                                <cite id="m_scrs">0</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>月门诊到院人数：</h3>
                                            <p>
                                                <cite id="m_mzrs">0</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-md2 layui-col-xs6">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>月手术住院人数</h3>
                                            <p>
                                                <cite id="m_zyrs">0</cite></p>
                                        </a>
                                    </li> 
                                </ul>
                            </div>
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
    elem: '#d_date'
    ,type: 'date'
    ,format: 'yyyyMMdd'
    ,done: function(value){
      $.ajax({
        type: "get",
        url: "_func.php?act=daily_search&d_date=" + value,
        success:function (data) {
                
                var strs = new Array(); //定义一数组
                strs = data.split("-");
                document.getElementById("d_scrs").innerHTML = strs[0];
                document.getElementById("d_mzrs").innerHTML = strs[1];
                document.getElementById("d_zyrs").innerHTML = strs[2];
              }
            });
      return false; 
     }
  });

  laydate.render({
    elem: '#m_date'
    ,type: 'month'
    ,format: 'yyyyMM'
    ,done: function(value){
      $.ajax({
        type: "get",
        url: "_func.php?act=month_search&m_date=" + value,
        success:function (data) {
                
                var strs = new Array(); //定义一数组
                strs = data.split("-");
                document.getElementById("m_scrs").innerHTML = strs[0];
                document.getElementById("m_mzrs").innerHTML = strs[1];
                document.getElementById("m_zyrs").innerHTML = strs[2];
              }
            });
      return false; 
     }
  });



  });
  



</script>

<!--请在上方写此页面业务相关的脚本-->
</html>