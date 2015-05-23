<?
   require_once("inc_security.php");
   
   $idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
   if(checkAccessAddEdit($idAdmin,$module_id,'view')){
      redirect($fs_denypath);
   }

   $list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
   $list->add("mod_name","Tên danh mục","string", 0, 1);
   $list->add("mod_path","Tên thư mục","string", 0, 0);
   $list->add("mod_listname","Danh sách mục con","string", 0, 0);
   $list->add("mod_listfile","Danh sách file","string", 0, 0);
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
      $arr_listing[$row['mod_id']] = $row;
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
      <?=$list->start_tr($i, $row['mod_id'])?>
      <td align="center">
         <label><?=$row['mod_name']?></label>
      </td>
      <td align="center">
         <label><?=$row['mod_path']?></label>
      </td>
      <td align="center">
         <label><?=$row['mod_listname']?></label>
      </td>
      <td align="center">
         <label><?=$row['mod_listfile']?></label>
      </td>
      <?=$list->showEdit($row['mod_id'])?>
      <?=$list->end_tr()?>
   <?
      }//END FOREACH 
   ?>
   <?=$list->showFooter($total_rows)?>
</body>
</html>

