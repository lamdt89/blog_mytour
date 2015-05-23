<?
require_once("../../resource/security/security.php");
require_once("../../../public/controllers/article.controller.php");
$module_id	= 34;
checkLogged();
$article = new Article();
$fs_table = "vote_option";
$fs_join_table = " vote_option JOIN posts ON vote_option.vop_pos_id = posts.pos_id ";
$id_field = "vop_id";
$name_field	= "vop_name";
?>