<?
	$id_logged = isset($_SESSION["ses_mem_id"]) ? intval($_SESSION["ses_mem_id"]) : 0;
	if(getValue("id","int","GET") != 0 ){
		if(getValue("id","int","GET") == $id_logged){
			redirect("http://".$_SERVER['HTTP_HOST']."/profile");
		}
		$id_author = getValue("id","int","GET");
	}else{
		redirect("http://".$_SERVER['HTTP_HOST']."/404");
	}
	$get_author = new db_query("SELECT members.*, categories.cat_name FROM members JOIN categories ON members.mem_dep_id = categories.cat_id WHERE mem_id = ".$id_author);
	$row = mysql_fetch_assoc($get_author->result);
	if($row == ""){
		redirect("http://".$_SERVER['HTTP_HOST']."/404");
	}
	$num_posted = new db_count("SELECT count(*) as count FROM posts WHERE pos_mem_id = ".$id_author);

	$near_cmt = new db_query("SELECT comments.*, members.mem_name, posts.pos_title, posts.pos_id, posts.pos_cat_id,posts.pos_img, posts.pos_time FROM comments JOIN posts ON comments.cmt_pos_id = posts.pos_id JOIN members ON comments.cmt_mem_id = members.mem_id WHERE cmt_active = 1 AND posts.pos_active = 1 AND cmt_mem_id = ".$id_author." ORDER BY cmt_time DESC LIMIT 6");

	$dep_mem = isset($_SESSION["ses_dep_id"]) ? intval($_SESSION["ses_dep_id"]) : 0;
	$check_list = "";
	if(isset($_SESSION['ses_mem_id'])){
		$check_log = " ";
		
	}else{
		$check_log = " AND ( cat_is_login = 0 ) ";
	}
	if($dep_mem == '11'){
		$check_list = " OR cat_show_menu = 2 OR cat_show_menu = 0 ";
	}else{
		$check_list = " OR cat_show_menu = 0 ";
	}
	$new_post = new db_query("SELECT posts.*, members.mem_id, members.mem_name, categories.cat_id,categories.cat_name FROM posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE (cat_show_menu = 1 ".$check_list." ) ".$check_log." AND pos_mem_id = ".$id_author." ORDER BY pos_id DESC LIMIT 9 ");
?>