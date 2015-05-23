<?php

error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
header('Content-Type: text/html; charset=utf-8');
//Lưu ảnh
function Menu($parentid = 0, $space = "", $trees = array())
{
    if(!$trees)
    {
        $trees = array();
    }
   if($_SESSION["ses_dep_id"] == '11'){
      $check_IT = "";
   }else{
      $check_IT = " AND cat_parent_id NOT LIKE 3 AND cat_id NOT LIKE 3 ";
   }
    $db = new db_query("SELECT * FROM categories WHERE cat_parent_id = $parentid AND cat_parent_id NOT LIKE 5 AND cat_id NOT LIKE 5".$check_IT);
    while($rs = mysql_fetch_assoc($db->result))
    {
        $trees[] = array(  'cat_id'    =>    $rs['cat_id'],
                        'cat_name'  => $space.$rs['cat_name']
                        );
        $trees = Menu($rs['cat_id'], $space.'---', $trees);
    }
        return $trees;
}

$dir_image = "../../uploads/images/posts/".date('Y/m/d/');
if(!file_exists($dir_image)){
   mkdir($dir_image,0777,true);
}
$upanh         =   new upload('load_anh',$dir_image,'gif,jpg,png,jpeg',3000);

//Lưu file
$dir_file = "../../uploads/document/posts/".date('Y/m/d/');
if(!file_exists($dir_file)){
   mkdir($dir_file,0777,true);
}
$upfile        =   new upload('load_file',$dir_file,'doc,docx,pdf,xls,xlsx',204800);

$returnurl     =  base64_decode(getValue("url", "str", "GET", base64_encode("profile")));
$fs_action     =  "";
$fs_errorMsg   =  "";
$myform  =  new generate_form();
$id_member = isset($_SESSION["ses_mem_id"]) ? intval($_SESSION["ses_mem_id"]) : 0;
$submitform    =  getValue("new_post", "str", "POST","");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_time = strtotime(date('h:i A d-m-Y'));
$tieude  = "";
$theloai = "";
$noidung = "";
$tag     = "";
if($submitform == "Đăng bài"){
   $fs_errorMsg .= $upanh->common_error;

   if(getValue("cbbCategory","int","POST") == 0){
      $fs_errorMsg .= "&bull; Bạn chưa chọn loại bài viết !<br/>";
   }
   $pos_search     =   removeAccent(getValue("pos_title", "str", "POST"))." . ".removeAccent(getValue("txt_content","str","POST"));    
   $myform->add("pos_title", "pos_title", 0, 0, 0, 1, "Bạn chưa điền tiêu đề !",1,"Tiêu đề bài viết đã tồn tại !");
   $myform->add("pos_time", $current_time, 1, 1, $current_time);

   //CHECK KHÔNG PHẢI IT KHÔNG ĐƯỢC ĐĂNG BÀI TRONG CATEGORY TÀI LIỆU
   $check_cat_IT = new db_query("SELECT * FROM categories WHERE cat_id = ".getValue("cbbCategory","int","POST"));
   $record_check = mysql_fetch_assoc($check_cat_IT->result);
   if($_SESSION['ses_dep_id'] != 11 AND $record_check['cat_has_it'] == 1  ){  
      $fs_errorMsg .= "&bull; Bạn không thể đăng bài trong thể loại thuộc thành viên IT !<br/>";
   }
   //CHECK KHÔNG ĐƯỢC ĐĂNG BÀI TRONG DANH MỤC CHA
   if($record_check['cat_has_child'] == 0){
      
   }else{
      $fs_errorMsg .= "&bull; Bạn không thể đăng bài trong danh mục cha. Vui lòng chọn lại !<br/>";
   }
   // echo $record_check['cat_id'];
   // die();
   //$myform->add("pos_cat_tag", "pos_cat_tag", 0, 0, "", 1, "Bạn chưa nhập tag cho bài viết !");
   $myform->add("pos_cat_id", "cbbCategory", 1, 0, getValue("cbbCategory","int","POST"), 1, "Bạn chưa chọn loại bài viết !");
   $myform->add("pos_content", "txt_content", 6, 0, "", 1, "Bạn chưa nhập nội dung bài viết !");
   $myform->add("pos_search", '', 0, 0, removeHTML($pos_search) );
   if(!$_FILES['load_anh']['name']){
      $fs_errorMsg .= "<span style='float:left;'>&bull; Bạn chưa upload ảnh minh họa cho bài viết !</span><br/>";
   }else{
      $img_name = $upanh->file_name;
      $myform->add("pos_img", $img_name, 0, 0, $img_name);
   }
   if(!$_FILES['load_file']['name']){
      $file_name = "";
   }else{
      if($upfile->common_error == ""){
         $file_name = $upfile->file_name;
         $myform->add("pos_att_file", $file_name, 0, 0, $file_name);
      }else{
         $fs_errorMsg .= $upfile->common_error;
      }
   }
   // if(getValue("cbbCategory","int","POST"))
   $myform->add("pos_active", '', 1, 0, 0 );
   $myform->add("pos_mem_id", $id_member , 1, 1, $id_member );
   $myform->addTable("posts");
   if(empty($_POST['pos_cat_tag']))
   {
      $fs_errorMsg .= "<span style='float:left;'>&bull; Bạn chưa nhập tag cho bài viết !</span><br/>";
   }

   $myform->removeHTML(0); 
   $fs_errorMsg   .= $myform->checkdata();
   //nếu ko có lỗi
   if($fs_errorMsg == ""){
      // echo $myform->generate_insert_SQL();
      // die();
      $db_insert  =  new db_execute($myform->generate_insert_SQL());
      unset($db_insert);

      //Lưu vào bảng tags
      $post  = new db_query("
         SELECT pos_id
         FROM posts
         WHERE pos_title = '". getValue('pos_title','str','POST') ."'
         AND pos_time = ". $current_time ."
      ");
      $post_id = mysql_fetch_assoc($post->result);
      $post_id = $post_id['pos_id'];
      $tag_query = 'INSERT INTO article_tag_cloud(atc_pos_id,atc_tag_id) VALUES ';
      foreach($_POST['pos_cat_tag'] as $value){
         $tag_query .= "(". $post_id .",". $value ."),";
      }
      $tag_query = substr($tag_query,0,-1);
      $db_tag_insert = new db_execute($tag_query);
      unset($db_tag_insert);

      //Thảo luận

      $vot_option = getValue('vop_name','arr','POST');
      if(!is_null($vot_option)  ){
         $vop_query = "INSERT INTO vote_option(vop_name,vop_pos_id,vop_active) VALUES ";
         foreach($vot_option as $value){
            if($value != ""){
               $vop_query .= "('". replace_keyword_search($value,0) ."',".$post_id.",1),";
            }            
         }
         $vop_query = substr($vop_query,0,-1);
         $vop_query = new db_execute($vop_query);
         unset($vop_query);
      }
      
      //Chuyển trang 
      echo "<script>alert('Đăng bài thành công. Vui lòng đợi ban quản trị duyệt bài viết !');</script>";
      redirect($returnurl);

   }else{
      $tieude = getValue("pos_title","str","POST");
      $theloai = getValue("cbbCategory","int","POST");
      $noidung = getValue("txt_content","str","POST");
      $tag = getValue("pos_cat_tag","str","POST");
   }
}