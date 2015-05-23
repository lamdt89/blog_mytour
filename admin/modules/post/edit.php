<? 
 /*echo json_encode($_SERVER);
 die();*/
include "inc_security.php";
//require_once("../wysiwyg_editor/fckeditor.php");

$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'edit')){
   redirect($fs_denypath);
}

checkAddEdit("edit");
$record_id		=	getValue("record_id");
$returnurl		=	base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$fs_action		=	"";
$fs_errorMsg	=	"";
$idAdmin 	= isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;

   // Up ảnh
   if( ($pos_time = getValue('pos_time','int','POST')) != 0){
      $dir_img = $fs_imagepath_gui.'posts/'.date('Y/m/d/',$pos_time);
      if(!file_exists($dir_img)){
         mkdir($dir_img,0777,true);
      }
      $upanh   = new upload('load_anh',$dir_img,'gif,jpg,png',3000);
   }

   // Up file
    if( ($pos_time = getValue('pos_time','int','POST')) != 0){
       $dir_file = $fs_filepath.'posts/'.date('Y/m/d/',$pos_time);
       if(!file_exists($dir_file)){
          mkdir($dir_file,0777,true);
       }
    	$upfile  = new upload('load_file',$dir_file,'doc,docx,pdf,xls,xlsx',10000000);
    }


	$myform 	= 	new generate_form();
	$submitform 	= 	getValue("submit", "str", "POST","");
	$pos_cat = getValue("cbbCategory","int","POST");
	if($pos_cat == 0){
		$pos_cat = "";
	}else{
		$pos_cat = $myform->add("pos_cat_id", "cbbCategory", 1, 0, 0, 1, "Bạn chưa chọn loại bài viết");
	}
	if($submitform == "Cập nhật"){
		$pos_search = removeAccent(getValue("pos_title", "str", "POST","")).". ".removeAccent(getValue("txt_content","str","POST"));
		// echo $pos_search;
		if(!$_FILES['load_anh']['name']){
			$img_name = "";
		}else{
			$img_name = $myform->add("pos_img", $upanh->file_name, 0, 0, $upanh->file_name);
		}

      if(!$_FILES['load_file']['name']){
         $file_name = "";
      }else{
         $file_name = $myform->add("pos_att_file", $upfile->file_name, 0, 0, $upfile->file_name);
      }

	 	$myform->add("pos_title", "pos_title", 0, 0, 0, 1, "Bạn chưa điền tiêu đề ");
	 	$img_name;
      $file_name;
	 	//$myform->add("pos_cat_tag", "pos_cat_tag", 0, 0, "", 1, "Bạn chưa nhập chủ đề liên quan");
	 	$myform->add("pos_content", "txt_content", 0, 0, "", 1, "Bạn chưa nhập nội dung bài viết");
		$myform->add("pos_search", '', 0, 0, removeHTML($pos_search));
		$myform->addTable($fs_table);

		if(isset($_POST['pos_cat_tag'])){
			$post_id  = $record_id;

			$tag_delete = 'DELETE FROM article_tag_cloud WHERE atc_pos_id = '.$post_id;
			$tag_tag_delete = new db_execute($tag_delete);
			unset($tag_tag_delete);

			$tag_query = 'INSERT INTO article_tag_cloud(atc_pos_id,atc_tag_id) VALUES ';
		foreach($_POST['pos_cat_tag'] as $value){
			$tag_query .= "(". $post_id .",". $value ."),";
		}
		$tag_query = substr($tag_query,0,-1);
		$db_tag_insert = new db_execute($tag_query);
		unset($db_tag_insert);
		}

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
<script type="text/javascript" src="../../resource/js/tinymce/tinymce.min.js"></script>
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
  //$('#pos_cat_tag').tagsInput();

   $('#select-tag').selectize({
      maxItems: 8
   });
});
</script>
<?$myform->addFormname("edit");$myform->checkjavascript();?>
<?

