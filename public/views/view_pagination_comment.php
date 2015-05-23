<?
	require_once ("../require.php");
	$post_id = $_GET['pid'];
	$page = $_GET['cpage'];
	$count_cmt = 3;
 	$first_cmt = ($page-1)*$count_cmt;
    $sql = "SELECT * FROM comments
            JOIN members ON comments.cmt_mem_id=members.mem_id
            WHERE cmt_pos_id={$post_id} AND cmt_active=1 ORDER BY cmt_id DESC LIMIT ".$first_cmt.",".$count_cmt;
    $comments = new db_query($sql);
?>
<?php while($row = mysql_fetch_assoc($comments->result)): ?>
    <div class="row comm col-md-12 no-padding">
        <div class="col-md-1 ava no-padding">
            <img width="100%" src="uploads/images/users/<?=$row['mem_avatar'];?>">
        </div>

	    <div class="col-md-10 no-padding" style="width:90% !important;">
	        <div class="person">
	            <p><span><a href="<?=$url_author.$row['pos_mem_id']?>/"><?=$row['mem_name']?></a></span> - <? echo timeAgoInWords(converTime($row['cmt_time'], "H:i "))?></p>
	        </div>
	        <div class="detail">
	            <p><?=html_entity_decode($row['cmt_content']);?> </p>

	        </div>
	    </div>

	</div>

<?php endwhile; ?>