<?php
include "inc_security.php";
//check quyền them sua xoa
checkAddEdit("edit");

$record_id		=	getValue("record_id");
$sql				=	"";
$field			=	getValue("field","str","GET","",1);
$value			=	getValue("checkbox");

$url				=	base64_decode(getValue("url","str","GET", base64_encode("listing.php")));
$ajax				=	getValue("ajax");

if($ajax==1){
   $db_select = new db_query("SELECT " . $field . " FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id );
   if($row=mysql_fetch_assoc($db_select->result)){
      $value = abs($row[$field]-1);
   }
}

$sql_update = "UPDATE " . $fs_table . " SET " . $field . " = " . $value . " WHERE " . $id_field . " = " . $record_id ;
$db_category	= new db_execute($sql_update);
unset($db_category);

if($ajax!=1){
   redirect($url);
}else{
   ?>
   <img border="0" src="<?=$fs_imagepath?>check_<?=$value?>.gif">
<?
}
?>