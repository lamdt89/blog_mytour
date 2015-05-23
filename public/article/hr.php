<?
require_once ("../require.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Hệ thống nhân sự IT</title>
      <?=$load_header?>
      <style>
         #main-page{
            background: #EEEEEE;
         }
         .navbar{
            margin-bottom: 0px;
         }
         .top-footer{
            margin-top: 0px;
         }
         .paper{
            background: #ffffff;
            margin-bottom: 30px;
            /*height: 600px;*/
            border-radius: 5px;
            padding: 60px 120px;
            /* Webkit (Safari/Chrome) */ -webkit-box-shadow: 0px 0px 5px 0px #999999;
            /* Mozilla Firefox */ -moz-box-shadow: 0px 0px 5px 0px #999999;
            /* Proposed W3C Markup */ box-shadow: 0px 0px 5px 0px #999999;
         }
         .hr-title{
            margin-top: 30px;
            padding: 0px;
         }
         .hr-img{
            width: 180px;
            height: 160px;
            border: solid 1px #cccccc;
         }
         .hr-department{
            margin-bottom: 20px;
         }
         .hr-department-name{
            margin-top: 0px;
         }
         .hr-name{
            padding: 0px;
            margin: 10px 0px 0px 0px;
            font-size: 14px;
            font-weight: bold;
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
            <? include 'views/view_hr.php';?>
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