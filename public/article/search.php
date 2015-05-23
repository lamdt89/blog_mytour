<? 
   require_once ("../require.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Tìm kiếm</title>
   <?=$load_header?>
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
               include 'views/view_search.php';
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

</body>

</html>