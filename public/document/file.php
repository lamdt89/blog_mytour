<?
   require_once ("../require.php");

   //Check login
   if(!isset($_SESSION['ses_mem_id'])) {
      echo "<script>";
      echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
      echo "</script>";
      redirect( base64_decode(getValue("url", "str", "GET", base64_encode("error-file"))) );
   }else {
      if (isset($_GET['file'])) {
         $file = isset($_GET['file']) ? $_GET['file'] : "";

         $file_ext = substr($file, -3);
         if (!file_exists('../../uploads/document/posts/' . date('Y/m/d/', $_GET['date']) . $_GET['file'])) {
            $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("error-file")));
         } elseif ($file_ext == 'ocx' || $file_ext == 'doc') {
            $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("doc")));
         } elseif ($file_ext == 'pdf') {
            $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("pdf")));
         } elseif ($file_ext == 'xls' || $file_ext == 'lsx') {
            $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("excel")));
         } else {
            $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("blog")));
         }
         redirect($returnurl . '?file=' . $_GET['file'] . '&date=' . $_GET['date']);
      }
   }
?>