<?
include "inc_security.php";

checkAddEdit("add");

$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'edit')){
   redirect($fs_denypath);
}


$record_id		=	getValue("record_id");
$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";

$myform 	= 	new generate_form();
$submitform 	= 	getValue("submit", "str", "POST","");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      <?=$load_header?>
      <? $myform->checkjavascript();?>
      <?
         $myform->addFormname("edit");
         $myform->evaluate();
         $fs_errorMsg	.=	$myform->strErrorField;
         $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
         if($row = mysql_fetch_assoc($db_data->result)){

            foreach($row as $key=>$value){
               if($key!='lang_id' && $key!='admin_id') $$key = $value;
            }
         }

         if($submitform == "Cập nhật"){
            $myform->add('cat_name','cat_name', '0', '0' ,'0', '1', 'Bạn chưa điền tên Danh mục');
            $myform->add('cat_parent_id', 'cat_parent_id', '0', '0', '0', '0');
            $myform->add('cat_show_menu', 'cat_show_menu', '0', '0', '1');

            //Check it
            $it = getValue('cat_show_menu','int','POST');
            switch($it){
               case 2:
                  $myform->add('cat_is_login', '', 1, 0, 1);
                  $myform->add('cat_has_it', '', 1, 0, 1);
                  break;
               case 0:
                  $myform->add('cat_is_login', '', 1, 0, 1);
                  break;
               case 1;
                  $myform->add('cat_is_login', '', 1, 0, 0);
            }

            $myform->addTable($fs_table);

            $myform->removeHTML(0);
            $fs_errorMsg   .= $myform->checkdata();

            if($fs_errorMsg == ""){
               //cập nhật trạng thái có thể loại con của thể loại cha
               $check_cat_IT = new db_query("SELECT * FROM categories WHERE cat_id = ".getValue("cat_parent_id","int","POST"));
               $record_check = mysql_fetch_assoc($check_cat_IT->result);
               if($record_check['cat_has_child'] == 0){
                  $update_has_child = new db_query("UPDATE categories SET cat_has_child= 1 WHERE cat_id = ".getValue("cat_parent_id","int","POST"));
               }
               $get_old_cat = new db_query("SELECT * FROM categories WHERE cat_id = ".$row['cat_parent_id']);
               $record_old = mysql_fetch_assoc($get_old_cat->result);
               $count_child = new db_count("SELECT count(*) as count FROM categories where cat_parent_id = ".$row['cat_id'] );
               if($count_child->total == 0){
                  $update_old_cat = new db_query("UPDATE categories SET cat_has_child= 0 WHERE cat_id = ".$record_old['cat_id']);
               }
               //echo $myform->generate_update_SQL($id_field, $record_id);
               $db_insert  =  new db_execute($myform->generate_update_SQL($id_field, $record_id));
               unset($db_insert);
               redirect($returnurl);
            }
         }
      ?>
   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <?=template_top(translate_text("Add merchant"))?>
      <p align="center" style="padding-left:10px;">
         <?
         $form = new form();
         $form->create_form("add_new",$fs_action,"post","multipart/form-data","onsubmit='validateForm(); return false;'");
         $form->create_table();
         ?>
         <?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>

         <?=$form->errorMsg($fs_errorMsg)?>
         <?=$form->text("Tên Danh mục", "cat_name", "cat_name", $row['cat_name'], "Tên hiển thị", 0, 255,20)?>
         <?
            $db_select = new db_query("SELECT cat_id,cat_name,cat_parent_id FROM categories WHERE cat_parent_id = 0");
            while($row_option = mysql_fetch_assoc($db_select->result)){
               $data[] = $row_option;
            }
         ?>
         <tr>
            <td>Danh mục gốc :</td>
            <td>
            <select name="cat_parent_id" style="width:150px;height: 24px;margin-left: 5px;font-size: 12px;">
                  <option selected="selected">- Chọn danh mục bài viết -</option>
                  <?
                     $menu = Menu(0);
                     foreach($menu as $k => $row1)
                     {
                  ?>
                     <option <?=$row['cat_parent_id'] == $row1['cat_id'] ? 'selected="selected"' : ''?> value="<?=$row1['cat_id']?>"><?=$row1['cat_name']?></option>
                  <?
                     }
                  ?>

             </select>
            </td>
         </tr>
         <tr>
         <td><label style="float:right;">Hiển thị menu :</label></td>
         <td>
            <select name="cat_show_menu" style="width:150px;height: 24px;margin-left: 5px;font-size: 13px;">
              <?php
                  $show_arr = array(0=>'Kiểm tra đăng nhập',1=>'Không cần đăng nhập',2=>'Chỉ có nhân viên IT');
                  foreach ($show_arr as $key => $value) {
              ?>
                  <option <?=$row['cat_show_menu'] == $key ? 'selected="selected"' : ''?> value="<?php echo $key?>"><?php echo $value?></option>
              <?php
                  }
              ?>
            </select>
         </td>
         </tr>
         <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
         <?=$form->hidden("action", "action", "execute", "");?>

         <?
         $form->close_table();
         $form->close_form();
         unset($form);
         ?>

      </p>
   </body>

</html>