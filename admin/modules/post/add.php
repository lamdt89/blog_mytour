<? 
include "inc_security.php";

checkAddEdit("add");
$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'add')){
   redirect($fs_denypath);
}


$upanh           =   new upload('load_anh',$fs_imagepath_gui.'posts/','gif,jpg,png',3000);

$upfile          =   new upload('load_file',$fs_filepath.'posts/','doc,docx,pdf,xls,xlsx',21616021000);

$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
	$myform 	= 	new generate_form();
	$submitform 	= 	getValue("submit", "str", "POST","");
	$current_time = strtotime(date('h:i A d-m-Y'));
	if($submitform == "Thêm mới"){
		if(!$_FILES['load_anh']['name']){
			$img_name = "";
		}else{
			$img_name = $upanh->file_name;
		}

      if(!$_FILES['load_file']['name']){
         $file_name = "";
      }else{
         $file_name = $upfile->file_name;
      }
		$pos_search     =   removeAccent(getValue("pos_title", "str", "POST"))." . ".removeAccent(getValue("txt_content","str","POST"));		
	 	$myform->add("pos_title", "pos_title", 0, 0, 0, 1, "Bạn chưa điền tiêu đề ");
	 	$myform->add("pos_time", $current_time, 1, 1, $current_time);
	 	$myform->add("pos_cat_id", "cbbCategory", 1, 0, 0, 1, "Bạn chưa chọn loại bài viết");
	 	$myform->add("pos_cat_tag", "pos_cat_tag", 0, 0, "", 1, "Bạn chưa nhập chủ đề liên quan");
	 	$myform->add("pos_content", "txt_content", 0, 0, "", 1, "Bạn chưa nhập nội dung bài viết");
		$myform->add("pos_search", '', 0, 0, removeHTML($pos_search) );
	 	$myform->add("pos_img", $img_name, 0, 0, $img_name);
        $myform->add("pos_att_file", $file_name, 0, 0, $file_name);
	 	$myform->add("pos_active",'', 0, 0, 0 );
	 	$myform->add("pos_adm_id", $idAdmin , 1, 1, $idAdmin );
	 	//$myform->add("pos_att_file", $fil_att, 0, 0, $fil_att);
		$myform->addTable($fs_table);

		$myform->removeHTML(0);	
		$fs_errorMsg	.=	$myform->checkdata();
		//nếu ko có lỗi
		if($fs_errorMsg == ""){
			//echo $myform->generate_insert_SQL();
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
<script>	
	tinymce.init({
	    selector: "#tiny_conent",
	    theme: "modern",
	    width: "750",
	    height: "400",
	    relative_urls : false,
		remove_script_host: false,
	    plugins: [	    	 
	         "advlist autolink code link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager preview sh4tinymce wordcount"
	   ],
	   toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect | insertfile undo redo | sh4tinymce | preview | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",    
	   style_formats_merge: true,
		style_formats: [
		    {title: 'HML Code', block: 'pre', classes: 'brush: xml'},
		    {title: 'CSS Code', block: 'pre', classes: 'brush: css'},
		    {title: 'Javascript Code', block: 'pre', classes: 'brush: js'},
		    {title: 'PHP Code', block: 'pre', classes: 'brush: php'},
		],
	    external_filemanager_path:"../../resource/js/tinymce/plugins/filemanager/",
	    filemanager_title:"Responsive Filemanager" ,
	    external_plugins: { "filemanager" : "plugins/filemanager/plugin.min.js"}
	 }); 

	$(document).ready(function(){
      $('#pos_cat_tag').tagsInput({
         interactive:true,
         defaultText:'Thêm tag',
      });
      //$('#pos_cat_tag').tagsinput();
	});

</script>
<?// $myform->checkjavascript();?>
<?
$myform->addFormname("add_new");
$myform->evaluate();
$fs_errorMsg	.=	$myform->strErrorField;
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Add merchant"))?>
	<div style="margin: 20px 0 0 30px;width:750px;">
		<?
			$form = new form();
		?>
		<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
		<? //Khai bao thong bao loi ?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<form action="" method="POST" class="frm_post" enctype="multipart/form-data">
			<p>
			<font class="form_asterisk">* </font><label>Thể loại :</label>
			<select name="cbbCategory" style="width:150px;height: 24px;margin-left: 5px;">
			<option value="0">-- Chọn loại bài viết --</option>
			<?
				$listCat = new db_query("SELECT cat_id, cat_parent_id, cat_name FROM categories WHERE cat_id NOT LIKE 5 AND cat_parent_id NOT LIKE 5 AND cat_parent_id NOT LIKE 0 OR cat_has_child = 0");
				
				while ($lst_cat = mysql_fetch_assoc($listCat->result)) {
			?>
				<option value="<?=$lst_cat['cat_id']?>"><?=$lst_cat['cat_name']?></option>
			<?
				}
			?>   
			</select>
			</p>
			<p>
				<font class="form_asterisk">* </font><label>Tiêu đề :</label>
				<?=$form->text("", "pos_title", "pos_title", '', "Tiêu đề của bài viết", 0, 250, 25, 255)?>
			</p>
			<p>
				<?=$form->getFile("<font class='form_asterisk'>* </font><label>Ảnh minh họa :</label>","upload_img","load_anh",'',0,'',"style='width:500px; margin-left: -5px;height:25px;'")?>	    					
				<? $upanh?>
			</p>
         <p>
            <?=$form->getFile("<font class='form_asterisk'>* </font><label>File đính kèm :</label>","upload_file","load_file",'',0,'',"style='width:500px; margin-left: -5px;height:25px;'")?>
            <? $upfile?>
         </p>
			<p>
				<font class="form_asterisk">* </font><label class="w_100">Nội dung bài viết</label>
			</p>
			<p>
				<textarea name="txt_content" id="tiny_conent"></textarea>
			</p>
			<p>
				<font class="form_asterisk">* </font><label>Tags :</label>
				<?=$form->text("", "pos_cat_tag", "pos_cat_tag", '', "Đường dẫn website", 0, 250, 25, 255)?>
				<span class="w_100">Bạn có thể sử dụng 2 tag cho bài viết này!</span>
			</p>
			<!-- <p>	    					
				<?// $form = new form(); ?>
				<?//=$form->getFile("<font class='form_asterisk'>* </font><label>File đính kèm :</label>","upload_file","load_file",'',0,'',"style='width:500px; margin-left: -5px;height:25px;'")?>	    					
				<?// $upfile?>
			</p> -->
			<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Thêm mới" . $form->ec . "Làm lại", "Thêm mới" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
			<?=$form->hidden("action", "action", "execute", "");?>
		</form>
	 </div>
<?=template_bottom() ?>
<iframe id="my_iframe" name="my_iframe" src="about:blank"  style="visibility:hidden; width: 1000px;height: 400px;"></iframe>
</body>
</html>