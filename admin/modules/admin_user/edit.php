<? 
include "inc_security.php";
//require_once("../wysiwyg_editor/fckeditor.php");
$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
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

	 	$myform->add("adm_name", "adm_name", 0, 0, 0, 0);
	 	$myform->add("adm_email", "adm_email", 0, 0, 0, 0);
	 	$myform->add("adm_phone", "adm_phone", 0, 0, 0, 0);
	 	$myform->add("adm_address", "adm_address", 0, 0, 0, 0);
		$myform->addTable($fs_table);

		$myform->removeHTML(0);	
		$fs_errorMsg	.=	$myform->checkdata();
		//nếu ko có lỗi
		if($fs_errorMsg == ""){					
			//echo $myform->generate_update_SQL($id_field, $record_id);	
			$db_insert	=	new db_execute($myform->generate_update_SQL($id_field, $record_id));
			unset($db_insert);

         //Lưu quyền đăng nhập
         $db_getallmodule = new db_query("SELECT * FROM modules ORDER BY mod_order DESC");
         while ($mod = mysql_fetch_array($db_getallmodule->result)){
            if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")===true){
               $adu_add    = isset($_POST['permission'][$mod['mod_id']]['adu_add']) ? $_POST['permission'][$mod['mod_id']]['adu_add'] : 0;
               $adu_edit   = isset($_POST['permission'][$mod['mod_id']]['adu_edit']) ? $_POST['permission'][$mod['mod_id']]['adu_edit'] : 0;
               $adu_delete = isset($_POST['permission'][$mod['mod_id']]['adu_delete']) ? $_POST['permission'][$mod['mod_id']]['adu_delete'] : 0;
               $adu_view   = isset($_POST['permission'][$mod['mod_id']]['adu_view']) ? $_POST['permission'][$mod['mod_id']]['adu_view'] : 0;
               //check isset dataa
               $adu_check    = " SELECT * FROM admin_user_right WHERE adu_admin_id=". $record_id ." AND adu_admin_module_id=". $mod['mod_id'];
               $db_check_adu = new db_query($adu_check);
               //update data
               if($db_check_adu->resultArray()){
                  $adu_query     = " UPDATE admin_user_right SET adu_add=".$adu_add.", adu_edit=". $adu_edit .", adu_delete=". $adu_delete .", adu_view=". $adu_view." WHERE adu_admin_id=". $record_id ." AND adu_admin_module_id=". $mod['mod_id'] .";";
                  $db_update_adu = new db_execute($adu_query);
               }else{
                  $adu_query     = " INSERT INTO admin_user_right(adu_admin_id, adu_admin_module_id, adu_add, adu_edit, adu_delete, adu_view) VALUES (". $record_id .",". $mod['mod_id'] .",". $adu_add .",". $adu_edit .",". $adu_delete .",". $adu_view .") ";
                  $db_update_adu = new db_execute($adu_query);
               }
               unset($db_update_adu);
            }
         }
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
	.notedit{
		background-color: white;
		border: none;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Add merchant"))?>
	<p align="center" style="padding-left:10px;">
		<?
			$form = new form();
			$form->create_form("edit",$fs_action,"post","multipart/form-data","onsubmit='validateForm(); return false;'");
			$form->create_table();				
		?>
		
		<? //Khai bao thong bao loi ?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<?=$form->text("Tên đăng nhập", "adm_loginname", "adm_loginname", $row['adm_loginname'], "Tên đăng nhập", 0, 255, '20px; background-color: white;border: none; font-weight:bold;','','',"readonly='true'")?>  
		<?=$form->text("Tên hiển thị", "adm_name", "adm_name", $row['adm_name'], "Tên hiển thị", 0, 255,20)?> 
		<?=$form->text("Email", "adm_email", "adm_email", $row['adm_email'], "Địa chỉ email", 0, 255,20,11)?> 
		<?=$form->text("Số điện thoại", "adm_phone", "adm_phone", $row['adm_phone'], "Số điện thoại", 0, 255,20,11)?> 
		<?=$form->text("Địa chỉ", "adm_address", "adm_address", $row['adm_address'], "Địa chỉ", 0, 255,20,11)?> 
		<?//=$form->checkbox("")?>

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

			unset($db_access);
			// $db_getallmodule = new db_query("SELECT modules.*,admin_user_right.adu_add,admin_user_right.adu_edit,admin_user_right.adu_delete,admin_user_right.adu_view FROM modules LEFT JOIN admin_user_right ON mod_id = adu_admin_module_id WHERE adu_admin_id = ". $record_id ." ORDER BY mod_order DESC");
			// $db_getallmodule = new db_query("SELECT modules.*,admin_user_right.adu_admin_id,admin_user_right.adu_add,admin_user_right.adu_edit,admin_user_right.adu_delete,admin_user_right.adu_view FROM modules LEFT OUTER JOIN admin_user_right ON mod_id = adu_admin_module_id ORDER BY mod_order DESC");
         $db_getallmodule    = new db_query("SELECT * FROM modules ");
         while ($mod = mysql_fetch_array($db_getallmodule->result)){
				if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")===true ){
               $db_user_right = new db_query("SELECT * FROM admin_user_right WHERE adu_admin_id = ". $record_id ." AND adu_admin_module_id = ".$mod['mod_id']);
               $right = $db_user_right->resultArray();
               if(!empty($right)) {
                  $right = $right[0];
                  ?>
                  <tr>
                     <td class="textBold"><?= translate_text($mod['mod_name']); ?></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_add]" <? if ($right['adu_add'] == 1) {
                           echo 'checked';
                        } ?> value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_edit]" <? if ($right['adu_edit'] == 1) {
                           echo 'checked';
                        } ?> value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_delete]" <? if ($right['adu_delete'] == 1) {
                           echo 'checked';
                        } ?> value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_view]" <? if ($right['adu_view'] == 1) {
                           echo 'checked';
                        } ?> value="1"></td>
                  </tr>
               <?
               }else {
                  ?>
                  <tr>
                     <td class="textBold"><?= translate_text($mod['mod_name']); ?></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_add]"
                                               value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_edit]"
                                               value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_delete]"
                                               value="1"></td>
                     <td align="center"><input type="checkbox"
                                               name="permission[<?= $mod['mod_id'] ?>][adu_view]"
                                               value="1"></td>
                  </tr>
               <?
               }
				}
			}
			unset($db_getall_channel);
			?>
		</table>

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