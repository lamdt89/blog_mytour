<? 
include "inc_security.php";
checkAddEdit("add");
$dir_image_member = $fs_imagepath_gui."users/";
if(!file_exists($dir_image_member)){
   mkdir($dir_image_member,0777,true);
}
$idAdmin  = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'add')){
   redirect($fs_denypath);
}

$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
$ten_dn = "";
$ten_ht = "";
$mail = "";
$dt = "";
$pb = "";
	//$upanh = new upload('load_image',$fs_imagepath_gui.'users/','gif,jpg,png',3000);
	$myform 	= 	new generate_form();
	$current_time = strtotime(date('h:i A d-m-Y'));
	$submitform 	= 	getValue("submit", "str", "POST","");
	if($submitform == "Thêm mới"){
		// if(!$_FILES['load_image']['name']){
		// 	$img_name = "";
		// }else{
		// 	$img_name = $upanh->file_name;
		// }	
		// if(!$_FILES['load_image']['name']){
	 //      $fs_errorMsg .= "<span style='float:left;'>&bull; Bạn chưa chọn avatar!</span><br/>";
	 //   }else{
	 //      $img_name = $upanh->file_name;
	 //   }	
		if(getValue("mem_password","str","POST") != getValue("mem_password_confirm","str","POST")){
			$password_field = "";
			$fs_errorMsg .= "&bull; Mật khẩu không trùng khớp !<br/>";
		}else{
			$password_field = getValue("mem_password","str","POST");
		}
		if(getValue("cbbDepartment","str","POST") == 0){
			$fs_errorMsg.= "&bull; Bạn chưa chọn phòng ban <br/>";
		}
	 	$myform->add("mem_login", "mem_login", 0, 0, 0, 1, "Bạn chưa điền tên đăng nhập ",1,"Tên đăng nhập đã tồn tại");
	 	$myform->add("mem_password", md5($password_field), 0, 1, md5($password_field));
	 	$myform->add("mem_name", "mem_name", 0, 0, 0, 1, "Bạn chưa điền tên hiển thị");
	 	$myform->add("mem_email", "mem_email", 2, 0, 0, 1, "Bạn chưa điền email");
	 	$myform->add("mem_phone", "mem_phone", 0, 0, "");	
	 	// $myform->add("mem_avatar", $img_name, 0, 0, $img_name);
	 	$myform->add("mem_join_date", $current_time, 0, 0, $current_time);
		$myform->add("mem_admin", "", 1, 1, 0);
		$myform->add("mem_active", "", 1, 1, 0);

		$myform->add("mem_dep_id", "cbbDepartment", 0, 0, "" );	
		$myform->addTable($fs_table);

		$myform->removeHTML(0);	
		$fs_errorMsg	.=	$myform->checkdata();
		//nếu ko có lỗi
		if($fs_errorMsg == ""){		
			//echo 	$myform->generate_insert_SQL();
			$db_insert	=	new db_execute($myform->generate_insert_SQL());
			unset($db_insert);
			redirect($returnurl);
		}else{
			$ten_dn = getValue("mem_login","str","POST");
			$ten_ht = getValue("mem_name","str","POST");
			$mail = getValue("mem_email","str","POST");
			$dt = getValue("mem_phone","str","POST");
			$pb = getValue("cbbDepartment","str","POST");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
	#getnews{
		width: 98%;
		max-height: 300px;
		overflow: scroll;
		padding: 10px;
		border: 2px solid;
	}
</style>
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
		<? //Khai bao thong bao loi ?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<?=$form->text("Tên đăng nhập", "mem_login", "mem_login", $ten_dn, "Tên đăng nhập", 1, 250, 20, 255)?>
		<?=$form->password("Mật khẩu", "mem_password", "mem_password", '', "Mật khẩu", 1, 250, 20, 255)?>
		<?=$form->password("Nhập lại mật khẩu", "mem_password_confirm", "mem_password_confirm", '', "Nhập lại mật khẩu", 1, 250, 20, 255)?>
		<?=$form->text("Tên hiển thị", "mem_name", "mem_name", $ten_ht, "Tên hiển thị", 1, 250, 20, 255)?>
		<?=$form->text("Địa chỉ email", "mem_email", "mem_email", $mail, "Địa chỉ email", 1, 250, 20, 255)?>
		<?=$form->text("Số điện thoại", "mem_phone", "mem_phone", $dt, "Số điện thoại", 0, 250, 20, 11)?>		
		<tr>
			<td><label style="float:right;"><font class="form_asterisk">* </font> Phòng ban :</label></td>
			<td>
				<select name="cbbDepartment" style="width:150px;height: 24px;margin-left: 5px;font-size: 13px;">
					<option value="0">--Chọn phòng ban--</option>
					<?
						$list_department = new db_query("SELECT * FROM categories WHERE cat_parent_id = 5");
						while($lst = mysql_fetch_assoc($list_department->result)){
					?>
						<option value="<?=$lst['cat_id']?>" <? if($pb == $lst['cat_id']){ echo "selected='selected'";} ?> ><?=$lst['cat_name']?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<?//=$form->getFile("Ảnh đại diện","upload_img","load_image",'',1)?>
		<? //$upanh?>
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