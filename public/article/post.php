<?

   require_once ("../require.php");
   require_once ("../logged.php");
   require("controllers/post.controller.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Blog Mytour </title>
   <?=$load_header?>

    <link href="admin/resource/css/jquery.tagsinput.min.css" rel="stylesheet" type="text/css">
    <link href="admin/resource/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
    <link href="admin/resource/css/selectize.default.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="admin/resource/js/tinymce/tinymce.min.js"></script>
    <script language="javascript" src="admin/resource/js/selectize.min.js"></script>
   <script type="text/javascript">  
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
       external_filemanager_path:"admin/resource/js/tinymce/plugins/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: {"filemanager" : "plugins/filemanager/plugin.min.js"}
    }); 

//   $(document).ready(function(){
//      alert(1);
//      $('#pos_cat_tag').tagsInput();
//   });
     
   $(document).ready(function(){
      $('#select-tag').selectize({
         maxItems: 8
      });
      $("#btn_vote").click(function () {
        $('.vote_frame').slideDown();
        $('.vote').addClass("hide");
      });
      $('#add_vop').click(function () {
         $('.p_vop').before('<p>&nbsp;<input type="radio" name="vote_option" class="rdVote_add"><input class="form_control" type="text" title="Thêm vào tùy chọn" id="vop_name_2" name="vop_name[]" value="" style="width:250px; height:25px; float:left;" maxlength="255"><label class="remove_vop"><label></p>');   
         var count_input = $('.vote_frame').find('input[type="text"]').length;
        if(count_input > 4){
          $('#add_vop').addClass("hide");
        }
      });
      $('body').on('click','.remove_vop',function(){
         $(this).parent().remove();
      });
       var warn_on_unload = "Bài viết của bạn chưa hoàn thiện !";
      $('input[type="submit"]').one('click', function() 
      {
              warn_on_unload = "";
      });
      window.onbeforeunload = function() { 
      if(warn_on_unload != ''){
          return warn_on_unload;
      }}  
   });
</script>
<style type="text/css">
  .form_asterisk{
    color: red;
  }
  .form_errorMsg{
    color: red;
    font-size: 12px;
  }
  #tiny_conent img{
    max-width: 740px;
    height: auto;
  }
  .title_content_left label{
    width: 100%;
  }

  .frm_post .btn {
    border-radius: 0px;
  }
  .frm_post span{
    color: black;
    font-weight: normal;
  }
</style>
</head>

<body>
   <div id="header">
   <?php
      include '../views/view_header.php';
   ?>
   </div>

   <!-- end header -->

   <div id="main">
      <div class = "container">
         <div class = "row">
            <div class = "col-md-8">
            <div class="title_content_left">
              <label>đăng bài viết<span class="under_title"></span></label>

            </div>
            <?
               $form = new form();
            ?>
            <p><?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?></p>
            <?=$form->errorMsg($fs_errorMsg)?>
            <p></p>
            <form action="" method="POST" class="frm_post" enctype="multipart/form-data">
               <p>
               <label class="tit_left">Thể loại </label><font class="form_asterisk">* <span>:</span></font>
               <select name="cbbCategory" style="width:170px;height: 32px;margin-left: 10px; border: solid 1px #d0d0d0;">
                  <option value="0">-- Chọn loại bài viết --</option>
               <?
                     $menu = Menu(0);
                     foreach($menu as $k => $lst_cat)
                     {
                  ?>
                    <option value="<?=$lst_cat['cat_id']?>" <? if($theloai == $lst_cat['cat_id']){ echo "selected='selected'";}?> ><?=$lst_cat['cat_name']?></option>
                  <?      
                     }
                  ?>
               </select>
               </p>
               <p>
                  <label class="tit_left">Tiêu đề </label>
                  <?=$form->text("", "pos_title", "pos_title", $tieude, "Tiêu đề của bài viết", 1, 550, '32px'.';margin-left:15px; box-shadow: 0px 10px 15px #F5F8FF inset; border: solid 1px #d0d0d0;', 255,"")?>
               </p>
               <p>
                  <?=$form->getFile("<label style='padding-right: 3px;'>Ảnh minh họa </label><font class='form_asterisk'> * </font>","upload_img","load_anh",'',0,'',"style=' height:25px;'")?>
                  <? $upanh?>
               </p>
               <p>
                  <label class="w_100">Nội dung bài viết</label>
               </p>
               <p>
                  <textarea name="txt_content" id="tiny_conent"><?=$noidung?></textarea>
               </p>
               <p>
                  <label class="tit_left">Tag bài viết</label><font class="form_asterisk">* <span>:</span></font>
                  <?
                     $list_tags = new db_query("SELECT * FROM tags");
                  ?>
                  <select id="select-tag" name="pos_cat_tag[]" multiple class="pos_cat_tag" style="width:50%" placeholder="Chọn tags">
                     <option value="">Chọn tag</option>
                     <?
                        foreach($list_tags->resultArray() as $value) {
                     ?>
                           <option value="<?=$value['tag_id']?>"><?=$value['tag_name']?></option>
                        <?
                        }
                     ?>
                  </select>
                  <span class="w_100">Bạn có thể sử dụng 8 tag cho bài viết này!</span>
               </p>
               <p>
                  <?=$form->getFile("<label>File đính kèm</label>","upload_file","load_file",'',0,'')?>
                  <span class="w_100">Các định dạng có thể đính kèm doc,docx,pdf,xls,xlsx</span>
                  <? $upfile?>
               </p>
                <!-- vote -->
                <div class="vote">    
                    <input class="btn btn-primary btnvote" type="button" name="btn_vote" id="btn_vote" value="Thêm thảo luận">
                </div>  
                <div class="vote_frame">
                    <label>Thảo luận</label>
                    <p>
                        <input type="radio" name="vote_option" class="rdVote_add">
                        <?=$form->text("", "vop_name_1", "vop_name[]", '', "Thêm vào tùy chọn", 0, 250, "25px;"."float:left;", 255)?>
                        <label class="remove_vop"><label>
                    </p>
                    <p>
                        <input type="radio" name="vote_option" class="rdVote_add">
                        <?=$form->text("", "vop_name_2", "vop_name[]", '', "Thêm vào tùy chọn", 0, 250, "25px;"."float:left;", 255)?>
                        <label class="remove_vop"><label>
                    </p>
                    <p>
                        <input type="radio" name="vote_option" class="rdVote_add">
                        <?=$form->text("", "vop_name_3", "vop_name[]", '', "Thêm vào tùy chọn", 0, 250, "25px;"."float:left;", 255)?>
                        <label class="remove_vop"><label>
                    </p>
                    <p class="p_vop">               
                        <input class="btn btn-success btnvote" type="button" name="add_vop" id="add_vop" value="Thêm tùy chọn">                    
                    </p>
                </div> 
               <p>
                  <input class="btn btn-primary" type="submit" id="submit" name="new_post" value="Đăng bài">
                  <input class="btn btn-primary" type="reset" name="reset" value="Nhập lại">
               </p>
            </form>
            </div>
            <div class = "col-md-4">
            <?php
               include '../views/view_sidebar.php';
            ?>
            </div>   
         </div><!--end of col-md-8-->
      </div>
   </div>

   <!-- end main -->

   <div id="footer">
   <?
      include '../views/view_footer.php';
   ?> 
   </div>

   <!-- end footer -->

   <?=$load_footer?>
   <!-- add script -->

   <script>
       $(":file").filestyle({buttonBefore: true});
   </script>
</body>

</html>