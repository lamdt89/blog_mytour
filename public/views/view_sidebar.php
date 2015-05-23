<?
	$dep_mem = isset($_SESSION["ses_dep_id"]) ? intval($_SESSION["ses_dep_id"]) : 0;
	$check_list = "";
	if(isset($_SESSION['ses_mem_id'])){
		$check_log = " AND pos_active = 1 ";
		
	}else{
		$check_log = " AND ( cat_is_login = 0 ) AND pos_active = 1 ";
	}
	if($dep_mem == '11'){
		$check_list = " OR cat_show_menu = 2 OR cat_show_menu = 0 ";
	}else{
		$check_list = " OR cat_show_menu = 0 ";
	}
?>
<!-- BÀI VIẾT MỚI -->
<div class="col-md-12">
	<div class="sidebar-box">
		<p class="title_box clearfix Cambria">bài viết mới nhất<img src="http://<?=$_SERVER['HTTP_HOST']?>/themes/images/Flame.gif" style="width: 15px;height: 19px;border: none;margin-left: 10px;margin-top: -7px;"></p>

		<?
			$newest = new db_query("SELECT posts.*, members.mem_id, members.mem_name, categories.cat_id,categories.cat_name FROM posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE (cat_show_menu = 1 ".$check_list." ) ".$check_log." ORDER BY pos_id DESC LIMIT 5 ");
			while($lst_new_post = mysql_fetch_assoc($newest->result)){
		?>
		<div class="newest_post">
			<div class="title_content_left" style="border-bottom:none; margin-bottom: 10px;">
				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lst_new_post['pos_id'].'-'.$article->removeTitle($lst_new_post['pos_title'])?>.html" class="tit_newest"><? $str = $article->removeTag($lst_new_post['pos_title']); echo $article->subText($str,45);?></a>
				<div class="img_content_newest">
					<img src="http://<?=$_SERVER['HTTP_HOST']?>/uploads/images/posts/<? echo date('Y/m/d/',$lst_new_post['pos_time']).$lst_new_post['pos_img'] ?>" style="width:70px;height: 60px; float: left; margin-left:12px">
					<span class="content_newest"><? $str = $article->removeTag($lst_new_post['pos_content']); echo $article->subText($str,100);?></span>
				</div>
				<span style="float:right;color:#249727; font-size: 12px;  font-style: italic;margin-right:5px;"><? echo timeAgoInWords(converTime($lst_new_post['pos_time'], "H:i "))?>, bởi <span style="color: #33664d; font-weight: bold;"><a href="<?=$url_author.$lst_new_post['pos_mem_id']?>/"><?=$lst_new_post['mem_name']?></a></span></span>
			</div>	
		</div>
		<?}?>				
	</div>
</div>
<!-- TAGS -->
<div class="col-md-12">
	<div class="sidebar-box list-cat">
		<p class="title_box Cambria">TAGS</p>
		<?

		$list_tags = new db_query("SELECT DISTINCT(tags.tag_name) FROM tags JOIN article_tag_cloud ON tags.tag_id = article_tag_cloud.atc_tag_id JOIN posts ON posts.pos_id = article_tag_cloud.atc_pos_id JOIN categories ON categories.cat_id = posts.pos_cat_id WHERE (cat_show_menu = 1 AND tag_active = 1 ".$check_log.") ". $check_list." ORDER BY tag_name ASC LIMIT 30");
		while ($lstTag = mysql_fetch_assoc($list_tags->result)) {
        ?>
            <a class="tag_block Cambria" href="http://<?=$_SERVER['HTTP_HOST']?>/tag-<?=str_replace(' ','-',removeAccent($lstTag['tag_name']));?>"><span class="before_tag"></span>&nbsp;<?=$lstTag['tag_name']?><span class="after_tag"></span></a>
        <?                  
		}
		?>					
	</div>
</div>

<!-- BÌNH LUẬN -->

<div class="col-md-12">
	<div class="sidebar-box">
		<label class="title_box Cambria">BÌNH LUẬN GẦN ĐÂY</label>
		<?
			$comment = new db_query("SELECT comments.*, members.mem_name, posts.pos_title, posts.pos_id, posts.pos_cat_id, posts.pos_mem_id FROM comments JOIN posts ON comments.cmt_pos_id = posts.pos_id JOIN members ON comments.cmt_mem_id = members.mem_id WHERE cmt_active = 1 AND posts.pos_active = 1 ORDER BY cmt_id DESC LIMIT 4");
			while($lst_cmt = mysql_fetch_assoc($comment->result)){
			$num_cmt = new db_count("SELECT count(*) as count FROM comments WHERE cmt_active = 1 AND cmt_pos_id = ".$lst_cmt['cmt_pos_id']);
		?>
		<div class="box_cmt">
			<div class="date_cmt">
				<span class="days_cmt RobotoCondensed"><? echo date('d',$lst_cmt['cmt_time'])?></span>
				<span class="month_cmt RobotoCondensed"><? echo date('M',$lst_cmt['cmt_time'])?></span>
			</div>
			<div class="line_cmt1">
				<i class="fa fa-comment-o pull-left"></i><span><? echo $num_cmt->total;?> /</span>
				<span class="black f_16px">bởi <a href="<?=$url_author.$lst_cmt['cmt_mem_id']?>/"><?=$lst_cmt['mem_name']?></a></span>
				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lst_cmt['pos_id'].'-'.$article->removeTitle($lst_cmt['pos_title'])?>.html" class="pos_name black Cambria"><?=$lst_cmt['pos_title']?></a>
			</div>
			<div class="line_content limit_char">
				<label><? $str =  strip_tags(htmlspecialchars_decode($lst_cmt['cmt_content']));
				echo $article->subText($str, 50);?></label>
			</div>
		</div>
		<?}?>
	</div>
</div>

<!-- ***** -->
<!-- 
<div class="col-md-12">
	<div class="sidebar-box">
		<label>Suggested Tuts+ Course</label>
		<img src="themes/images/vid.png">
		<a href="">iPhone App Development With Swift</a>
	</div>
</div> -->

<!-- ***** -->

<!-- <div class="col-md-12">
	<div class="sidebar-box">
		<label>Envato Market Item</label>
		<a href="#"><img src="themes/images/banner-sm.jpg"></a>
	</div>
</div> -->