$myform->evaluate();
$fs_errorMsg	.=	$myform->strErrorField;
//lấy bản ghi cần chỉnh sửa
$db_data = new db_query("SELECT ".$field_data." FROM " . $fs_table_join . " WHERE " . $id_field . " = " . $record_id);
if($row = mysql_fetch_assoc($db_data->result)){

	foreach($row as $key=>$value){
		if($key!='lang_id' && $key!='pos_id') $$key = $value;
	}
}
$dir_img = $fs_imagepath_gui.'posts/'.date('Y/m/d/',$row['pos_time']);
if(!file_exists($dir_img)){
	mkdir($dir_img,0777,true);
}
?>
<style type="text/css">
	.frame_info label{
		font-size: 13px!important;
	}
	.frame_info{
		margin: 20px 0 0 30px;
		width:750px;
		font-size: 13px!important;
	}
	.mce-window{
		top: 365px!important;
	}
	.tag_block {
	float: left;
	background: none repeat scroll 0 0 #0089e0;
	border-bottom-right-radius: 4px;
	border-top-right-radius: 4px;
	color: #fff;
	display: inline-block;
	font-size: 9pt!important;
	height: 20px;
	margin:10px 0px 0px 20px;
	padding: 4px 10px 0 12px;
	position: relative;
	text-decoration: none;
	}
	.tag_block:hover {
		color: #fff!important;
		text-decoration: underline!important;
	}
	.before_tag {
		border-color: transparent #0089e0 transparent transparent;
		border-style: solid;
		border-width: 12px 12px 12px 0;
		content: "";
		float: left;
		height: 0;
		left: -12px;
		position: absolute;
		top: 0;
		width: 0;
	}
	.after_tag {
		background: none repeat scroll 0 0 #fff;
		border-radius: 2px;
		box-shadow: -1px -1px 2px #004977;
		content: "";
		float: left;
		height: 4px;
		left: 0;
		position: absolute;
		top: 10px;
		width: 4px;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Add merchant"))?>
	<div class="frame_info">
		<?
			$form = new form();
		?>
		<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
		<? //Khai bao thong bao loi ?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<form action="" method="POST" class="frm_post" enctype="multipart/form-data" name="edit">
			<p>
			<label>Thể loại :</label>
			<select name="cbbCategory" style="width:150px;height: 24px;margin-left: 5px;">
			<?
				$listCat = new db_query("SELECT cat_id, cat_parent_id, cat_name FROM categories WHERE cat_id NOT LIKE 5 AND cat_parent_id NOT LIKE 5 AND cat_parent_id NOT LIKE 0 OR cat_has_child = 0");
				
				while ($lst_cat = mysql_fetch_assoc($listCat->result)) {
			?>
				<option value="<?=$lst_cat['cat_id']?>" <? if($lst_cat['cat_id'] == $row['pos_cat_id']){ echo "selected='selected'"; } ?>><?=$lst_cat['cat_name']?></option>
			<?
				}
			?>   
			</select>
			</p>
			<p>
				<label>Tiêu đề :</label>
				<?=$form->text("", "pos_title", "pos_title", $row['pos_title'], "Tiêu đề của bài viết", 0, 500, 21, 255)?>
			</p>
			<p>
				<img src="<?=$fs_imagepath_gui.'posts/'.date('Y/m/d/',$row['pos_time']).$row['pos_img']?>" width="165px" height="114px">
			</p>
			<p>
				<?=$form->getFile("<label>Ảnh minh họa </label>","upload_img","load_anh",'',0,'',"style='width:500px; margin-left: 0px;height:21px;'")?>	    					
				<? $upanh?>
			</p>
         <p>
            <? if(isset($row['pos_att_file'])){ ?>
               <a href=" <?= $fs_filepath.'posts/'.date('Y/m/d/',$row['pos_time']).$row['pos_att_file'] ?>" style="color: blue"><?= $row['pos_att_file'] ?></a>
            <? } ?>
         </p>
         <p>
            <?= $form->getFile("<label>File Đính kèm </label>","upload_file","load_file",'',0,'',"style='width:500px; margin-left: 0px;height:21px;'") ?>
         </p>
			<p>
				<label class="w_100">Nội dung bài viết (Đăng ngày <?echo date('Y/m/d',$row['pos_time'])?>)</label>
			</p>
			<p>
				<textarea name="txt_content" id="tiny_conent"> <?=$row['pos_content']?></textarea>
			</p>
			<p>
				<label>Tags :</label>
	            <?
	            $list_tags = new db_query("SELECT * FROM tags WHERE tag_active = 1");
	            ?>
	            <select id="select-tag" name="pos_cat_tag[]" multiple class="pos_cat_tag" style="width:50%" placeholder="Chọn tags">
	               <option value="">Chọn tag</option>
	               <?
	               foreach($list_tags->resultArray() as $value) {
	                    ?>
	                     <option value="<?= $value['tag_id'] ?>"><?= $value['tag_name'] ?></option>
	                    <?
	               }
	               ?>
	            </select>
				<span style="width: 100%;float:left;">
	            <?
	            	$get_tag  = new db_query("SELECT * FROM article_tag_cloud JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id WHERE tags.tag_active = 1 AND article_tag_cloud.atc_pos_id = ".$record_id);
	            	while($lst_old_tag = mysql_fetch_assoc($get_tag->result)){
	            ?>
	            	<a class="tag_block" ><span class="before_tag"></span><?=$lst_old_tag['tag_name']?><span class="after_tag"></span></a>
	            <?
	            	}
	            ?>

	            </span>
	            <label>Bạn có thể sử dụng 8 tag cho bài viết này!</label>
			</p>
         <input type="hidden" value="<?= $row['pos_time'] ?>" name="pos_time" />
			<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat" ' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
			<?=$form->hidden("action", "action", "execute", "");?>
		</form>
	</div>
<?=template_bottom() ?>
<iframe id="my_iframe" name="my_iframe" src="about:blank"  style="visibility:hidden; width: 1000px;height: 400px;"></iframe>
</body>
</html>