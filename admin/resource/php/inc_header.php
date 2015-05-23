<style>
	.acc_name{
		color: #FFF000;
	}
</style>
<?
//Tinh so comment
$db_count	=	new db_count("SELECT count(*) as count FROM comments JOIN posts ON comments.cmt_pos_id = posts.pos_id JOIN members ON comments.cmt_mem_id=members.mem_id");									;
$total_comment	=	$db_count->total;
unset($db_count);

//Tổng số bài viết
$db_count	=	new db_count("SELECT COUNT(pos_id) AS count
										FROM	posts");
$total_adv	=	$db_count->total;
unset($db_count);

//Tổng số người dùng
$db_count	=	new db_count("SELECT COUNT(mem_id) AS count
										FROM	members");
$total_urs	=	$db_count->total;
unset($db_count);

$isAdmin 	= isset($_SESSION["isAdmin"]) ? intval($_SESSION["isAdmin"]) : 0;

?>
<div class="header">
	<table cellpadding="0" cellspacing="0"  width="100%">
		<tr>
			<td style="font-size:14px;">Hệ thống quản trị website</td>
			<td>Tổng số bài viết: <span class="acc_name"><?=$total_adv;?></span> | Tổng số người dùng: <span class="acc_name"><?=$total_urs?></span> | Tổng số bình luận: <span class="acc_name"><?=$total_comment?></span></td>
			<td align="right">
				<a href="#">Hi! <span id="acc_name"><?=getValue("userlogin","str","SESSION","")?></span></a> 
				&nbsp;|&nbsp;
				<span id="acc1" class="infoacc"><?=translate_text("Thông tin tài khoản")?><span class="sourceacc" style="display: none;">resource/profile/myprofile.php</span></span>
				&nbsp;|&nbsp;
				<a href="resource/logout.php"><?=translate_text("Logout")?></a>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>