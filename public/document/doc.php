<?
require_once ("../require.php");
require_once ("controller/doc.controller.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Đọc file doc</title>
      <?=$load_header?>
      <style>
         #main-page{
            background: #EEEEEE;
         }
         .navbar{
            margin-bottom: 0px;
         }
         .paper{
            background: #ffffff;
            margin-top: 30px;
            margin-bottom: 30px;
            min-height: 400px;
         }
         .top-footer{
            margin-top: 0px;
         }
      </style>
   </head>

   <body>
      <div id="header">
         <?php
         include '../views/view_header.php';
         ?>
      </div>

      <div id="main-page">
         <div class = "container">
            <div class = "row">
               <div class="col-md-8 col-md-offset-2 paper">
                  <?
                  echo file_get_contents($target_file);
                  ?>
               </div>
            </div>
         </div>
      </div>

      <div id="footer">
         <?php
         include '../views/view_footer.php';
         ?>
      </div>

      <?=$load_footer?>

   </body>
</html>