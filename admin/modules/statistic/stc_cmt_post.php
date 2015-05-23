<?
require_once("inc_security.php");
require_once("../../../public/controllers/article.controller.php");
$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
// if(checkAccessAddEdit($idAdmin,$module_id,'view')){
//    redirect($fs_denypath);
// }

$list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
$list->add("pos_title","Tiêu đề","string", 0, 1, ' width="150"');
$list->add("","Tổng số bình luận","int", 0, 0);
$list->add("","Chưa kích hoạt","int", 0, 0);
$list->add("","Đã kích hoạt","int", 0, 0);
// $list->add("",translate_text("Edit"),"edit");
// if(!checkAccessAddEdit($idAdmin,$module_id,'delete')) {
//    $list->add("", translate_text("Delete"), "delete");
// }
$total			= new db_count("SELECT 	count(*) AS count
											 FROM 	posts
											 WHERE 	1 " . $list->sqlSearch());
$arr_listing = array();
$db_listing 	= new db_query("SELECT *
									 FROM posts
									 WHERE 1 " . $list->sqlSearch() . "
									 ORDER BY " . $list->sqlSort() . " pos_id " ." DESC
									 " . $list->limit($total->total));
while($row = mysql_fetch_assoc($db_listing->result)){
   $arr_listing[$row['pos_id']] = $row;
}

$total_rows = mysql_num_rows($db_listing->result);
unset($db_listing);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <?=$load_header?>
      <?=$list->headerScript()?>
      <script language="javascript" src="../../resource/js/swfObject.js"></script>
      <style type="text/css">
         .not_active{
            background-color: #e9f7fe!important;
         }
      </style>
   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <div id="listing">
         <?=$list->showHeader($total_rows)?>
         <?
         $article = new Article();
         $i = 0;
         foreach($arr_listing as $key => $row){
         $i++;
         if($row['pos_active'] == 0){ 
            $active_row =  "class='not_active'";
         }else{
            $active_row = "";
         }
         ?>
            <?=$list->start_tr($i, 'pos_id')?>
            <td align="center" <?=$active_row?>>
               <?
                  if($row['pos_cat_id'] == 9){
                     echo '<i class="fa fa-youtube-play" style="color:red; display: inline-block;"></i>';
                  }
               ?>
               <a target="blank" href="../../../<?='p'.$row['pos_id'].'-'.$article->removeTitle($row['pos_title'])?>.html" class="content_pos"><?=$row['pos_title']?></a>
               <?
                  if($row['pos_att_file'] != ""){
                     echo '<i class="fa fa-paperclip" style="color:blue; display: inline-block;" title="File đính kèm"></i>';
                  }
               ?>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: red;">
               <?
                $slq_count_record = "SELECT count(*) as count FROM comments JOIN posts ON comments.cmt_pos_id = posts.pos_id WHERE cmt_pos_id = ".$row['pos_id'];
            	$get_num_pos = new db_count($slq_count_record);
               	echo $get_num_pos->total;
               ?>
               </label>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: gray;">
               <?
            	$get_num_cmt = new db_count($slq_count_record. " AND cmt_active = 0 ");
               	echo $get_num_cmt->total;
               	unset($get_num_cmt);
               ?>
               </label>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: blue;">
               <?
            	$get_num_cmt = new db_count($slq_count_record. " AND cmt_active = 1 ");
               	echo $get_num_cmt->total;
               ?>
               </label>
            </td>
            <?=$list->end_tr()?>
         <?
         }//END FOREACH
         ?>
         <?=$list->showFooter($total_rows)?>
      </div>
   </body>
</html>