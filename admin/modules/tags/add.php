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

$submitform 	= 	getValue("submit", "str", "POST","");
if($submitform == "Thêm mới"){
//   echo (getValue('tag_name','str','POST'));die;
   $myform->add("tag_name", "tag_name", 0, 0, 0, 1, "Bạn chưa điền tên hiển thị",1,"Tag này đã tồn tại vui lòng chọn tên tag khác !");
   $myform->add("tag_active", "tag_active", 1, 0, 1);
   $myform->addTable($fs_table);
   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();

   if($fs_errorMsg == ""){
      //echo 	$myform->generate_insert_SQL();
      $db_insert	=	new db_execute($myform->generate_insert_SQL());
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
         <?=$form->text("Tên Tag", "tag_name", "tag_name", '', "Tên Tag", 1, 250, 20, 255)?>
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