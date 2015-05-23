<?
$module_id = 7;
//check security...
require_once("../../resource/security/security.php");
//Check user login...
checkLogged();
//Check access module...
//if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
$fs_table 		= "admin_user";
$user_id 		= getValue("user_id","int","SESSION");
$id_field       = "adm_id";
$name_field     = "adm_loginname";
//$field_name     = "admin_user.*, admin_user_right.adu_admin_module_id, admin_user_right.adu_add, admin_user_right.adu_edit, admin_user_right.adu_delete";
//JOIN admin_user_right ON admin_user.adm_id = admin_user_right.adu_admin_id
?>