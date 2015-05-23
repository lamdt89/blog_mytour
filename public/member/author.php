<? 
   require_once ("../require.php");
   require ("controllers/author.controller.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Thông tin cá nhân</title>
   <?=$load_header?>
</head>

<body>
   <div id="header">
   <?php
      include '../views/view_header.php';
   ?>       
   </div>

   <!-- end header -->

   <div id="main" class="main-profile" style="background-color: white;">
      <?php
         include 'views/view_author.php';
      ?>
   </div>

   <!-- end main -->

   <div id="footer">
   <?php
      include '../views/view_footer.php';
   ?> 
   </div>

   <!-- end footer -->

   <?=$load_footer?>

</body>

</html>