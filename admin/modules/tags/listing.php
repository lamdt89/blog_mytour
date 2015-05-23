<?
require_once("inc_security.php");
$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'view')){
   redirect($fs_denypath);
}

$list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
$list->add("tag_name","Tên Tag","string", 0, 1, ' width="150"');
$list->add("mem_active","Active","int", 0, 0, ' width="150"');
$list->add("",translate_text("Edit"),"edit");
if(!checkAccessAddEdit($idAdmin,$module_id,'delete')) {
   $list->add("", translate_text("Delete"), "delete");
}
$total			= new db_count("SELECT 	count(*) AS count
											 FROM 	".$fs_table."
											 WHERE 	1 " . $list->sqlSearch());
$arr_listing = array();
$db_listing 	= new db_query("SELECT *
									 FROM ".$fs_table."
									 WHERE 1 " . $list->sqlSearch() . "
									 ORDER BY " . $list->sqlSort() . $id_field ." DESC
									 " . $list->limit($total->total));
while($row = mysql_fetch_assoc($db_listing->result)){
   $arr_listing[$row['tag_id']] = $row;
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
            <?=$list->start_tr($i, $row['tag_id'])?>
            <td align="center">
               <label><?=$row['tag_name']?></label>
            </td>
            <?=$list->showCheckbox("tag_active",$row['tag_active'],$row['tag_id'])?>
            <?=$list->showEdit($row['tag_id'])?>
            <?
            if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
               echo $list->showDelete($row['tag_id']);
            } ?>
            <?=$list->end_tr()?>
         <?
         }//END FOREACH
         ?>
         <?=$list->showFooter($total_rows)?>
      </div>
   </body>
</html>