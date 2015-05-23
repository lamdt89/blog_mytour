<?
	require ("vote.php");
	$id_logged = isset($_SESSION["ses_mem_id"]) ? intval($_SESSION["ses_mem_id"]) : 0;	

	if($id_logged != 0){
		$check_voted = new db_query("SELECT * FROM votes JOIN vote_option ON votes.vot_vote_option_id = vote_option.vop_id WHERE vote_option.vop_pos_id = ".getValue("pos_id","int","GET")." AND votes.vot_mem_id = ".$id_member);
		if(mysql_fetch_assoc($check_voted->result) == ""){
			$tbao = "hide";
			$show_btn = "show";
		}else{
			$tbao = "show";
			$show_btn = "hide";
		}
		
	}else{
		$show_vote_frame = "show";
		$show_btn = "hide";
		$tbao = "hide";
	}
	$check_has_vote = new db_query("SELECT * FROM vote_option  WHERE vop_pos_id = ".getValue("pos_id","int","GET"));
	if(mysql_fetch_assoc($check_has_vote->result) == ""){
		$show_vote_frame = "hide";
	}else{
		$show_vote_frame = "show";
	}	
?>
	<div class="vote_frame <?=$show_vote_frame?>">
		<h3>Tham khảo ý kiến</h3>
		<form action="" method="POST" class="frm_post" enctype="multipart/form-data">
			<?
			$get_option_vote = new db_query("SELECT * FROM vote_option WHERE vop_active = 1 AND vop_pos_id = ".getValue("pos_id","int","GET"));
			while($lst_option = mysql_fetch_assoc($get_option_vote->result)){
				$num_vote = new db_count("SELECT count(*) as count FROM votes WHERE vot_vote_option_id = ".$lst_option['vop_id']);
				$num_of_vote = $num_vote->total;
				$check_voted = new db_query("SELECT * FROM votes JOIN vote_option ON votes.vot_vote_option_id = vote_option.vop_id WHERE vop_pos_id = ".getValue("pos_id","int","GET")." AND vot_mem_id = ".$id_member);
	   			$active_voted = mysql_fetch_assoc($check_voted->result);
				if($active_voted['vot_vote_option_id'] == $lst_option['vop_id']){
					$active_class = "active_vote";
				}else{
					$active_class = "";
				}				
			?>
				<label class="group_vote">
					<input type="radio" name="vote_option" class="rdVote <?=$show_btn?>" value="<?=$lst_option['vop_id']?>">
	                <div class="box_vote">
	                	<p class="num_vote <?=$active_class?>">
	                		<?=$num_of_vote?>
	                	</p>
	                	<label class="vote_option_name"><?=$lst_option['vop_name']?></label>
	                </div>	                
	                	                
	            </label>
			<?
				}
			?>
            <p class="<?=$show_btn?>">
            	<input class="btn btn-primary btnvote" type="submit" name="insert_vote" id="update_vote" value="Hoàn tất" style="margin-left: 57px;">
            </p>
            <label style='color:red;font-weight: normal;' class="<?=$tbao?>"> Bạn đã vote rồi !</label>
		</form>
	</div>
