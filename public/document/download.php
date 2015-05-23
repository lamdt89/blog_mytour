<?php
   require_once ("../require.php");

   //Check Login
   if(!isset($_SESSION['ses_mem_id'])) {
      echo "<script>";
      echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
      echo "</script>";
      redirect( base64_decode(getValue("url", "str", "GET", base64_encode("error-file"))) );
   }

   if(isset($_GET['file'])) {
      $file = isset($_GET['file']) ? $_GET['file'] : "";
      if( file_exists('../../uploads/document/posts/'.date('Y/m/d/',$_GET['date']).$_GET['file']) ){
         redirect('uploads/document/posts/'.date('Y/m/d/',$_GET['date']).$file);
      }else{
         $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("error-file")));
         redirect($returnurl);
      }
   }