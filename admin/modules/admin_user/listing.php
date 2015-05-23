<?
	//die("asdasdasdasdasd");
	require_once("inc_security.php");

	$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
	if(checkAccessAddEdit($idAdmin,$module_id,'view')){
	   redirect($fs_denypath);
	}

	$list = new fsDataGird($id_field, $name_field, translate_text("Listing"));
	$list->add("adm_loginname","Tên đăng nhập","string", 0, 1);
	$list->add("adm_email","Email","string", 0, 0);
	$list->add("adm_address","Địa chỉ","string", 0, 0);
	$list->add("adm_phone", "Số ĐT", "int", 0, 0);
	$list->add("adm_active","Active","int", 0, 0);
	$list->add("adm_delete","Xóa","int", 0, 0);
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
		$arr_listing[$row['adm_id']] = $row;
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
		width: 150px;
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
		<?=$list->start_tr($i, "adm_id")?>
		<td align="center">
			<label><?=$row['adm_loginname']?></label>
		</td>
		<td align="center">
			<label><?=$row['adm_email']?></label>
		</td>
		<td align="center">
			<label><?=$row['adm_address']?></label>
		</td>
		<td align="center">
			<label><?=$row['adm_phone']?></label>
		</td>
		<?=$list->showCheckbox("adm_active",$row['adm_active'],$row['adm_id'])?>
		<?=$list->showCheckbox("adm_delete",$row['adm_delete'],$row['adm_id'])?>
		<?=$list->showEdit($row['adm_id'])?>
		<?=$list->end_tr()?>
	<?
		}//END FOREACH	
	?>

	<?=$list->showFooter($total_rows)?>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
