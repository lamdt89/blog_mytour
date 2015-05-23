<?
	$pos_id = $_GET['pos_id'];
	$sql = "SELECT posts.*, members.mem_id, members.mem_name, categories.cat_id,categories.cat_name FROM posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id WHERE pos_id = ".$pos_id;
   //var_dump($pos_id);die;
	$detail = new db_query($sql);
	$row = mysql_fetch_assoc($detail->result);
	
	if($row == ""){
		echo "<script>window.history.back();</script>";
		exit;
	}else{
      $article = new Article();
      $check_url = '/p'.$_GET['pos_id'].'-'.$article->removeTitle($row['pos_title']).'.html';
      if($check_url != $_SERVER['REQUEST_URI']){
         redirect($check_url);
      }
   }
	$article = new article();
	$result = $article->breadcrum('posts','categories','pos_cat_id','cat_id','pos_id',$pos_id,'cat_parent_id');
	$count = count($result);

	$dot = substr($row['pos_att_file'],-3);

	switch ($dot) {
      case 'doc':
         $img = 'doc.png';
         break;

		case 'ocx':
			$img = 'docx.png';
			break;
		
		case 'pdf':
			$img = 'pdf.png';
			break;

		case 'xls':
			$img = 'xls.png';
			break;

		case 'lsx':
			$img = 'xlsx.png';
			break;
		return $img;
	}
?>