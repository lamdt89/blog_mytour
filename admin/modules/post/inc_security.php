<?
require_once("../../resource/security/security.php");

$module_id	= 3;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
//Declare prameter when insert data
$fs_table = "posts";
$fs_table_join = " posts LEFT JOIN members ON posts.pos_mem_id = members.mem_id LEFT JOIN categories ON posts.pos_cat_id = categories.cat_id";
$field_data = "posts.*, members.mem_id, members.mem_login, categories.cat_id,categories.cat_name";
$id_field = "pos_id";
$name_field	= "pos_title";
?>