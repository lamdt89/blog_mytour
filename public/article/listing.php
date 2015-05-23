<? 
   require_once ("../require.php");
   require_once ("../logged.php");
   require ("controllers/listing.controller.php");
   $cat_id = $_GET['cat_id'];
   $db = new db_query("SELECT * FROM categories WHERE cat_id = ".$cat_id);
   $row2 = mysql_fetch_assoc($db->result);
   $parent = $row2['cat_parent_id'];
   $id = $row2['cat_id'];
   $Menu = new menu();
   $result = $Menu->getAllParent('categories','cat_id','cat_parent_id',$id);
   $count = count($result);
   for($i = $count; $i>0 ; $i--){
      $submenu = new db_query("SELECT * FROM categories WHERE cat_id = ".$result[$i]);
      $row = mysql_fetch_assoc($submenu->result);
      $ncat = $article->removeTitle($row['cat_name']);
      $title = $row['cat_name'];
   }

?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title><?=$title?></title>
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
               include 'views/view_listing.php';
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