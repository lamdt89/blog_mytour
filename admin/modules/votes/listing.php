<?
   require_once("inc_security.php");
   
   $idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
   if(checkAccessAddEdit($idAdmin,$module_id,'view')){
      redirect($fs_denypath);
   }

   $list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
   $list->add("vop_name","Tên đánh giá","string", 0, 1);
   $list->add("pos_title","Tên bài viết","string", 0, 1);
   $list->add("","Số vote","int", 0, 0, ' width="150"');
   $list->add("vop_active","Active","int", 0, 0, ' width="150"');
   $list->add("",translate_text("Edit"),"edit");
   if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
      $list->add("",translate_text("Delete"),"delete");
   }

   $list->ajaxedit($fs_table);
   $total			= new db_count("SELECT 	count(*) AS count
											 FROM 	".$fs_join_table."
											 WHERE 	1 " . $list->sqlSearch());

   $arr_listing = array();

   $db_listing 	= new db_query("SELECT *
                               FROM ".$fs_join_table."
                               WHERE 1 " . $list->sqlSearch() . "
                               ORDER BY " . $list->sqlSort() . $id_field ." DESC
                               " . $list->limit($total->total));

   while($row = mysql_fetch_assoc($db_listing->result)){
      $arr_listing[$row['vop_id']] = $row;
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
      .content_pos{
         text-overflow: ellipsis;
         white-space: nowrap;
         overflow: hidden;
         width: 400px;
         padding: 0 5px 0 5px;
         height: 70px;
      }
      .not_active{
         background-color: #e9f7fe!important;
      }
      .num_vot{
         font-size: 20px;
         padding: 10px 15px 10px 15px;
         background-color: #0099cc;
         color: white;
      }
      
   </style>
</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
   <div id="listing">
      <?=$list->showHeader($total_rows)?>
      <?
      
      $i = 0;
      foreach($arr_listing as $key => $row){
         $i++;
   ?>
      <?=$list->start_tr($i, $row['vop_id'])?>
      <td align="center">
         <label><?=$row['vop_name']?></label>
      </td>
      <td align="center" class="content_pos">
         <a target="blank" href="../../../<?='p'.$row['pos_id'].'-'.$article->removeTitle($row['pos_title'])?>.html" class="content_pos"><?=$row['pos_title']?></a>
      </td>
      <td align="center">
         <label class="num_vot">
         <?
            $get_num_vote = new db_count("SELECT count(*) as count FROM votes WHERE vot_vote_option_id = ".$row['vop_id']);
            echo $get_num_vote->total;
         ?>
         </label>
      </td>
      <?=$list->showCheckbox("vop_active",$row['vop_active'],$row['vop_id'])?>
      <?=$list->showEdit($row['vop_id'])?>
      <?
         if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
         echo $list->showDelete($row['vop_id']);
      } ?>
      <?=$list->end_tr()?>
   <?
      }//END FOREACH 
   ?>
   <?=$list->showFooter($total_rows)?>
</body>
</html>

