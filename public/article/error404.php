<?
   require_once ("../require.php");
?>
<!DOCTYPE html>
<html>
<head>
   <title>Error 404</title>  
   <?=$load_header?>
</head>

<body>
   <div id="header">
   <?php
      include '../views/view_header.php';
   ?>       
   </div>

<style type="text/css">
 .error-page {
  margin: 100px 0 40px;
  text-align: center;
}

.error-page__header-image {
  width: 112px;
}
 </style>  
	<main class="content">
		<div class="error-page">
			<header class="error-page__header">
				<img class="error-page__header-image" src="http://<?=$_SERVER['HTTP_HOST']?>/themes/images/error404.gif" alt="Sad computer">
				<h1 class="error-page__title nolinks">Không  tìm thấy trang..!</h1>
			</header>
			<p class="error-page__message">Trang bạn đang tìm kiếm không thể tìm được.</p>
		</div>
	</main>
   <!-- end main -->

   <div id="footer">
   <?
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