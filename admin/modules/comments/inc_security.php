<?
require_once("../../resource/security/security.php");

$module_id	= 2;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
//Declare prameter when display data
$fs_table = "comments";
$fs_table_join = "comments JOIN posts ON comments.cmt_pos_id = posts.pos_id JOIN members ON comments.cmt_mem_id=members.mem_id";
$field_data = "comments.*, posts.pos_title, members.mem_name";
$id_field = "cmt_id";
$name_field	= "cmt_content";
?>