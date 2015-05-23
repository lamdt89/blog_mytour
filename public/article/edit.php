<?
   //var_dump(1);die;
   require_once ("../require.php");
   require_once ("../logged.php");
   require("controllers/edit.controller.php");
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

            //$('#pos_cat_tag').tagsinput();
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
      </style>
   </head>

   <body>
      <div id="header">
         <?php
         include '../views/view_header.php';
         ?>
      </div>

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
                        <label>Thể loại <font class="form_asterisk">* </font>:</label>
                        
                        <select name="cbbCategory" style="width:170px;height: 24px;margin-left: 5px;">
                           <option value="0">-- Chọn loại bài viết --</option>
                        <?
                        $check_IT ="";
                        if($_SESSION["ses_dep_id"] == '11'){
                           $check_IT = "";
                        }else{
                           function getAllIt($parent_id = 3, $trees = array(),$check_IT = " AND cat_parent_id NOT LIKE 3 "){
                             //$check_IT = " AND cat_parent_id NOT LIKE 3 ";
                             if(!$trees){
                                 $trees = array();
                             }
                             $db = new db_query("SELECT * FROM categories WHERE cat_parent_id = $parent_id");
                             while($rs = mysql_fetch_assoc($db->result)){
                                 $check_IT .= " AND cat_parent_id NOT LIKE ".$rs['cat_id'];
                                 $trees = getAllIt($rs['cat_id'], $trees,$check_IT);
                             }
                             return $check_IT;
                           }
                           $check_IT = getAllIt();
                        }
                           $listCat = new db_query("SELECT cat_id, cat_parent_id, cat_name FROM categories WHERE cat_id NOT LIKE 5 AND cat_parent_id NOT LIKE 5 AND cat_parent_id NOT LIKE 0 ".$check_IT." AND cat_has_child = 0");                  
                           while ($lst_cat = mysql_fetch_assoc($listCat->result)) {
                        ?>
                           <option value="<?=$lst_cat['cat_id']?>" <? if($lst_cat['cat_id'] == $row['pos_cat_id']){ echo "selected='selected'"; } ?>><?=$lst_cat['cat_name']?></option>
                        <?
                           }
                        ?>   
                        </select>
                     </p>

                     <p>
                        <label>Tiêu đề </label>
                        <?=$form->text("", "pos_title", "pos_title", $row['pos_title'], "Tiêu đề của bài viết", 1, 450, 30, 255)?>
                     </p>

                     <p>
                        <img src="uploads/images/posts/<?= date('Y/m/d/',$row['pos_time']).$row['pos_img'] ?> " width="165px" height="114px">
                     </p>
                     <p>
                        <?=$form->getFile("<label>Ảnh minh họa </label>","upload_img","load_anh",'',0,'',"style='width:500px; margin-left: 0px;height:21px;'")?>
                        <? $upanh?>
                     </p>
                     <p>
                        <? if(isset($row['pos_att_file'])){ ?>
                           <a href="download?file=<?=$row['pos_att_file']?>&date=<?=$row['pos_time']?>" style="color: blue"><?= $row['pos_att_file'] ?></a>
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
                        <?//=$form->text("", "pos_cat_tag", "pos_cat_tag", $row['pos_cat_tag'], "Tags", 0, 250, 21, 255)?>

                        <?
                        $list_tags = new db_query("SELECT * FROM tags WHERE tag_active = 1");
                        /*$tag_current = new db_query("SELECT * FROM article_tag_cloud WHERE atc_pos_id = ".$record_id );
                        var_dump($tag_current->resultArray());*/
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
                                 <a class="tag_block Cambria" ><span class="before_tag"></span><? echo " ".$lst_old_tag['tag_name']?><span class="after_tag"></span></a>
                              <?
                              }
                              ?>

                              </span>
                        <label>Bạn có thể sử dụng 2 tag cho bài viết này!</label>
                     </p>

                     <input type="hidden" value="<?= $row['pos_time'] ?>" name="pos_time" />
                     <p>
                        <input type="submit" name="submit" value="Cập nhật">
                        <input type="reset" name="reset" value="Nhập lại">
                     </p>

                  </form>

               </div>

               <div class = "col-md-4">
                  <?php
                  include '../views/view_sidebar.php';
                  ?>
               </div>

            </div>
         </div>

      <div id="footer">
         <?
         include '../views/view_footer.php';
         ?>
      </div>
      <?=$load_footer?>
   </body>
</html>