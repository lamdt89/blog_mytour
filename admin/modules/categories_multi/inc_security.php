<?
require_once("../../resource/security/security.php");
require_once("../../../public/controllers/article.controller.php");
$module_id	= 1;
checkLogged();
$article = new Article();
$fs_table = "modules";
$id_field = "mod_id";
$name_field	= "mod_name";
?>