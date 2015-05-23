<?
require_once("inc_security.php");
$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
// if(checkAccessAddEdit($idAdmin,$module_id,'view')){
//    redirect($fs_denypath);
// }

$list = new fsDataGird("mem_id", "mem_login", translate_text("Listing"));
$list->add("mem_login","Tên đăng nhập","string", 0, 1, ' width="150"');
$list->add("mem_name","Tên hiển thị","string", 0, 1, ' width="150"');
$list->add("","Tổng số bài viết","int", 0, 0);
$list->add("","Chưa kích hoạt","int", 0, 0);
$list->add("","Đã kích hoạt","int", 0, 0);
// $list->add("",translate_text("Edit"),"edit");
// if(!checkAccessAddEdit($idAdmin,$module_id,'delete')) {
//    $list->add("", translate_text("Delete"), "delete");
// }
$total			= new db_count("SELECT 	count(*) AS count
											 FROM 	members
											 WHERE 	1 " . $list->sqlSearch());
$arr_listing = array();
$db_listing 	= new db_query("SELECT *
									 FROM members
									 WHERE 1 " . $list->sqlSearch() . "
									 ORDER BY " . $list->sqlSort() . " mem_id " ." DESC
									 " . $list->limit($total->total));
while($row = mysql_fetch_assoc($db_listing->result)){
   $arr_listing[$row['mem_id']] = $row;
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
   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <div id="listing">
         <?=$list->showHeader($total_rows)?>
         <?
         $i = 0;
         foreach($arr_listing as $key => $row){
         $i++;
         ?>
            <?=$list->start_tr($i, 'mem_id')?>
            <td align="center">
               <label><a href="../../../author-<?=$row['mem_id']?>/" target="blank"><?=$row['mem_login']?></a></label>
            </td>
            <td align="center">
               <label><a href="../../../author-<?=$row['mem_id']?>/" target="blank"><?=$row['mem_name']?></a></label>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: red;">
               <?
                $slq_count_record = "SELECT count(*) as count FROM members JOIN posts ON members.mem_id = posts.pos_mem_id WHERE pos_mem_id = ".$row['mem_id'];
            	$get_num_pos = new db_count($slq_count_record);
               	echo $get_num_pos->total;
               ?>
               </label>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: gray;">
               <?
            	$get_num_cmt = new db_count($slq_count_record. " AND pos_active = 0 ");
               	echo $get_num_cmt->total;
               	unset($get_num_cmt);
               ?>
               </label>
            </td>
            <td align="center">
               <label style="font-size: 15px; color: blue;">
               <?
            	$get_num_cmt = new db_count($slq_count_record. " AND pos_active = 1 ");
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