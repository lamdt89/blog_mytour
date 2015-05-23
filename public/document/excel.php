<?
require_once ("../require.php");
require_once ("controller/excel.controller.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Đọc file</title>
      <?=$load_header?>
      <link href="themes/css/handsontable/handsontable.full.min.css" rel="stylesheet" >
      <style>
         #header .navbar-default{
            position: fixed;
            top: 0;
            width: 100%;
         }
         #excel{
            margin-top: 60px;
         }
      </style>
   </head>

   <body>
      <div id="header">
         <?php
         include '../views/view_header.php';
         ?>
      </div>

      <div id="excel" class="handsontable"></div>

      <?=$load_footer?>
      <script src="themes/js/jquery.js"></script>
      <script src="themes/js/handsontable/handsontable.full.min.js"></script>
      <script>
         $(document).ready(function () {

            var excel_arr = <?= $excel_json ?>;
            var excel = [];
            $.each(excel_arr,function(key, value){
               var excel1 = [];
               $.each(value,function(key1, value1){
                  if(value1 == null){
                     excel1.push('');
                  }else{
                     excel1.push(value1);
                  }
               });
               excel.push(excel1);
            });

            var container1 = document.getElementById('excel'),hot;

            hot = new Handsontable(container1, {
               data: excel,
               minRows: 50,
               minCols: 24,
               rowHeaders: true,
               colHeaders: true,
               minSpareRows: 1,
               currentRowClassName: 'currentRow',
               currentColClassName: 'currentCol',
               autoWrapRow: true,
               manualColumnResize: true,
               manualRowResize: true,
               mergeCells: true,
               contextMenu: true,
               columnSorting: true,
            });
            hot.selectCell(0,0);

            function bindDumpButton() {

               Handsontable.Dom.addEvent(document.body, 'click', function (e) {

                  var element = e.target || e.srcElement;

                  if (element.nodeName == "BUTTON" && element.name == 'dump') {
                     var name = element.getAttribute('data-dump');
                     var instance = element.getAttribute('data-instance');
                     var hot = window[instance];
                     console.log('data of ' + name, hot.getData());
                  }
               });
            }
            bindDumpButton();

         });
      </script>

   </body>
</html>