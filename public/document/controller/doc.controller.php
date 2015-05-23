<?php
   if(!isset($_SESSION['ses_mem_id'])) {
      echo "<script>";
      echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
      echo "</script>";
      redirect( base64_decode(getValue("url", "str", "GET", base64_encode("error-file"))) );
   }
//require_once(__DIR__.'/../libs/PhpWord/Autoloader.php');die;
   require_once(__DIR__.'/../../../core/controllers/PhpWord/Autoloader.php');
   use PhpOffice\PhpWord\Autoloader;
   use PhpOffice\PhpWord\Settings;
   use PhpOffice\PhpWord\IOFactory;

   Autoloader::register();
   Settings::loadConfig();

  	
   $source_doc = isset($_GET['file'])? __DIR__.'/../../../uploads/document/posts/'.date('Y/m/d/',$_GET['date']).$_GET['file'] : __DIR__.'/../../../uploads/document/posts/test.docx';

   $file_ext = substr($_GET['file'],-3);
   if($file_ext == 'doc'){
      try {
         $php_word = IOFactory::load($source_doc, 'MsDoc');
         $xml_write = IOFactory::createWriter($php_word, 'Word2007');
         $xml_write->save(__DIR__ . '/../../../uploads/document/results/result.docx');
         $source_doc = __DIR__ . '/../../../uploads/document/results/result.docx';
      }catch (Exception $e){
         echo "<script>";
         echo "alert('Không thể đọc được file do dung lượng quá lớn');";
         echo "</script>";
         $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("download")));
         redirect($returnurl.'?file='.$_GET['file'].'&date='.$_GET['date']);
      }
   }

   try{
   	$php_word = IOFactory::load($source_doc);
   	$target_dir = "../../uploads/document/results/";
   	if(!file_exists($target_dir)){
	  		mkdir($target_dir,0777,true);
	  	}
   	$target_file = __DIR__.'/../../../uploads/document/results/result_html';
		$php_word->save($target_file,'HTML');
   }catch (Exception $e){
      echo "<script>";
      echo "alert('Không thể đọc được file do dung lượng quá lớn');";
      echo "</script>";
      $returnurl = base64_decode(getValue("url", "str", "GET", base64_encode("download")));
      redirect($returnurl.'?file='.$_GET['file'].'&date='.$_GET['date']);
   }

   

//   echo file_get_contents($target_file);
