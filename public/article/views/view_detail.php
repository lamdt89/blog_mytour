<div class="row title">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<?
					for($i = $count; $i>0 ; $i--){
						$Cat = new db_query("SELECT * FROM categories WHERE cat_id = ".$result[$i]);
						$row3 = mysql_fetch_assoc($Cat->result);
						$ncat = $article->removeTitle($row3['cat_name']);
						echo "<li><a href='c".$row3['cat_id'].'-'.$ncat."/'>".$row3['cat_name']."</a></li>";
					}
			?>
			<li><?php echo $article->subText($row['pos_title'],50);?></li>	
		</ul>		
	</div>
</div>
<?
	if($row['pos_active'] == 0){
		$error_active = "Bài viết này chưa được kích hoạt ! Vui lòng liên hệ ban quản trị.";
		echo '<label>'.$error_active.'</label>';
	}else{
?>
<!--Đường dẫn từ danh mục cha đến danh mục đang lựa chọn (breadcrumb) -->
<div class="box-detail">
	<div class="row pos_detail">
		<div class="col-md-12 post">
			
			<span><?=$row['pos_title'];?></span>
		</div>
		<div class="col-md-12 info">
			<ul style="list-style: none; padding-left: 0px;">
				<li><span><i class="fa fa-user fa-lg xanh"></i></span><span><a href="<?=$url_author.$row['pos_mem_id']?>/"><?=$row['mem_name']?></a></span></li>
				<li><span><i class="fa fa-clock-o fa-lg xanh"></i></span><span><? echo timeAgoInWords(converTime($row['pos_time'], "H:i "))?></span></li>
				<li><i class="fa fa-comment-o pull-left fa-lg xanh"></i><span><?=$count_id?> bình luận</span></li>
			</ul>
		</div>
		<div class="col-md-12 detail">
			<?=$row['pos_content'];?>
		</div>
		<?
			if(isset($row['pos_att_file'])){
		?>
				<div class="col-md-12" style="padding-bottom: 20px;">
					<p><b>Tệp đính kèm:</b></p></br>
					<div class="att">					
						<a target="_blank" href="file?file=<?=$row['pos_att_file']?>&date=<?=$row['pos_time']?>"><img src="themes/images/<?=$img?>"></a>
                  <a target="_blank" class="btn btn-primary" href="file?file=<?=$row['pos_att_file']?>&date=<?=$row['pos_time']?>"><i class="fa fa-eye"></i> Xem</a>
						<a class="btn btn-primary" href="download?file=<?=$row['pos_att_file']?>&date=<?=$row['pos_time']?>"><i class="fa fa-download"></i> Tải về</a>
					</div>
				</div>
		<?
			}
		?>
		<?php
    		include 'view_vote.php';
    	?>

			
		
		<div class="col-md-12 related border-post">
			<p>Bài viết liên quan</p>
			<ul>
			<?
				$arr_tagofpost = array();
				$result_tag = new db_query("SELECT tags.* FROM  article_tag_cloud JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id WHERE tag_active = 1 AND atc_pos_id = ".$pos_id);
				while($row_tag = mysql_fetch_assoc($result_tag->result)){
					$arr_tagofpost[$row_tag['tag_id']] = $row_tag['tag_name'];
				}
				$dep_mem = isset($_SESSION["ses_dep_id"]) ? intval($_SESSION["ses_dep_id"]) : 0;
				if(isset($_SESSION['ses_mem_id'])){
					$check_log = " AND ( cat_show_menu = 0 OR cat_show_menu = 1 )";
					if($dep_mem == '11'){
						$check_log = "";
					}
				}else{
					$check_log = " AND cat_show_menu = 1 ";
				}
				
				$list_tag_id = implode(",", array_keys($arr_tagofpost));
				$list_post_related = new db_query("SELECT DISTINCT(posts.pos_title),posts.pos_id, categories.cat_show_menu  FROM posts 
										STRAIGHT_JOIN article_tag_cloud ON article_tag_cloud.atc_pos_id = posts.pos_id 
										STRAIGHT_JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id 
										STRAIGHT_JOIN categories ON posts.pos_cat_id = categories.cat_id
										WHERE pos_active = 1 AND tags.tag_id IN (".$list_tag_id.") AND tag_active = 1 AND pos_id NOT LIKE ".$pos_id. $check_log." ORDER BY pos_id DESC LIMIT 5 ");
				if(mysql_num_rows($list_post_related->result) > 0){
					while($list_related = mysql_fetch_assoc($list_post_related->result)){				
					?>
					<li><a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$list_related['pos_id'].'-'.$article->removeTitle($list_related['pos_title'])?>.html"><?=$list_related['pos_title']?></a></li>
				<?
					}
				}else{
					echo "<li><label>Không có bài viết nào liên quan tới bài viết này!</label></li>";
				}
				?>
			</ul>
		</div>
	</div>
</div>

<!-- ***** -->

<?php
    include 'view_comment.php';
	}
?>

<!-- comment -->