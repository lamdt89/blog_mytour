<?
include "inc_security.php";
checkAddEdit("add");

$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'add')){
   redirect($fs_denypath);
}

$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
$myform 	= 	new generate_form();
$name = "";
$path = "";
$listname = "";
$listfile = "";
$submitform 	= 	getValue("submit", "str", "POST","");
if($submitform == "Thêm mới"){
   $myform->add("mod_name", "mod_name", 0, 0, 0, 1, "Bạn chưa điền tên danh mục",1,"Tên danh mục đã tồn tại");
   $myform->add("mod_path", "mod_path", 0, 0, 0, 1, "Bạn chưa điền tên thư mục",1,"Tên thư mục đã tồn tại");
   $myform->add("mod_listname", "mod_listname", 0, 0, 0, 1, "Bạn chưa điền danh sách mục con");
   $myform->add("mod_listfile", "mod_listfile", 0, 0, 0, 1, "Bạn chưa điền danh sách file");
   $myform->addTable($fs_table);
   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();

   if($fs_errorMsg == ""){
      //echo 	$myform->generate_insert_SQL();
      $db_insert	=	new db_execute($myform->generate_insert_SQL());
      unset($db_insert);
      redirect($returnurl);
   }else{
      $name = getValue("mod_name","str","POST");
      $path = getValue("mod_path","str","POST");
      $listname = getValue("mod_listname","str","POST");
      $listfile = getValue("mod_listfile","str","POST");
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
      $myform->addFormname("add_new");
      $myform->evaluate();
      $fs_errorMsg	.=	$myform->strErrorField;
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
         <?=$form->text("Tên danh mục", "mod_name", "mod_name", $name, "Tên danh mục", 1, 350,20)?>
         <?=$form->text("Tên thư mục", "mod_path", "mod_path", $path, "Tên thư mục", 1, 350,20)?>
         <?=$form->text("Danh sách mục con", "mod_listname", "mod_listname", $listname, "Danh sách mục con", 1, 350,20)?>
         <?=$form->text("Danh sách file", "mod_listfile", "mod_listfile", $listfile, "Danh sách file", 1, 350,20)?>
         <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Thêm mới" . $form->ec . "Làm lại", "Thêm mới" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
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