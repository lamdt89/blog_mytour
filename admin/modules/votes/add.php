<?
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
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
   $myform->add("vot_name", "vot_name", 0, 0, 0, 1, "Bạn chưa điền tên Thảo luận ",1,"Tên Thảo luận đã tồn tại");
   $myform->add("vot_content", "txt_content", 0, 0, "", 1, "Bạn chưa nhập nội dung bài viết");
   $myform->add("vot_active",'', 1, 0, 0 );
   $myform->addTable($fs_table);
   $myform->removeHTML(0);
   $fs_errorMsg	.=	$myform->checkdata();
   //nếu ko có lỗi
   if($fs_errorMsg == ""){
      //echo $myform->generate_insert_SQL();die;
      $db_insert	=	new db_execute($myform->generate_insert_SQL());
      unset($db_insert);

      $vot_id = new db_query('SELECT vot_id FROM votes WHERE vot_name= "'.getValue('vot_name','str','POST').'"');
      $vot_id = mysql_fetch_assoc($vot_id->result)['vot_id'];
      $vot_option = getValue('vop_name','arr','POST');
      $vop_query = "INSERT INTO vote_option(vop_name,vop_vote_id) VALUES ";
      foreach($vot_option as $value){
         $vop_query .= "('". $value ."',". $vot_id ."),";
      }
      $vop_query = substr($vop_query,0,-1);
      $vop_query = new db_execute($vop_query);
      unset($vop_query);

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

         $(function(){

            $('#add_vop').click(function () {
               $('.p_vop').before('<p><input class="form_control" type="text" title="Thêm vào tùy chọn" id="vop_name_2" name="vop_name[]" value="" style="width:250px; height:25px" maxlength="255"><input type="button" class="remove_vop" value="X" style="width: 18px"></p>');
            });

            $('body').on('click','.remove_vop',function(){
               $(this).parent().remove();
            });

         });

      </script>

   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <?=template_top(translate_text("Add merchant"))?>
      <div style="margin: 20px 0 0 30px;width:750px;">
         <?
         $form = new form();
         ?>
         <?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
         <?=$form->errorMsg($fs_errorMsg)?>
         <form action="" method="POST" class="frm_post" enctype="multipart/form-data">
            <p>
               <font class="form_asterisk">* </font><label>Tên Thảo Luận :</label>
               <?=$form->text("", "vot_name", "vot_name", '', "Tiêu đề của Thảo Luận", 0, 250, 25, 255)?>
            </p>
            <p>
               <font class="form_asterisk">* </font><label class="w_100">Nội dung Thảo Luận</label>
            </p>
            <p>
               <textarea name="txt_content" id="tiny_conent"></textarea>
            </p>
            <p>
               <font class="form_asterisk">* </font><label>Thêm tùy chọn:</label>
            </p>
            <p>
               <?=$form->text("", "vop_name_1", "vop_name[]", '', "Thêm vào tùy chọn", 0, 250, 25, 255)?>
               <input type="button" class="remove_vop" value="X" style="width: 18px">
            </p>
            <p>
               <?=$form->text("", "vop_name_2", "vop_name[]", '', "Thêm vào tùy chọn", 0, 250, 25, 255)?>
               <input type="button" class="remove_vop" value="X" style="width: 18px">
            </p>
            <p class="p_vop">
               <?=$form->button('button','add_vop','add_vop','Thêm','Thêm','style="background:url(' . $fs_imagepath . 'button_4.gif) no-repeat"') ?>
            </p>

            <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Thêm mới" . $form->ec . "Làm lại", "Thêm mới" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
            <?=$form->hidden("action", "action", "execute", "");?>
         </form>
      </div>
      <?=template_bottom() ?>
      <iframe id="my_iframe" name="my_iframe" src="about:blank"  style="visibility:hidden; width: 1000px;height: 400px;"></iframe>
   </body>
</html>