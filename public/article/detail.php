<? 
   require_once ("../require.php");
   require_once ("../logged.php");
   require "controllers/detail.controller.php";
   require_once("controllers/vote.controller.php");
   $title = $row['pos_title'];
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title><?=$title;?></title>
   <?=$load_header?>
    <script type="text/javascript" src="themes/js/shCore.js"></script>
    <script type="text/javascript" src="themes/js/shBrushCSharp.js"></script>
    <script type="text/javascript" src="themes/js/shBrushCss.js"></script>
    <script type="text/javascript" src="themes/js/shBrushSql.js"></script>
    <script type="text/javascript" src="themes/js/shBrushPhp.js"></script>
    <script type="text/javascript" src="themes/js/shBrushXml.js"></script>
    <script type="text/javascript" src="themes/js/shBrushJScript.js"></script>
</head>

<body>

   <div id="header">
   <?php
      include '../views/view_header.php';
   ?>       
   </div>

   <!-- end header -->

   <div id="main">
      <div class = "container">
         <div class = "row">
            <div class = "col-md-8">
            <?php
               include 'views/view_detail.php';
            ?>
            </div>
            <div class = "col-md-4">
            <?php
               include '../views/view_sidebar.php';
            ?>
            </div>   
         </div>
      </div>
   </div>

   <!-- end main -->

   <div id="footer">
   <?php
      include '../views/view_footer.php';
   ?> 
   </div>

   <?
      include '../views/view_scroll.php';
   ?>
   
   <!-- end footer -->

   <?=$load_footer?>

   <!-- add script -->
   <script>
       //SyntaxHighlighter.config.bloggerMode = true;
       SyntaxHighlighter.all();


   </script>
</body>

</html>