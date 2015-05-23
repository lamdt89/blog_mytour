<?
include "inc_security.php";

$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'edit')){
   redirect($fs_denypath);
}
checkAddEdit("edit");
$record_id		=	getValue("record_id");
$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
$myform 	= 	new generate_form();
$submitform 	= 	getValue("submit", "str", "POST","");
if($submitform == "Cập nhật"){
   $myform->add("mod_name", "mod_name", 0, 0, 0, 0);
   $myform->add("mod_path", "mod_path", 0, 0, 0, 0);
   $myform->add("mod_listname", "mod_listname", 0, 0, 0, 0);
   $myform->add("mod_listfile", "mod_listfile", 0, 0, 0, 0);
   $myform->addTable($fs_table);
   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();
   if($fs_errorMsg == ""){
      //echo $myform->generate_update_SQL($id_field, $record_id);
      $db_insert	=	new db_execute($myform->generate_update_SQL($id_field, $record_id));
      unset($db_insert);
      redirect($returnurl);
   }
}
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
      //lấy bản ghi cần chỉnh sửa
      $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
      if($row = mysql_fetch_assoc($db_data->result)){

         foreach($row as $key=>$value){
            if($key!='lang_id' && $key!='admin_id') $$key = $value;
         }
      }
      ?>
      <style type="text/css">
         .link_p{
            font-size: 14px;
            color: #0099cc;
            margin-left: 5px;
            text-decoration: underline;
         }
      </style>
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
         <?=$form->text("Tên danh mục", "mod_name", "mod_name", $row['mod_name'], "Tên danh mục", 0, 350,20)?>
         <?=$form->text("Tên thư mục", "mod_path", "mod_path", $row['mod_path'], "Tên thư mục", 0, 350,20)?>
         <?=$form->text("Danh sách mục con", "mod_listname", "mod_listname", $row['mod_listname'], "Danh sách mục con", 0, 350,20)?>
         <?=$form->text("Danh sách file", "mod_listfile", "mod_listfile", $row['mod_listfile'], "Danh sách file", 0, 350,20)?>
         <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
         <?=$form->hidden("action", "action", "execute", "");?>
         <?
         $form->close_table();
         $form->close_form();
         unset($form);
         ?>
      </p>
      <?=template_bottom() ?>
      <iframe id="my_iframe" name="my_iframe" src="about:blank"  style="visibility:hidden; width: 1000px;height: 400px;"></iframe>
   </body>
</html>