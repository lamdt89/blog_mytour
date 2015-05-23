<?
require_once("../../resource/security/security.php");

$module_id	= 33;
//Check user login...

checkLogged();
//Declare prameter when insert data
$fs_table = "tags";
$id_field = "tag_id";
$name_field	= "tag_name";
?>