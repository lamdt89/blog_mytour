<div class="container">
	<div class="author-profile">
		<div class="col-md-12 avt">
			
		</div>
		<div class="col-md-12">
			<div class="author-header" >
			<? 
			if($row['mem_avatar']==""){ 
				$ava_img =  'themes/images/DefaultImage.gif';
			}else{ 
				$ava_img = 'uploads/images/users/'.$row['mem_avatar'];
			}
			?>
				<div class="avatar"><img src="http://<?=$_SERVER['HTTP_HOST']?>/<?=$ava_img?>"></div>
				<div class="header-profile">
					<ul style="list-style: none;">
						<li><label class="Cambria" style="font-size: 20px;"><?=$row['mem_name']?></label></li>
						<li><?=$row['cat_name']?></li>
						<li>Bài viết : <?=$num_posted->total?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-9 author-bottom">
			<div class="author-content">
				<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs profile-bottom-ul">
				    <li class="active"><a href="#tab1" data-toggle="tab">Hoạt động gần đây</a></li>

				    <li ><a href="#tab3" data-toggle="tab">Bài viết gần đây</a></li>
				  </ul>
				  <div class="tab-content">
				    <div class="tab-pane  active" id="tab1">
				    	<div class="nearly_activity">
				    		<ul style="list-style: none;">
				    		<?
				    			if(mysql_num_rows($near_cmt->result) == 0){
				    				echo "<label style='padding-top:15px;'>Hiện tại thành viên này chưa có hoạt động gì mới.</label>";
				    			}else{
				    			while($lstNearCmt = mysql_fetch_assoc($near_cmt->result)){

				    		?>
				    			<li>
				    				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lstNearCmt['pos_id'].'-'.$article->removeTitle($lstNearCmt['pos_title'])?>.html">
				    					<img alt= "<?=str_replace(' ','-',removeAccent($lstNearCmt['pos_title']))?>" width="100%" height="130px" src="http://<?=$_SERVER['HTTP_HOST']?>/uploads/images/posts/<? echo date('Y/m/d/',$lstNearCmt['pos_time']).$lstNearCmt['pos_img'] ?>">
				    				</a>
				    				<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lstNearCmt['pos_id'].'-'.$article->removeTitle($lstNearCmt['pos_title'])?>.html" class="pos_name black Cambria"><?=$lstNearCmt['pos_title']?></a>
									<span class="limit_char limit2">
										<? $str = $article->removeTag($lstNearCmt['cmt_content']);
										echo $article->subText($str,50);?>
									</span>
									<span class="time_ago_cmt"><? echo timeAgoInWords(converTime($lstNearCmt['cmt_time'], "H:i "))?> </span>
				    			</li>
				    		<?}}?>
				    		</ul>
				    	</div>
				    </div>
				    <div class="tab-pane" id="tab3">
				    	<div class="nearly_activity">
				    		<?
				    		
			    			if(mysql_num_rows($new_post->result) == 0){
			    				echo "<label style='padding-top:15px;'>Thành viên này chưa có bài viết hoặc bạn cần đăng nhập để xem nội dung của các bài viết này !.</label>";
			    			}else{
				    			while($lst_post = mysql_fetch_assoc($new_post->result)){
				    				if($lst_post['pos_active'] == 0){
				    					$stt_active = "deactive";
				    					$tbao = "<label style='float:left; color:red; font-size:9px;'>Bài viết này chưa được kích hoạt !</label>";
				    				}else{
				    					$tbao = "";
				    					$stt_active = "";
				    				}
				    		?>
				    		<div class="tab_posts <?=$stt_active?>">
				    			<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lst_post['pos_id'].'-'.$article->removeTitle($lst_post['pos_title'])?>.html" title="<?=$lst_post['pos_title']?>" target="blank">
				    				<img class="row_img" alt= "<?=str_replace(' ','-',removeAccent($lst_post['pos_title']))?>" width="100%" height="130px" src="http://<?=$_SERVER['HTTP_HOST']?>/uploads/images/posts/<? echo date('Y/m/d/',$lst_post['pos_time']).$lst_post['pos_img'] ?>">
				    			</a>
				    			<h3 class="fr_cat"><a class="limit_char" href="http://<?=$_SERVER['HTTP_HOST'].'/c'.$lst_post['cat_id'].'-'.$article->removeTitle($lst_post['cat_name']).'/'?>"><?=$lst_post['cat_name']?></a></h3>
				    			<a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$lst_post['pos_id'].'-'.$article->removeTitle($lst_post['pos_title'])?>.html" class="pos_name Cambria w_100 tiny_tit" title="<?=$lst_post['pos_title']?>" target="blank"><?=$lst_post['pos_title']?></a>
				    			<span class="content_newest w_100 tiny_content limit_char" ><? $str = $article->removeTag($lst_post['pos_content']); echo $article->subText($str,150);?></span>
				    			<?=$tbao?>
				    			<span class="time_ago_cmt fl_right" ><? echo timeAgoInWords(converTime($lst_post['pos_time'], "H:i "))?> </span>
				    		</div>
				    		<?}}?>
				    	</div>				    	
		            </div>
				  </div>
				</div>
			</div>
		</div>
		<div class="col-md-3 author_right_info">
			<span>Họ tên</span>
			<label title="<?=$row['mem_first_name']?>"><? if($row['mem_first_name']==""){ echo "N/A"; }else{ echo $row['mem_first_name']; } ?></label>
			<span>Địa chỉ</span>
			<label title="<? if($row['mem_address']==''){ echo 'N/A'; }else{ echo $row['mem_address']; } ?>"><? if($row['mem_address']==""){ echo "N/A"; }else{ echo $row['mem_address']; } ?></label>
			<span>Số điện thoại</span>
			<label><? if($row['mem_phone']==""){ echo "N/A"; }else{ echo $row['mem_phone']; } ?></label>
			<span>Ngày sinh</span>
			<label><? if($row['mem_birthdays']==""){ echo "N/A"; }else{ echo $row['mem_birthdays']; } ?></label>
			<span>Ngày tham gia</span>
			<label><? echo date('d-m-Y',$row['mem_join_date'])?></label>
			<span>Tổng số bài viết</span>
			<label><?=$num_posted->total?></label>
		</div>
	</div>
</div>
<style>

</style>