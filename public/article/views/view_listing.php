<div class="row title">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<?php
				$cat_id = $_GET['cat_id'];
				$db = new db_query("SELECT * FROM categories WHERE cat_id = ".$cat_id);
				$row2 = mysql_fetch_assoc($db->result);
				$parent = $row2['cat_parent_id'];
				$id = $row2['cat_id'];
				$Menu = new menu();
				$result = $Menu->getAllParent('categories','cat_id','cat_parent_id',$id);
				$count = count($result);
				for($i = $count; $i>0 ; $i--){
					$submenu = new db_query("SELECT * FROM categories WHERE cat_id = ".$result[$i]);
					$row = mysql_fetch_assoc($submenu->result);
					$ncat = $article->removeTitle($row['cat_name']);
					echo "<li><a href='http://".$_SERVER['HTTP_HOST']."/c".$row['cat_id'].'-'.$ncat."/'>".$row['cat_name']."</a></li>";
				}
			?>	
		</ul>
	</div>
</div>

<!--Đường dẫn từ danh mục cha đến danh mục đang lựa chọn (breadcrumb) -->

<?php 
		foreach ($post as $item):
		$string = $article->removeTitle($item['pos_title']);
		$num_cmt = new db_count("SELECT count(*) as count FROM comments WHERE cmt_active = 1 AND cmt_pos_id = ".$item['pos_id'] );
		$pos_id = $item['pos_id'];
		$sql2 = "SELECT posts.*, members.mem_id, members.mem_name, categories.cat_id,categories.cat_name FROM posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND pos_id = ".$pos_id;
		$detail = new db_query($sql2);
		$row = mysql_fetch_assoc($detail->result);
?>

<div class="row list-post">
	<div class="col-md-12 cat-name">
		<a href="#"></a>
	</div>
	<div class="col-md-12 post-name">
		<?
			if($item['pos_cat_id'] == 9){
				echo '<i class="fa fa-youtube-play fa-2x" style="color:red; display: inline-block; margin-right: 7px;"></i>';
			}
		?>
		<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$item['pos_id'].'-'.$string?>.html"><?=$item['pos_title']?></a>
		<?
			if($item['pos_att_file'] != ""){
				echo '<i class="fa fa-paperclip fa-lg" style="color:blue; display: inline-block; margin-left: 7px;" title="File đính kèm"></i>';
			}
		?>
	</div>
	<div class="col-md-12 post-info">
		<ul style="list-style: none;">
			<li><span><i class="fa fa-user fa-lg xanh"></i></span><span><a href="<?=$url_author.$item['pos_mem_id']?>/"><?=$row['mem_name']?></a></span></li>
			<li><span><i class="fa fa-clock-o fa-lg xanh"></i></span><span><? echo timeAgoInWords(converTime($item['pos_time'], "H:i "))?></span></li>
			<li><span><i class="fa fa-comment-o pull-left fa-lg xanh"></i></span><span><?=$num_cmt->total?> bình luận</span></li>
		</ul>
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$item['pos_id'].'-'.$string?>.html"><img alt= "<?=str_replace(' ','-',removeAccent($item['pos_title']))?>" width="100%" height="130px" src="http://<?=$_SERVER['HTTP_HOST']?>/uploads/images/posts/<? echo date('Y/m/d/',$item['pos_time']).$item['pos_img'] ?>"></a>
			</div>
			<div class="col-md-9 post-detail">
				<p>
					<?php 
						$str = $article->removeTag($item['pos_content']);
						echo $article->subText($str,300);
					?>
				</p>
				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$item['pos_id'].'-'.$string?>.html">Xem Thêm...</a>
			</div>
			<div class="frame_tags">
				<?
					$arr_tag = new db_query("SELECT article_tag_cloud .*, tags.tag_name FROM  article_tag_cloud JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id WHERE atc_pos_id = ".$item['pos_id']);
					while($lst_tag = mysql_fetch_assoc($arr_tag->result)){
				?>
					<a class="tag_block Cambria" href="http://<?=$_SERVER['HTTP_HOST']?>/tag-<?=str_replace(' ','-',removeAccent($lst_tag['tag_name']));?>" style="margin-left: 10px;"><? echo "# ".$lst_tag['tag_name']?></a>
				<?		
					}
				?>
			</div>
		</div>
	</div>
</div>

<!-- ***** -->

<?php 
	endforeach;
	
	if($lcount > 6){

?>

		<div id="lresult"></div>
		<div class="row page">
			<div class ="col-md-12">
				<input type="button" value="xem thêm, còn nhiều lắm..." id="lnext" data-lpage="<? echo isset($_GET['lpage'])? $_GET['lpage']: 1 ?>" data-catid="<?=$cat_id?>" data-server="<?=$_SERVER['HTTP_HOST']?>" data-name="<?=$ncat?>" data-tlpage="<?=$t_lpage?>">
			</div>
		</div>

		
<?
	}
?>
<!-- phân trang -->