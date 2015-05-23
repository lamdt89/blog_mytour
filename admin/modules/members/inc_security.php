<?
require_once("../../resource/security/security.php");

$module_id	= 4;
//Check user login...

checkLogged();
//Declare prameter when insert data
$fs_table = "members";
$id_field = "mem_id";
$name_field	= "mem_name";
?>