<?
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
header('Content-Type: text/html; charset=utf-8');

$fs_table = "posts";
$fs_table_join = " posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id";
$field_data = "posts.*, members.mem_id, members.mem_name, categories.cat_id,categories.cat_name";
$id_field = "pos_id";
$name_field	= "pos_title";
$record_id = getValue('post','int','GET');
$record_id = intval($record_id);

$returnurl     =  base64_decode(getValue("url", "str", "GET", base64_encode("profile")));

// Up ảnh
if( ($pos_time = getValue('pos_time','int','POST')) != 0){
   $dir_img = '../../uploads/images/posts/'.date('Y/m/d/',$pos_time);
   if(!file_exists($dir_img)){
      mkdir($dir_img,0777,true);
   }
   $upanh   = new upload('load_anh',$dir_img,'gif,jpg,png',3000);
}

// Up file
if( ($pos_time = getValue('pos_time','int','POST')) != 0){
   $dir_file = '../../uploads/document/posts/'.date('Y/m/d/',$pos_time);
   if(!file_exists($dir_file)){
      mkdir($dir_file,0777,true);
   }
   $upfile  = new upload('load_file',$dir_file,'doc,docx,pdf,xls,xlsx',10000000);
}

$submitform 	= 	getValue("submit", "str", "POST","");

$myform 	= 	new generate_form();
$pos_cat = getValue("cbbCategory","int","POST");
if($pos_cat == 0){
   $pos_cat = "";
}else{
   $pos_cat = $myform->add("pos_cat_id", "cbbCategory", 1, 0, 0, 1, "Bạn chưa chọn loại bài viết");
}

if($submitform == "Cập nhật"){
   $pos_search = removeAccent(getValue("pos_title", "str", "POST","")).". ".removeAccent(getValue("txt_content","str","POST"));

   if(!$_FILES['load_anh']['name']){
      $img_name = "";
   }else{
      $img_name = $myform->add("pos_img", $upanh->file_name, 0, 0, $upanh->file_name);
   }

   if(!$_FILES['load_file']['name']){
      $file_name = "";
   }else{
      $file_name = $myform->add("pos_att_file", $upfile->file_name, 0, 0, $upfile->file_name);
   }

   $myform->add("pos_title", "pos_title", 0, 0, 0, 1, "Bạn chưa điền tiêu đề ");
   $img_name;
   $file_name;

   $myform->add("pos_content", "txt_content", 0, 0, "", 1, "Bạn chưa nhập nội dung bài viết");
   $myform->add("pos_search", '', 0, 0, removeHTML($pos_search));
   $myform->addTable($fs_table);

   if(isset($_POST['pos_cat_tag'])){
      $post_id  = $record_id;

      $tag_delete = 'DELETE FROM article_tag_cloud WHERE atc_pos_id = '.$post_id;
      $tag_tag_delete = new db_execute($tag_delete);
      unset($tag_tag_delete);

      $tag_query = 'INSERT INTO article_tag_cloud(atc_pos_id,atc_tag_id) VALUES ';
      foreach($_POST['pos_cat_tag'] as $value){
         $tag_query .= "(". $post_id .",". $value ."),";
      }
      $tag_query = substr($tag_query,0,-1);
      $db_tag_insert = new db_execute($tag_query);
      unset($db_tag_insert);
   }

   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();
   //nếu ko có lỗi
   if($fs_errorMsg == ""){

      //echo $myform->generate_update_SQL($id_field, $record_id);
      $db_insert	=	new db_execute($myform->generate_update_SQL($id_field, $record_id));
      unset($db_insert);
      echo "<script>alert('Sửa bài thành công. Vui lòng đợi ban quản trị duyệt bài viết !');</script>";
      redirect($returnurl);
   }

} elseif($record_id){
   $db_data = new db_query("SELECT ".$field_data." FROM " . $fs_table_join . " WHERE " . $id_field . " = " . $record_id);
   if($row = mysql_fetch_assoc($db_data->result)){

      foreach($row as $key=>$value){
         if($key!='lang_id' && $key!='pos_id') $key = $value;
      }
   }
   //Check người đăng bài viết
   if($_SESSION['ses_mem_id'] != $row['pos_mem_id']){
      echo "<script>alert('Bài viết này không phải của bạn không có quyền sửa !');</script>";
      redirect($returnurl);
   }
   //Check bài viết đã được active
   if($row['pos_active'] == 1){
      echo "<script>alert('Bài viết này đã active bạn không có quyền sửa !');</script>";
      redirect($returnurl);
   }
}