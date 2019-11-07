<script type="text/javascript" charset="utf8" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/dataTables.buttons.js"></script>
<script type="text/javascript" src="./js/buttons.html5.js"></script> 
<script type="text/javascript" src="./js/buttons.print.js"></script>
<script type="text/javascript" src="./js/buttons.flash.js"></script>
<script type="text/javascript">
var lang = {
"sProcessing": "处理中...",
"sLengthMenu": "每页 _MENU_ 项",
"sZeroRecords": "没有匹配结果",
"sInfo": "当前显示第 _START_ 至 _END_ 项，共 _TOTAL_ 项。",
"sInfoEmpty": "当前显示第 0 至 0 项，共 0 项",
"sInfoFiltered": "(由 _MAX_ 项结果过滤)",
"sInfoPostFix": "",
"sSearch": "本地搜索：",
 "sUrl": "",
"sEmptyTable": "暂无数据",
 "sLoadingRecords": "载入中...",
"sInfoThousands": ",",
"oPaginate": {
"sFirst": "首页",
 "sPrevious": "上页",
"sNext": "下页",
 "sLast": "末页",
    "sJump": "跳转"
   },
   "oAria": {
       "sSortAscending": ": 以升序排列此列",
        "sSortDescending": ": 以降序排列此列"
  }
 };

$('.layui-table').DataTable( {
  "language": lang,
  bStateSave: 'true',//状态保存
    dom: 'Bfrtip',
    //buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
    buttons: [
        
            {
                extend: 'print',
                text:'打印',
                title: '打印'
            },
            {
                extend: 'excel',
                text:'导出EXCEL',
                title: '导出数据'
            }
        ]
} );
</script>