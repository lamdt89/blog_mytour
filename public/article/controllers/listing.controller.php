<?
      //var_dump($_GET['lpage']);die;
		$cat_id = $_GET['cat_id'];
		//$cat_parent = $_GET['cat_parent_id'];
		$get_parent = new db_query("SELECT * FROM categories WHERE cat_id =".$cat_id);
		$tt = mysql_fetch_assoc($get_parent->result);
      $article = new Article();
      $check_url = '/c'.$_GET['cat_id'].'-'.$article->removeTitle($row['cat_name']).'/';
      if($check_url != $_SERVER['REQUEST_URI']){
         redirect($check_url);
      }
		if($tt['cat_parent_id'] == 0){			
			$arr_parent = new db_query("SELECT * FROM categories WHERE cat_parent_id =".$cat_id);
			while($lst = mysql_fetch_assoc($arr_parent->result)){
				$arr_cat_id[$lst['cat_id']] = $lst;
			}
			if(isset($arr_cat_id)){
				$list_loc_id = implode(",", array_keys($arr_cat_id));
				$where_clause = " IN (".$list_loc_id.")";
			}
			else{
				redirect('http://'.$_SERVER['HTTP_HOST'].'/404');
			}
		}
		else{
			if($tt['cat_has_child'] == 1){
				$arr_parent = new db_query("SELECT * FROM categories WHERE cat_parent_id =".$tt['cat_id']);
				while($lst = mysql_fetch_assoc($arr_parent->result)){
					$arr_cat_id[$lst['cat_id']] = $lst;
				}
				if(isset($arr_cat_id)){
					$list_loc_id = implode(",", array_keys($arr_cat_id));
					$where_clause = " IN (".$list_loc_id.")";
				}
				else{
					redirect('http://'.$_SERVER['HTTP_HOST'].'/404');
				}
			}else{
				$where_clause = " = ".$cat_id;
			}			
		}

		$post = array();	
		$sql = "SELECT * FROM posts WHERE pos_active = 1 AND pos_cat_id ".$where_clause." ORDER BY pos_id DESC LIMIT ";
	   if(isset($_GET['lpage'])) {
	      $begin = ($_GET['lpage'] - 1)*6;
	      $sql .= $begin.",6";
	   }else {
	      $sql .= " 0,6";
	   }
		$listing= new db_query($sql);
		while($rows = mysql_fetch_assoc($listing->result)){
			$post[] = $rows;
		}

		$db = new db_query("SELECT * FROM posts WHERE pos_active = 1 AND pos_cat_id ".$where_clause);
		$lcount = mysql_num_rows($db->result);
		$t_lpage = ceil($lcount/6);
		$article = new Article();

	
?>