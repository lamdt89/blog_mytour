<?
   require_once("inc_security.php");
   $idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
   if(checkAccessAddEdit($idAdmin,$module_id,'view')){
      redirect($fs_denypath);
   }

   $list  = new fsDataGird($id_field, $name_field, translate_text("Listing"));
   $list->add('cat_name','Tên Danh Mục','string', '0', '1');
   $list->add('cat_parent_id', 'Tên Danh Mục Cha', '0', '0');
   $list->add('cat_active', 'Active', 'int', 0, 0, ' width="150"');
   $list->add("",translate_text("Edit"),"edit");
   $list->ajaxedit($fs_table);

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
      $arr_listing[$row['cat_id']] = $row;
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

               <?=$list->start_tr($i, $row['cat_id'])?>
               <td align="center">
                  <label><?=$row['cat_name']?></label>
               </td>
               <td align="center">
                  <label>
                     <?
                        if($row['cat_parent_id'] != 0) {
                           $parent_query = new db_query('SELECT cat_name FROM categories WHERE cat_id=' . $row['cat_parent_id']);
                           /*var_dump($parent_query->resultArray());*/
                           $parent = $parent_query->resultArray()[0]['cat_name'];
                        }else{
                           $parent = "";
                        }
                     ?>
                     <?=$parent?>
                  </label>
               </td>
               <?=$list->showCheckbox("cat_active",$row['cat_active'],$row['cat_id'])?>
               <?=$list->showEdit($row['cat_id'])?>
               <?=$list->end_tr()?>
         <?
            }//END FOREACH
         ?>
         <?=$list->showFooter($total_rows)?>
      </div>
   </body>

</html>