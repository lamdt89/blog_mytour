<?
require_once("inc_security.php");

$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'add')){
   redirect($fs_denypath);
}

//check quyền them sua xoa
checkAddEdit("add");
$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
$myform 	= 	new generate_form();
$submitform 	= 	getValue("submit", "str", "POST","");
if($submitform == "Thêm mới"){
   if(getValue("adm_password","str","POST") != getValue("adm_password_confirm","str","POST")){
      $password_field = "";
      $fs_errorMsg .= "Mật khẩu không trùng khớp !";
   }else{
      $password_field = getValue("adm_password","str","POST");
   }
   $myform->add("adm_loginname", "adm_loginname", 0, 0, 0, 1, "Bạn chưa điền tên đăng nhập ",1,"Tên đăng nhập đã tồn tại");
   $myform->add("adm_password", md5($password_field), 0, 1, md5($password_field));
   $myform->add("adm_name", "adm_name", 0, 0, 0, 1, "Bạn chưa điền tên hiển thị");
   $myform->add("adm_email", "adm_email", 2, 0, 0, 1, "Bạn chưa điền email");
   $myform->add("adm_phone", "adm_phone", 0, 0, "");
   $myform->add("adm_active", "", 1, 1, 0);
   $myform->add("adm_isadmin", "", 1, 1, 1);
   $myform->addTable($fs_table);

   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();
   //nếu ko có lỗi
   if($fs_errorMsg == ""){
      $db_insert	=	new db_execute($myform->generate_insert_SQL());
      unset($db_insert);

      $db_admin = new db_query("
         SELECT adm_id
         FROM admin_user
         WHERE adm_loginname='". getValue('adm_loginname','str','POST') ."'
      ");
      while($row = mysql_fetch_assoc($db_admin->result)){
         $adm_id = $row['adm_id'];
      }

      //Lưu phân quyền
      $adu_query = 'INSERT INTO admin_user_right(adu_admin_id, adu_admin_module_id, adu_add, adu_edit, adu_delete, adu_view) VALUES';
      $db_getallmodule = new db_query("SELECT * FROM modules ORDER BY mod_order DESC");
      while ($mod = mysql_fetch_array($db_getallmodule->result)){
         if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")===true){
            $adu_add    = isset($_POST['permission'][$mod['mod_id']]['adu_add']) ? $_POST['permission'][$mod['mod_id']]['adu_add'] : 0;
            $adu_edit   = isset($_POST['permission'][$mod['mod_id']]['adu_edit']) ? $_POST['permission'][$mod['mod_id']]['adu_edit'] : 0;
            $adu_delete = isset($_POST['permission'][$mod['mod_id']]['adu_delete']) ? $_POST['permission'][$mod['mod_id']]['adu_delete'] : 0;
            $adu_view = isset($_POST['permission'][$mod['mod_id']]['adu_view']) ? $_POST['permission'][$mod['mod_id']]['adu_view'] : 0;
            $adu_query .= "(".$adm_id.",".$mod['mod_id'].",".$adu_add.",".$adu_edit.",".$adu_delete.",".$adu_view."),";
         }
      }

      $adu_query     = substr($adu_query,0,-1);
      $db_insert_adu = new db_execute($adu_query);
      unset($db_insert_adu);
      redirect($returnurl);
   }

}

$form = new form();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      <?=$load_header?>
      <? $myform->checkjavascript();?>
      <?
         $myform->addFormname("add_new");
         $myform->evaluate();
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
         <?=$form->text("Tên đăng nhập", "adm_loginname", "adm_loginname", '', "Tên đăng nhập", 1, 250, 20, 255)?>
         <?=$form->password("Mật khẩu", "adm_password", "adm_password", '', "Mật khẩu", 1, 250, 20, 255)?>
         <?=$form->password("Nhập lại mật khẩu", "adm_password_confirm", "adm_password_confirm", '', "Nhập lại mật khẩu", 1, 250, 20, 255)?>
         <?=$form->text("Tên hiển thị", "adm_name", "adm_name", '', "Tên hiển thị", 1, 250, 20, 255)?>
         <?=$form->text("Địa chỉ email", "adm_email", "adm_email", '', "Địa chỉ email", 1, 250, 20, 255)?>
         <?=$form->text("Địa chỉ", "adm_address", "adm_address", '', "Địa chỉ", 0, 250, 20, 11)?>
         <?=$form->text("Số điện thoại", "adm_phone", "adm_phone", '', "Số điện thoại", 0, 250, 20, 11)?>

         <!--Bảng phân quyền-->
      <table cellpadding="2" cellspacing="0" style="border-collapse:collapse; margin-left: 108px;" border="1" bordercolor="#DDF8CC">
         <tr bgcolor="#E0EAF3" height="30">
            <td class="textBold"><?=translate_text("module")?></td>
            <td class="textBold"><?=translate_text("add")?></td>
            <td class="textBold"><?=translate_text("edit")?></td>
            <td class="textBold"><?=translate_text("delete")?></td>
            <td class="textBold"><?=translate_text("view")?></td>
         </tr>
         <?
         //Select access module
         $acess_module			= "";
         $arrayAddEdit 			= array();
         /*$db_access = new db_query("SELECT *
                                    FROM admin_user, admin_user_right, modules
                                    WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_id =" . $record_id);
         while ($row_access = mysql_fetch_array($db_access->result)){
            $acess_module 			.= "[" . $row_access['mod_id'] . "]";
            $arrayAddEdit[$row_access['mod_id']] = array($row_access["adu_add"],$row_access["adu_edit"],$row_access["adu_delete"]);
         }*/

         unset($db_access);
         $db_getallmodule = new db_query("SELECT * FROM modules ORDER BY mod_order DESC");
         while ($mod=mysql_fetch_array($db_getallmodule->result)){
            if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")===true){
               ?>
               <tr>
                  <td class="textBold"><?=translate_text($mod['mod_name']);?></td>
                  <td align="center"><input type="checkbox" name="permission[<?= $mod['mod_id'] ?>][adu_add]" value="1"></td>
                  <td align="center"><input type="checkbox" name="permission[<?= $mod['mod_id'] ?>][adu_edit]" value="1"></td>
                  <td align="center"><input type="checkbox" name="permission[<?= $mod['mod_id'] ?>][adu_delete]" value="1"></td>
                  <td align="center"><input type="checkbox" name="permission[<?= $mod['mod_id'] ?>][adu_view]" value="1"></td>
               </tr>
            <?
            }
         }
         unset($db_getall_channel);
         ?>
      </table>

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