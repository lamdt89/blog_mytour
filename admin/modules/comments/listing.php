<?
	require_once("inc_security.php");

   $idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
   if(checkAccessAddEdit($idAdmin,$module_id,'view')){
      redirect($fs_denypath);
   }

	//require_once("../../../core/classes/generate_quicksearch.php");
	$list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
	$list->add("mem_name","Tên thành viên","string", 0, 1, ' width="150"');
	$list->add("cmt_content", "Nội dung", "string", 0, 0);
	$list->add("cmt_time", "Vào lúc", "string", 0, 0);
	$list->add("pos_title","Bài viết","string", 0, 1, ' width="150"');
    $list->add("cmt_active","Active","int", 0, 0);
   if(!checkAccessAddEdit($idAdmin,$module_id,'delete')) {
      $list->add("", translate_text("Delete"), "delete");
   }
	$list->ajaxedit($fs_table);

	$total			= new db_count("SELECT 	count(*) AS count 
											 FROM 	".$fs_table_join."
											 WHERE 	1 " . $list->sqlSearch());
	$arr_listing = array();
	$db_listing 	= new db_query("SELECT ".$field_data."
									 FROM ".$fs_table_join."
									 WHERE 1 " . $list->sqlSearch() . "
									 ORDER BY " . $list->sqlSort() . $id_field ." DESC
									 " . $list->limit($total->total));
	while($row = mysql_fetch_assoc($db_listing->result)){
		$arr_listing[$row['cmt_id']] = $row;
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
		font-size: 12px;
		color: #888888;
		float: left;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		width: 380px;
		padding: 0 5px 0 5px;
		height: 70px;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div id="listing">
	<?=$list->showHeader($total_rows)?>
	<?
		$i = 0;
		foreach($arr_listing as $key => $row){
			$i++;
	?>
		<?=$list->start_tr($i, $row["cmt_id"])?>
		<td align="center" style="width:150px;">
			<label><?=$row['mem_name']?></label>
		</td>
		<td align="center" >
			<label class="content_pos"><?=$row['cmt_content']?></label>
		</td>
		<td align="center" style="width:150px;">
			<label><? echo date('h:i A',$row['cmt_time'])."&nbspngày&nbsp".date('d-m-Y',$row['cmt_time'])?></label>
		</td>
		<td align="center" style="width:200px;">
			<label><?=$row['pos_title']?></label>
		</td>

        <?=$list->showCheckbox("cmt_active", $row['cmt_active'], $row['cmt_id'] )?>

         <?
         if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
            echo $list->showDelete($row['cmt_id']);
         } ?>
		<?=$list->end_tr()?>
	<?
		}//END FOREACH	
	?>

	<?=$list->showFooter($total_rows)?>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
