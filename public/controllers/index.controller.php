<?
	if(isset($_SESSION['ses_mem_id'])){

		$dep_mem = isset($_SESSION["ses_dep_id"]) ? intval($_SESSION["ses_dep_id"]) : 0;
		if($dep_mem == '11'){
		 	$check_list = " WHERE pos_active = 1 ";
		}else{
		 	$check_list = " WHERE pos_active = 1 AND pos_cat_id NOT LIKE 7 AND pos_cat_id NOT LIKE 8 ";
		}
		$post = array();
		$db 		= 	new db_query("SELECT * FROM posts ".$check_list);
		$count1 	= 	mysql_num_rows($db->result);
		$ipage 		= 	ceil($count1/6);
		$sql = "SELECT * FROM posts ".$check_list." ORDER BY pos_id DESC LIMIT ";
      if(isset($_GET['page'])) {
         $begin = ($_GET['page'] - 1)*6;
         $sql .= $begin.",6";
      }else {
         $sql .= " 0,6";
      }
		$index= new db_query($sql);
		while($rows = mysql_fetch_assoc($index->result)){
		 	$post[] = $rows;
		}	 
	}else {

		$post = array();
		$db 		= 	new db_query("SELECT posts.*, categories.cat_show_menu, cat_name,cat_active FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND cat_show_menu = 1");
		$count1 	= 	mysql_num_rows($db->result);
		$ipage	= 	ceil($count1/6);
	   $sql = "SELECT posts.*, categories.cat_show_menu, cat_name,cat_active FROM posts INNER JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_active = 1 AND cat_show_menu = 1 ORDER BY pos_id DESC LIMIT ";
	   if(isset($_GET['page'])) {
	      $begin = ($_GET['page'] - 1)*6;
	      $sql .= $begin.",6";
	   }else {
	      $sql .= " 0,6";
	   }
		$index= new db_query($sql);
		while($rows = mysql_fetch_assoc($index->result)){
			$post[] = $rows;
		}
	}

	$article 	= 	new Article();
	
?>