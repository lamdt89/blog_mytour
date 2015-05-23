<?
require_once("../../resource/security/security.php");

$module_id	= 30;

checkLogged();

if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//tên bảng
$fs_table = "categories";

//tên id của bảng
$id_field = "cat_id";

//tên category
$name_field	= "cat_name";

function Menu($parentid = 0, $space = "", $trees = array())
{
    if(!$trees)
    {
        $trees = array();
    }
    $db = new db_query("SELECT * FROM categories WHERE cat_parent_id = $parentid");
    while($rs = mysql_fetch_assoc($db->result))
    {
        $trees[] = array( 	'cat_id' 	=> 	$rs['cat_id'],
            				'cat_name'	=>	$space.$rs['cat_name']
                        );
        $trees = Menu($rs['cat_id'], $space.'---', $trees);
    }
        return $trees;
}

?>