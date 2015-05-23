<? 
include "inc_security.php";

$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'edit')){
   redirect($fs_denypath);
}

//require_once("../wysiwyg_editor/fckeditor.php");
checkAddEdit("add");
$record_id		=	getValue("record_id");
$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
	$upanh = new upload('load_image',$fs_imagepath_gui.'users/','gif,jpg,png',3000);
	$myform 	= 	new generate_form();
	$submitform 	= 	getValue("submit", "str", "POST","");
	if($submitform == "Cập nhật"){
		if(!$_FILES['load_image']['name']){
			$img_name = "";
		}else{
			$img_name = $myform->add("mem_avatar", $upanh->file_name, 0, 0, $upanh->file_name);
		}
		$myform->add("mem_login", "mem_login", 0, 0, 0, 0,"");
	 	$myform->add("mem_name", "mem_name", 0, 0, 0, 0);
	 	$myform->add("mem_email", "mem_email", 2, 0, 0, 0);
	 	$myform->add("mem_phone", "mem_phone", 0, 0, 0, 0);
	 	$myform->add("mem_dep_id", "cbbDepartment", 0, 0, getValue("cbbDepartment","int","POST"));
	 	$img_name;
		$myform->addTable($fs_table);

		$myform->removeHTML(0);	
		$fs_errorMsg	.=	$myform->checkdata();
		//nếu ko có lỗi
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
		<? //Khai bao thong bao loi ?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<?=$form->text("Tên đăng nhập", "mem_login", "mem_login", $row['mem_login'], "Tên đăng nhập", 0, 272, 20,'','',"")?>  
		<?=$form->text("Tên hiển thị", "mem_name", "mem_name", $row['mem_name'], "Tên hiển thị", 0, 272,20)?> 
		<?=$form->text("Số điện thoại", "mem_phone", "mem_phone", $row['mem_phone'], "Số điện thoại", 0, 272,20,11)?> 
		<?=$form->text("Địa chỉ email", "mem_email", "mem_email", $row['mem_email'], "Địa chỉ email", 0, 272, 20, 255)?>  
		<tr>
			<td><label style="float:right;">Phòng ban :</label></td>
			<td>
				<select name="cbbDepartment" style="width:150px;height: 24px;margin-left: 5px;font-size: 13px;">
					<?
						$list_department = new db_query("SELECT * FROM categories WHERE cat_parent_id = 5");
						while($lst = mysql_fetch_assoc($list_department->result)){
					?>
						<option value="<?=$lst['cat_id']?>" <? if($lst['cat_id'] == $row['mem_dep_id']){ echo "selected='selected'"; } ?>><?=$lst['cat_name']?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<img src="<? echo $fs_imagepath_gui.'users/'.$row['mem_avatar']?>" width="200" height="140" style="margin-left: 105px; padding:1px;border:solid 1px gray;">
		<?=$form->getFile("Hình ảnh","upload_img","load_image")?>
		<? $upanh?>
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