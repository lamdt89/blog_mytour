 <?
	if(isset($_GET['q'])){
	 	$q = replace_keyword_search($_GET['q']);
	 	$q =trim($q,' ');
	}else{
		redirect("404");
	}
	$arr_text= explode(' ', $q);
	$ntext = implode('%', $arr_text);
	$ntext = '%'.$ntext.'%';
	$length_search = strlen($q);
	if(isset($_SESSION['ses_mem_id'])){
	 	$db = new db_query("SELECT * FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND pos_title LIKE '".$ntext."' ORDER BY pos_id DESC");
	 	$count = mysql_num_rows($db->result);
      $sql = "SELECT * FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND pos_title LIKE '".$ntext."' ORDER BY pos_id DESC LIMIT ";
      if(isset($_GET['spage'])) {
         $begin = ($_GET['spage'] - 1)*4;
         $sql .= $begin.",4";
      }else {
         $sql .= " 0,4";
      }
	 	$db2 = new db_query($sql);

	 	while($rows = mysql_fetch_assoc($db2->result)){
	  		$post[] = $rows;
	 	}
	}else {
	 	$db = new db_query("SELECT * FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND cat_show_menu = 1 AND pos_title LIKE '".$ntext."' ORDER BY pos_id DESC");
	 	$count = mysql_num_rows($db->result);
      $sql = "SELECT * FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND cat_show_menu = 1 AND pos_title LIKE '".$ntext."' ORDER BY pos_id DESC LIMIT ";
      if(isset($_GET['spage'])) {
         $begin = ($_GET['spage'] - 1)*4;
         $sql .= $begin.",4";
      }else {
         $sql .= " 0,4";
      }
	 	$db2 = new db_query($sql);

	 	while($rows = mysql_fetch_assoc($db2->result)){
	  		$post[] = $rows;
	 	}
	}
	$t_page = ceil($count/4);

	$article = new Article();

?>