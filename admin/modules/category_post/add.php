<?
// thêm các phần cần thiết
include "inc_security.php";
//
checkAddEdit("add");

$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'add')){
   redirect($fs_denypath);
}

$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));

$fs_action		=	"";
$fs_errorMsg	=	"";
$submitform 	= 	getValue("submit", "str", "POST","");
// Khởi tạo form
$myform 	= 	new generate_form();
if($submitform == "Thêm mới"){
//   var_dump(getValue('cat_parent_id','int','POST'));die;
   $myform->add('cat_name','cat_name', '0', '0' ,'0', '1', 'Bạn chưa điền tên Danh mục', '1', 'Tên Danh mục đã tồn tại');
   $myform->add('cat_parent_id', 'cat_parent_id', '0', '0', '0');
   $myform->add('cat_active', '0', '0', '0', '0');
   $myform->add('cat_has_child', '0' , '0', '0' ,'0');
   //$myform->add('cat_is_login', 'cat_is_login', '0', '0', '0');
   $myform->add('cat_show_menu', 'cat_show_menu', 0, 0, 1);
    $it = getValue('cat_show_menu','int','POST');
   if($it == 2) {
       $myform->add('cat_is_login', '', 1, 0, 1);
       $myform->add('cat_has_it', '', 1, 0, 1);
   }
    elseif($it == 0) {
        $myform->add('cat_is_login', '', 1, 0, 1);
    } elseif($it == 1) {
       $myform->add('cat_is_login', '', 1, 0, 0);
   } else {}
   $myform->addTable($fs_table);
   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();
   if($fs_errorMsg == ""){
       // echo 	$myform->generate_insert_SQL();
      $db_insert	=	new db_execute($myform->generate_insert_SQL());
      unset($db_insert);

      //Cho danh mục trước thành cha
      $parent_id = getValue('cat_parent_id','int','POST');
      $db_update_parent = new db_execute("UPDATE ".$fs_table." SET cat_has_child = 1 WHERE cat_id = ".$parent_id);
      unset ($db_update_parent);

      redirect($returnurl);

   }
}
$form = new form();
?>

<!-- Phần HTML -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      <?= $load_header ?>
      <? $myform->checkjavascript();?>
      <?
         $myform->addFormname("add_new");
         $myform->evaluate();
         $fs_errorMsg	.=	$myform->strErrorField;
      ?>
   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <?=template_top(translate_text("Add merchant"))?>
      <p align="center" style="padding-left:10px;">
         <?
            $form->create_form("add_new",$fs_action,"post","multipart/form-data","onsubmit='validateForm(); return false;'");
            $form->create_table();
         ?>
         <?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
         <?=$form->errorMsg($fs_errorMsg)?>
         <?=$form->text("Tên Danh mục", "cat_name", "cat_name", '', "Tên Danh mục", 1, 250, 20, 255)?>
         <?//$form->select_db("Danh mục gốc" , "cat_parent_id", "cat_parent_id",$db_select = new db_query("SELECT cat_id,cat_name FROM categories WHERE cat_parent_id = 0"),"cat_id",'cat_name','0','Chọn danh mục cha');?>
         <tr>
            <td><label style="float:right;font-size: 12px;">Danh mục cha : </label></td>
            <td >
               <select name="cat_parent_id" style="width:150px;height: 24px;margin-left: 5px;font-size: 12px;">
                  <option selected="selected">- Chọn danh mục bài viết -</option>
                  <?
                     $menu = Menu(0);
                     foreach($menu as $k => $row)
                     {
                        echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';

                     }
                  ?>

             </select><br />
            </td>
         </tr>
         <tr>
            <td><label style="float:right;font-size: 12px;">Hiển thị menu :</label></td>
            <td>
               <select name="cat_show_menu" style="width:150px;height: 24px;margin-left: 5px;font-size: 12px;">
                 <?php
                     $show_arr = array(0=>'Kiểm tra đăng nhập',1=>'Không cần đăng nhập',2=>'Chỉ có nhân viên IT');
                     foreach ($show_arr as $key => $value) {
                 ?>
                     <option value="<?php echo $key?>"><?php echo $value?></option>
                 <?php
                     }
                 ?>
               </select>
            </td>
         </tr>

         <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Thêm mới" . $form->ec . "Làm lại", "Thêm mới" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
         <?=$form->hidden("action", "action", "execute", "");?>
         <?
         $form->close_table();
         $form->close_form();
         unset($form);
         ?>

      </p>
   </body>

</html>
