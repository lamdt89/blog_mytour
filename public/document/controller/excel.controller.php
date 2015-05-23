<?
   if(!isset($_SESSION['ses_mem_id'])) {
      echo "<script>";
      echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
      echo "</script>";
      redirect( base64_decode(getValue("url", "str", "GET", base64_encode("error-file"))) );
   }

   try{
      set_include_path(__DIR__.'/../../../core/controllers/PhpExcel/');
      include 'PHPExcel/IOFactory.php';

      $source_excel = __DIR__.'/../../../uploads/document/posts/'.date('Y/m/d/',$_GET['date']);
      $source_excel .= isset($_GET['file'])? $_GET['file'] : 'test.xls';

      $php_excel    = PHPExcel_IOFactory::load($source_excel);
      $excel_data   = $php_excel->getActiveSheet()->toArray(null,true,true,true);

      $excel_json = json_encode($excel_data);
   }catch(Exception $e){
      echo "<script>";
      echo "alert('Không thể đọc được file do dung lượng quá lớn');";
      echo "</script>";
      $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("download")));
      redirect($returnurl.'?file='.$_GET['file'].'&date='.$_GET['date']);
   }
?>