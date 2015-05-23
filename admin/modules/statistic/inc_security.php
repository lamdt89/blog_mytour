<?
require_once("../../resource/security/security.php");

$module_id	= 37;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
$id_field = "pos_id";
$name_field	= "pos_title";
?>