<?
	include("inc_security.php");
	//check quyền them sua xoa
	checkAddEdit("delete");
	$returnurl 		= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
	$record_id		= getValue("record_id","str","POST","0");
	$arr_record 	= explode(",", $record_id);
	$total 			= 0;
	foreach($arr_record as $i=>$record_id){
		$record_id = intval($record_id);
        //$del    = new db_execute("DELETE FROM links WHERE lin_law_id IN(" . $record_id . ")");
		$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE " . $id_field . " IN(" . $record_id . ")");
		if($db_del->total>0){
			$total +=  $db_del->total;			
		}
		unset($db_del);
	}
	echo "Có " . $total . " bản ghi đã được xóa !";
?>