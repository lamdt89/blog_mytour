<?
	if(isset($_GET['tag'])){
		$tag_cloud = str_replace('-',' ',removeAccent($_GET['tag']));
	}
	$dep_mem = isset($_SESSION["ses_dep_id"]) ? intval($_SESSION["ses_dep_id"]) : 0;
	$show_posts = "  AND cat_has_it = 0 AND cat_is_login = 0";
	if(isset($_SESSION['ses_mem_id'])){
		if($dep_mem == 11){
			$show_posts = "";
		}else{
			$show_posts = "  AND cat_has_it = 0 ";
		}	
	}
	$post = array();	
	$sql = "SELECT posts.*, article_tag_cloud.atc_pos_id, article_tag_cloud.atc_tag_id, tags.tag_name,categories.cat_has_it FROM posts JOIN article_tag_cloud ON article_tag_cloud.atc_pos_id = posts.pos_id JOIN tags ON article_tag_cloud.atc_tag_id = tags.tag_id JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND tags.tag_name = '".$tag_cloud."' ".$show_posts." ORDER BY pos_id DESC LIMIT 0,6";
	$listing= new db_query($sql);
	while($rows = mysql_fetch_assoc($listing->result)){
		$post[] = $rows;
	}

	$db = new db_query($sql);
	$lcount = mysql_num_rows($db->result);

	$article = new Article();
	
?>