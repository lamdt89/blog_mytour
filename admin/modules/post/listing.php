<?
	require_once("inc_security.php");	
	require_once("../../../public/controllers/article.controller.php");
	$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
	if(checkAccessAddEdit($idAdmin,$module_id,'view')){
	   redirect($fs_denypath);
	}

	//require_once("../../../core/classes/generate_quicksearch.php");
	$list = new fsDataGird($id_field, $name_field, translate_text("Listing"));

	$list->add("pos_title","Tiêu đề","string", 0, 1);
	//$list->add("pos_content","Nội dung","string", 0, 0, ' width="150"');
	$list->add("pos_time", "Thời gian tạo", "string", 0, 0);
	$list->add("pos_cat_tag","Tags","string", 0, 0, ' width="150"');
	$list->add("mem_name","Người đăng","string", 0, 0, ' width="150"');
	$list->add("pos_active","Active","int", 0, 0, ' width="150"');
	$list->add("",translate_text("Edit"),"edit");
	if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
		$list->add("",translate_text("Delete"),"delete");
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
	.tag_block {
	float: left;
	background: none repeat scroll 0 0 #0089e0;
	border-bottom-right-radius: 4px;
	border-top-right-radius: 4px;
	color: #fff;
	display: inline-block;
	font-size: 9pt!important;
	height: 20px;
	margin:10px 0px 0px 20px;
	padding: 4px 10px 0 12px;
	position: relative;
	text-decoration: none;
	}
	.tag_block:hover {
		color: #fff!important;
		text-decoration: underline!important;
	}
	.before_tag {
		border-color: transparent #0089e0 transparent transparent;
		border-style: solid;
		border-width: 12px 12px 12px 0;
		content: "";
		float: left;
		height: 0;
		left: -12px;
		position: absolute;
		top: 0;
		width: 0;
	}
	.after_tag {
		background: none repeat scroll 0 0 #fff;
		border-radius: 2px;
		box-shadow: -1px -1px 2px #004977;
		content: "";
		float: left;
		height: 4px;
		left: 0;
		position: absolute;
		top: 10px;
		width: 4px;
	}
	.not_active{
		background-color: #e9f7fe!important;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div id="listing">
	<?=$list->showHeader($total_rows)?>
	<?
		$i = 0;
		$article = new Article();
		
		foreach($arr_listing as $key => $row){
			$i++;
		if($row['pos_active'] == 0){ 
			$active_row =  "class='not_active'";
		}else{
			$active_row = "";
		}
	?>
		<?=$list->start_tr($i, $row['pos_id'])?>
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
		<!-- <td align="center">a
			<label class="content_pos"><?//=$row['pos_content']?></label>
		</td> -->
		<td align="center" <?=$active_row?> >
			<label><? echo date('h:i A',$row['pos_time'])."&nbspngày&nbsp".date('d-m-Y',$row['pos_time'])?></label>
		</td>
		<td align="center" <?=$active_row?> >
				<?
				$arr_tag = new db_query("SELECT article_tag_cloud .*, tags.tag_name FROM  article_tag_cloud JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id WHERE tags.tag_active = 1 AND atc_pos_id = ".$row['pos_id']);
				while($lst_tag = mysql_fetch_assoc($arr_tag->result)){
				?>
				<a class="tag_block" ><span class="before_tag"></span><?=$lst_tag['tag_name']?><span class="after_tag"></span></a>
				<?
				}
				?>
		</td>
		<td align="center" <?=$active_row?> >
			<label>
				<a href="../../../author-<?=$row['mem_id']?>/" target="blank"><?=$row['mem_login']?></a>
			</label>
		</td>
		<?=$list->showCheckbox("pos_active",$row['pos_active'],$row['pos_id'])?>
		<?=$list->showEdit($row['pos_id'])?>

		<?
			if(!checkAccessAddEdit($idAdmin,$module_id,'delete')){
			echo $list->showDelete($row['pos_id']);
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