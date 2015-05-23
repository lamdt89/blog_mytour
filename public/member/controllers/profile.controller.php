<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);

if(isset($_SESSION['ses_mem_id'])) {
	$mem_id = $_SESSION['ses_mem_id'];
	$sql = "SELECT * FROM members WHERE mem_id = ".$mem_id;
	$user = new db_query($sql);
	$sql1 = "SELECT count(*) as count FROM posts WHERE pos_mem_id =".$mem_id;
	$count_record = new db_count($sql1); 

	$Pagination = new pagination();
	$Pagination->totalRow('posts',$mem_id);
	$Pagination->totalPage(10);
	$page = $Pagination->page();
	$firstRow = $Pagination->firstRow($page,10);

	$db = new db_query("SELECT * FROM posts WHERE pos_mem_id =".$mem_id." ORDER BY pos_id DESC LIMIT ".$firstRow.",10");

	count($db);
	while($rows = mysql_fetch_assoc($db->result)){
		$post[] = $rows;
	}
}else{
	echo "<script>alert('Bạn chưa đăng nhập !')</script>";
	redirect("/");
}
$article = new Article();


?>
