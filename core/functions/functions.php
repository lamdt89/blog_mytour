<?
function base64_url_encode($input){
	return strtr(base64_encode($input), '+/=', '_,-');
}
function base64_url_decode($input) {
	return base64_decode(strtr($input, '_,-', '+/='));
}
function get_type_categories(){
	$array_value 		= array("pr"=>translate_text("Phim rạp")
									,"st"=>translate_text("Sitcom")
									,"pth"=>translate_text("Phim truyền hình")
									,"ht"=>translate_text("Hậu trường")
									,"qc"=>translate_text("Quảng cáo")
								);
	return $array_value;
}
//Get : Tìm việc nhanh
// Get data tại mục tìm việc theo trình độ
function get_array_trinhdo(){
    $array_value        = array(0 => "Bất kỳ",
                                1 => "Lao động phổ thông",
                                2 => "Chứng chỉ",
                                3 => "Trung học",
                                4 => "Trung cấp",
                                5 => "Cao đẳng",
                                6 => "Đại học",
                                7 => "Cao học",
                                8 => "Không khai báo"                                
                                );
    
    return $array_value;
    
}
// Get data tại mục tìm việc theo hình thức làm việc
function get_array_hinhthuc(){
    $array_value        = array(0 => "Bất kỳ",
                                1 => "Nhân viên chính thức",
                                2 => "Nhân viên thời vụ",
                                3 => "Bán thời gian",
                                4 => "Làm thêm ngoài giờ",
                                5 => "Thực tập và dự án"
                                );
    return $array_value;
    
}

// Get data tại mục tìm việc theo mức lương
function get_array_luong(){
    $array_value        = array(0 => "Bất kỳ",
                                1 => "1 - 2 triệu",
                                2 => "2 - 3 triệu",
                                3 => "3 - 4 triệu",
                                4 => "4 - 5 triệu",
                                5 => "5 - 8 triệu",
                                6 => "Trên 8 triệu",
                                7 => "Thỏa thuận"                                
                                );
    return $array_value;
    
}
// End tìm việc nhanh
function breakKey($content, $title, $tag=0){
	$title 			= mb_strtolower($title,"UTF-8");
	$array 			= explode(".",$content);
	$contentReturn = '';
	$arrayKey 		= explode(" ", $title);
	$arraySort 		= array();
	$arResult 		= array();
	foreach($array as $key=>$value){
		$value 				= mb_strtolower($value,"UTF-8");
		$arrayCau 			= explode(" ",$value);
		$result 	 			= array_intersect($arrayKey, $arrayCau);
		$arraySort[$key] 	= count($result);
		$arResult[$key]	= $result;
	}
	arsort($arraySort);
	$i=0;
	foreach($arraySort as $key=>$value){
		$i++;
		if(isset($array[$key]) && isset($arResult[$key])){
			$contentReturn = $contentReturn . replaceTag(cut_string($array[$key], 200), $arResult[$key]) . '. ';
		}
		if($i==3) break;
	}
	unset($result);
	unset($arraySort);
	unset($arResult);
	if($tag==1) $this->text .= strip_tags($contentReturn);
	$contentReturn = str_replace("</b>"," ",$contentReturn);
	
	return $contentReturn;
}
function replaceTag($content,$array=array()){
		
	if(count($array)>0){
		foreach($array as $key=>$value){
			$value = trim($value);
			if($value!=''){
				//echo $value. chr(13);
				//$content = @preg_replace("#" . $value . "#Usi","<b>$0</b>",$content);
				//echo $content;
			}
		}
	}
	return $content;
}
function array_currency(){
	$arrReturn	= array(0 => "USD", 1 => "EUR");
	return $arrReturn;
}

function array_language(){
	$db_language	= new db_query("SELECT * FROM languages ORDER BY lang_id ASC");
	$arrReturn		= array();
	while($row = mysql_fetch_array($db_language->result)){
		$arrReturn[$row["lang_id"]] = array($row["lang_code"], $row["lang_name"]);
	}
	return $arrReturn;
}

function array_length_of_stay_tour(){
	$arrReturn	= array (1 => "1 " . tdt("day"),
								2 => "2 - 5 " . tdt("days"),
								3 => "6 - 9 " . tdt("days"),
								4 => "10 - 16 " . tdt("days"),
								5 => "17 " . tdt("and_more_days"),
								);
	return $arrReturn;
}

function array_star_rating_hotel(){
	$arrReturn	= array (2 => "2 " . tdt("stars"),
								3 => "3 " . tdt("stars"),
								4 => "4 " . tdt("stars"),
								5 => "5 " . tdt("stars"),
								);
	return $arrReturn;
}

function array_service(){
	$arrReturn	= array (1 => tdt("Air_ticket"),
								2 => tdt("Train_ticket"),
								3 => tdt("Visa"),
								4 => tdt("Car_for_rent"),
								);
	return $arrReturn;
}

function callback($buffer){
	$str		= array(chr(9), chr(10));
	$buffer	= str_replace($str, "", $buffer);
	return $buffer;
}

function check_email_address($email) {
	//First, we check that there's one @ symbol, and that the lengths are right
	if(!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){
		//Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	//Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for($i = 0; $i < sizeof($local_array); $i++){
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){
			return false;
		}
	}
	if(!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){
	//Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if(sizeof($domain_array) < 2){
			return false; // Not enough parts to domain
		}
		for($i = 0; $i < sizeof($domain_array); $i++){
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])){
				return false;
			}
		}
	}
	return true;
}

function check_session_security($security_code){
	$return = 1;
	if(!isset($_SESSION["session_security_code"])) $_SESSION["session_security_code"] = generate_security_code();
	if($security_code != $_SESSION["session_security_code"]){
		$return = 0;
	}
	// Reset lại session security code
	$_SESSION["session_security_code"] = generate_security_code();
	return $return;
}

function count_online(){
	$visited_timeout		= 10 * 60;
	$last_visited_time	= time();
	//Kiem tra co session_id hay ko, neu co
	if(session_id() != ""){
		$db_exec	= new db_execute("REPLACE INTO active_users(au_session_id, au_last_visit) VALUES('" . session_id() . "', " . $last_visited_time . ")");
		unset($db_exec);
	}
	// Delete timeout
	$db_exec	= new db_execute("DELETE FROM active_users WHERE au_last_visit < " . ($last_visited_time - $visited_timeout));
	unset($db_exec);
	// Select Count
	$db_count= new db_query("SELECT count(*) AS count FROM active_users");
	$row		= mysql_fetch_array($db_count->result);
	unset($db_count);
	// Return value
	return $row["count"];
}

function count_visited(){
	$db_count	= new db_query("SELECT vis_counter FROM visited");
	$row = mysql_fetch_array($db_count->result);
	unset($db_count);
	return $row["vis_counter"];
}

function cut_string($str, $length, $char=" ..."){
	//Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
	$strlen	= mb_strlen($str, "UTF-8");
	if($strlen <= $length) return $str;
	
	//Cắt chiều dài chuỗi $str tới đoạn cần lấy
	$substr	= mb_substr($str, 0, $length, "UTF-8");
	if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;
	
	//Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
	$strPoint= mb_strrpos($substr, " ", "UTF-8");
	
	//Return string
	if($strPoint < $length - 20) return $substr . $char;
	else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
}

function format_number($number, $edit=0){
	if($edit == 0){
		$return	= number_format($number, 2, ".", ",");
		if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", ",");
		elseif(intval(substr($return, -1, 1)) == 0) $return = number_format($number, 1, ".", ",");
		return $return;
	}
	else{
		$return	= number_format($number, 2, ".", "");
		if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", "");
		return $return;
	}
}

function format_currency($value = ""){
	$str		=	$value;
	if($value != ""){
		$str		=	number_format(round($value/1000)*1000,0,"",",");
	}
	return $str;
}

function generate_array_variable($variable){
	$list			= tdt($variable);
	$arrTemp		= explode("{-break-}", $list);
	$arrReturn	= array();
	for($i=0; $i<count($arrTemp); $i++) $arrReturn[$i] = trim($arrTemp[$i]);
	return $arrReturn;
}

function generate_security_code(){
	$code	= rand(1000, 9999);
	return $code;
}

function generate_sort($type, $sort, $current_sort, $image_path){
	if($type == "asc"){
		$title = tdt("Tang_dan");
		if($sort != $current_sort) $image_sort = "sortasc.gif";
		else $image_sort = "sortasc_selected.gif";
	}
	else{
		$title = tdt("Giam_dan");
		if($sort != $current_sort) $image_sort = "sortdesc.gif";
		else $image_sort = "sortdesc_selected.gif";
	}
	return '<a title="' . $title . '" href="' . getURL(0,0,1,1,"sort") . '&sort=' . $sort . '"><img border="0" src="' . $image_path . $image_sort . '" style="margin-top:3px" /></a>';
}

function generate_sql_length_of_stay_tour($key){
	$arrSQL	= array (1 => " AND tou_length = 1 ",
							2 => " AND tou_length >= 2 AND tou_length <= 5 ",
							3 => " AND tou_length >= 6 AND tou_length <= 9 ",
							4 => " AND tou_length >= 10 AND tou_length <= 16 ",
							5 => " AND tou_length >= 17 ",
							);
	if(isset($arrSQL[$key])) return $arrSQL[$key];
	else return "";
}

function generate_title_url_tour($arrCou, $arrTs, $nData, $nTab){
	global $lang_path;
	$strReturn	= '<a href="' . generate_module_url("Search_tour") . ';country=' . $arrCou[0] . '">' . $arrCou[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_module_url("Search_tour") . ';country=' . $arrCou[0] . '&travel_style=' . $arrTs[0] . '">' . $arrTs[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_detail_tour_url($arrCou[1], $arrTs[1], $nData) . '">' . $nData . '</a> &raquo; ';
	$strReturn .= '<span>' . $nTab . '</span>';
	return $strReturn;
}

function generate_title_url_hotel($arrCou, $arrCity, $nData, $nTab){
	global $lang_path;
	$strReturn	= '<a href="' . generate_module_url("Search_hotel") . ';country=' . $arrCou[0] . '">' . $arrCou[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_module_url("Search_hotel") . ';country=' . $arrCou[0] . '&city=' . $arrCity[0] . '">' . $arrCity[1] . '</a> &raquo; ';
	$strReturn .= '<a href="' . generate_detail_hotel_url($arrCou[1], $arrCity[1], $nData) . '">' . $nData . '</a> &raquo; ';
	$strReturn .= '<span>' . $nTab . '</span>';
	return $strReturn;
}

function getURL($serverName=0, $scriptName=0, $fileName=1, $queryString=1, $varDenied=''){
	$url	 = '';
	$slash = '/';
	if($scriptName != 0)$slash	= "";
	if($serverName != 0){
		if(isset($_SERVER['SERVER_NAME'])){
			$url .= 'http://' . $_SERVER['SERVER_NAME'];
			if(isset($_SERVER['SERVER_PORT'])) $url .= ":" . $_SERVER['SERVER_PORT'];
			$url .= $slash;
		}
	}
	if($scriptName != 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($fileName	!= 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($queryString!= 0){
		$url .= '?';
		reset($_GET);
		$i = 0;
		if($varDenied != ''){
			$arrVarDenied = explode('|', $varDenied);
			while(list($k, $v) = each($_GET)){
				if(array_search($k, $arrVarDenied) === false){
					$i++;
					if($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
					else $url .= $k . '=' . @urlencode($v);
				}
			}
		}
		else{
			while(list($k, $v) = each($_GET)){
				$i++;
				if($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
				else $url .= $k . '=' . @urlencode($v);
			}
		}
	}
	$url = str_replace('"', '&quot;', strval($url));
	return $url;
}

function getValue($value_name, $data_type = "int", $method = "GET", $default_value = 0, $advance = 0){
	$value = $default_value;
	switch($method){
		case "GET": if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
		case "POST": if(isset($_POST[$value_name])) $value = $_POST[$value_name]; break;
		case "COOKIE": if(isset($_COOKIE[$value_name])) $value = $_COOKIE[$value_name]; break;
		case "SESSION": if(isset($_SESSION[$value_name])) $value = $_SESSION[$value_name]; break;
		default: if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
	}
	$valueArray	= array("int" => intval($value), "str" => trim(strval($value)), "flo" => floatval($value), "dbl" => doubleval($value), "arr" => $value);
	foreach($valueArray as $key => $returnValue){
		if($data_type == $key){
			if($advance != 0){
				switch($advance){
					case 1:
						$returnValue = replaceMQ($returnValue);
						break;
					case 2:
						$returnValue = htmlspecialbo($returnValue);
						break;
				}
			}
			//Do số quá lớn nên phải kiểm tra trước khi trả về giá trị
			if((strval($returnValue) == "INF") && ($data_type != "str")) return 0;
			return $returnValue;
			break;
		}
	}
	return (intval($value));
}

function get_server_name(){
	$server = $_SERVER['SERVER_NAME'];
	if(strpos($server, "asiaqueentour.com") !== false) return "http://www.asiaqueentour.com";
	else return "http://" . $server . ":" . $_SERVER['SERVER_PORT'];
}

function htmlspecialbo($str){
	$arrDenied	= array('<', '>', '\"', '"');
	$arrReplace	= array('&lt;', '&gt;', '&quot;', '&quot;');
	$str = str_replace($arrDenied, $arrReplace, $str);
	return $str;
}

function javascript_writer($str){
	$mytextencode = "";
	for ($i=0;$i<strlen($str);$i++){
		$mytextencode .= ord(substr($str,$i,1)) . ",";
	}
	if ($mytextencode!="") $mytextencode .= "32";
	return "<script language='javascript'>document.write(String.fromCharCode(" . $mytextencode . "));</script>";
}

function lang_path(){
	global $lang_id;
	global $array_lang;
	global $con_root_path;
	$default_lang = 1;
	$path	= ($lang_id == $default_lang) ? $con_root_path : $con_root_path . $array_lang[$lang_id][0] . "/";
	return $path;
}

function microtime_float(){
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

function random(){
	$rand_value = "";
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(65,90));
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(97,122));
	$rand_value.= rand(1000,9999);
	$rand_value.= chr(rand(97,122));
	$rand_value.= rand(1000,9999);
	return $rand_value;
}

function redirect($url){
	$url	= htmlspecialbo($url);
	echo '<script type="text/javascript">window.location.href = "' . $url . '";</script>';
	exit();
}

function removeAccent($mystring){
	$marTViet=array(
		// Chữ thường
		"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
		"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ","Đ","'",
		// Chữ hoa
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ","Đ","'"
		);
	$marKoDau=array(
		/// Chữ thường
		"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d","D","",
		//Chữ hoa
		"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","D","",
		);
	return str_replace($marTViet, $marKoDau, $mystring);
}

function removeHTML($string){
	$string = preg_replace ('/<script.*?\>.*?<\/script>/si', ' ', $string); 
	$string = preg_replace ('/<style.*?\>.*?<\/style>/si', ' ', $string); 
	$string = preg_replace ('/<.*?\>/si', ' ', $string); 
	$string = str_replace ('&nbsp;', ' ', $string);
	$string = mb_convert_encoding($string, "UTF-8", "UTF-8");
	$string = str_replace (array(chr(9),chr(10),chr(13)), ' ', $string);
	for($i = 0; $i <= 5; $i++) $string = str_replace ('  ', ' ', $string);
	return $string;
}

function removeLink($string){
	$string = preg_replace ('/<a.*?\>/si', '', $string);
	$string = preg_replace ('/<\/a>/si', '', $string);
	return $string;
}

function replaceFCK($string, $type=0){
	$array_fck	= array ("&Agrave;", "&Aacute;", "&Acirc;", "&Atilde;", "&Egrave;", "&Eacute;", "&Ecirc;", "&Igrave;", "&Iacute;", "&Icirc;",
								"&Iuml;", "&ETH;", "&Ograve;", "&Oacute;", "&Ocirc;", "&Otilde;", "&Ugrave;", "&Uacute;", "&Yacute;", "&agrave;",
								"&aacute;", "&acirc;", "&atilde;", "&egrave;", "&eacute;", "&ecirc;", "&igrave;", "&iacute;", "&ograve;", "&oacute;",
								"&ocirc;", "&otilde;", "&ugrave;", "&uacute;", "&ucirc;", "&yacute;",
								);
	$array_text	= array ("À", "Á", "Â", "Ã", "È", "É", "Ê", "Ì", "Í", "Î",
								"Ï", "Ð", "Ò", "Ó", "Ô", "Õ", "Ù", "Ú", "Ý", "à",
								"á", "â", "ã", "è", "é", "ê", "ì", "í", "ò", "ó",
								"ô", "õ", "ù", "ú", "û", "ý",
								);
	if($type == 1) $string = str_replace($array_fck, $array_text, $string);
	else $string = str_replace($array_text, $array_fck, $string);
	return $string;
}

function replaceJS($text){
	$arr_str = array("\'", "'", '"', "&#39", "&#39;", chr(10), chr(13), "\n");
	$arr_rep = array(" ", " ", '&quot;', " ", " ", " ", " ");
	$text		= str_replace($arr_str, $arr_rep, $text);
	$text		= str_replace("    ", " ", $text);
	$text		= str_replace("   ", " ", $text);
	$text		= str_replace("  ", " ", $text);
	return $text;
}

function replace_keyword_search($keyword, $lower=1){
	if($lower == 1) $keyword	= mb_strtolower($keyword, "UTF-8");
	$keyword	= replaceMQ($keyword);
	$arrRep	= array("'", '"', "-", "+", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”');
	$keyword	= str_replace($arrRep, " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	return $keyword;
}

function replaceMQ($text){
	$text	= str_replace("\'", "'", $text);
	$text	= str_replace("'", "''", $text);
	return $text;
}

function remove_magic_quote($str){
	$str = str_replace("\'", "'", $str);
	$str = str_replace("\&quot;", "&quot;", $str);
	$str = str_replace("\\\\", "\\", $str);
	return $str;
}

function tdt($variable){
	global $lang_display;
	if (isset($lang_display[$variable])){
		if (trim($lang_display[$variable]) == ""){
			return "#" . $variable . "#";
		}
		else{
			$arrStr	= array("\\\\'", '\"');
			$arrRep	= array("\\'", '"');
			return str_replace($arrStr, $arrRep, $lang_display[$variable]);
		}
	}
	else{
		return "_@" . $variable . "@_";
	}
}

function generate_star($value = 1, $width = 19){
	$value	=	intval($value);
	$width	=	intval($width);
	$str	=	'';
	$str	.=	'<span class="rateStar" style="background: url(\'/themes/v1/images/rating-star-'	.	$width	.	'.png\') no-repeat scroll 0 0 transparent; display: inline-block; height: '	.	$width	.	'px; width: '	.	($value*$width)	.	'px; background-position: 0px '	.	($value - 1)*(-$width)	.	'px;"></span>';
	return $str;
}

function navbar($iCit = 0, $iDis = 0, $iLoc = 0, $iHot = 0, $type = 0){
	$raquote = "&raquo;";
	
	$menu = new menu();
	$str = $menu->getAllPrentCity($iCit, $type, $raquote);
	unset($menu);
	if($iDis > 0){
		$db_select	=	new db_query("SELECT cou_id,cou_name
												FROM	countries
												WHERE	cou_id = "	.	$iCit);
		$row_city	=	mysql_fetch_assoc($db_select->result);
		unset($db_select);
		$db_select	=	new db_query("SELECT dis_name
												FROM	districts
												WHERE	dis_id = "	.	$iDis);
		$row_dis	=	mysql_fetch_assoc($db_select->result);
		unset($db_select);
		$str	.=	' <i class="icons navicon"></i><a class="parentlink" href="' . ($type == 2 ? url_city_location($row_city) : url_city($row_city, $iDis, $type)) . '">' . $row_dis['dis_name'] . '</a> ';
	}
	if($iLoc > 0){
		$db_select = new db_query("SELECT loc_id,loc_name
											FROM locations
											WHERE loc_id = " . $iLoc);
		if($row = mysql_fetch_assoc($db_select->result)){
			$str .= '<i class="icons navicon"></i> ' . $row["loc_name"];
		}
		unset($db_select);
	}
	if($iHot > 0){
		$db_select	=	new db_query("SELECT hot_name
												FROM	hotels
												WHERE	hot_id = "	.	$iHot);
		$row			=	mysql_fetch_assoc($db_select->result);
		$str			.=	' <i class="icons navicon"></i>'	.	translate("Khách sạn")	.	" " . $row["hot_name"];
		unset($db_select);
	}
	return $str;
}
/**
 * Ham get danh sach quan/huyen cua city
 */
function generate_list_district($iCit = 0, $type = 0){
	$iCit	=	intval($iCit);
	$strReturn	=	'';
	$db_select = new db_query ("SELECT cou_id,cou_parent_id,cou_name
										 FROM countries " .
										" WHERE cou_id = " . $iCit);
	$row_city	=	mysql_fetch_assoc($db_select->result);
	unset($db_select);
	$db_select	=	new db_query("SELECT dis_id,dis_name
											FROM	districts
											WHERE	dis_city_id = "	.	$iCit);
	if(mysql_num_rows($db_select->result) > 0){
		$strReturn	.=	'<table width="100%" celspacing="5"><tr><td class="hr" colspan="3">Quận huyện</td></tr><tr>';
		$i=0;
		while($row	=	mysql_fetch_assoc($db_select->result)){
			$i++;
			$url_dis	=	url_city($row_city, $row['dis_id'], $type);
			$strReturn	.=	'<td><a href="'	.	$url_dis	.	'" title="' . translate("Xem khách sạn ở") . ' ' . $row['dis_name'] . '">' . $row['dis_name'] . '</a></td>';
			if($i%3 == 0) $strReturn	.=	'</tr><tr' . (($i>3) ? ' class="more noneshow"' : '') .'>';
		}
		$strReturn	.=	'</tr>';
		if(mysql_num_rows($db_select->result) > 4) $strReturn	.= '<tr><td colspan="3"><a class="showmore linksmallhotel" href="javascript:;">Xem thêm</a><span class="spriteS iconSM"></span></td></tr>';
		$strReturn	.=	'</table>';
	}
	unset($db_select);
	return $strReturn;
}
/**
 * Ham list location hien thi vao tab theo location type
 */
function generate_list_locations($iCit = 0, $iDis = 0){
	global $path_root;
	$iCit			=	intval($iCit);
	$iDis			=	intval($iDis);
	$sql			=	"";
	if($iDis > 0){
		$sql	.=	" AND loc_district_id = " . $iDis;
	}else{
		$sql	.=	" AND loc_city_id = "	.	$iCit;
	}
	$strReturn	=	'';
	$db_select	=	new db_query("SELECT	cou_id,cou_name
											FROM	countries
											WHERE	cou_id = "	.	$iCit);
	$row_city	=	mysql_fetch_assoc($db_select->result);
	unset($db_select);
	$strReturn	.= generate_list_locations_demo($iCit, $iDis);
	$strReturn	.=	'<div id="tablistLoc" class="more noneshow listLoc border_large border_color">';
	$strReturn	.=	'<ul class="ultabs">';
	$arr_type	=	array();
	$db_select	=	new db_query("SELECT lot_id,lot_name
											FROM	locations_type
											ORDER BY lot_order");
	while($row = mysql_fetch_assoc($db_select->result)){
		$arr_type[$row['lot_id']]	=	$row['lot_name'];
	}
	unset($db_select);
	foreach($arr_type as $key=>$value){
		$strReturn	.=	'<li><a href="#tab-' . $key . '"><span>' . $value . '</span></a></li>';
	}
	$strReturn	.=	'</ul>';
	foreach($arr_type as $key=>$value){
		$strReturn	.=	'<div id="tab-' . $key . '">';
		$db_select	=	new db_query("SELECT loc_id,loc_name,loc_district_id
												FROM	locations
												WHERE	loc_type = "	.	intval($key)	.	$sql);
		if(mysql_num_rows($db_select->result) > 0){
			$strReturn	.=	'<table cellspacing="5" width="100%"><tr>';
			$i = 0;
			while($row = mysql_fetch_assoc($db_select->result)){
				$i++;
				$strReturn	.=	'<td><a href="' . $path_root . 'filter.php?module=hotel&iCit=' . $iCit . '&iDis=' . $row['loc_district_id'] . '&iLoc=' . $row['loc_id'] . '"" title="' . translate("Khách sạn ở gần") . ' ' . $row['loc_name'] . '">' . $row['loc_name'] . '</a></td>';
				if($i%6 == 0) $strReturn	.=	"</tr><tr>";
			}
			$strReturn	.=	'</tr></table>';
		}else{
			$strReturn	.=	'<p style="font-size: 12px;">Không có địa danh nào.</p>';
		}
		unset($db_select);
		$strReturn	.=	'</div>';
	}
	$strReturn	.=	'</div>';
	return $strReturn;
}
/**
 * Ham lay 6 location uu tien dua ra hien thi
 */
function generate_list_locations_demo($iCit = 0, $iDis = 0){
	global $path_root;
	$iCit			=	intval($iCit);
	$iDis			=	intval($iDis);
	$sql			=	"";
	if($iDis > 0){
		$sql	.=	"loc_district_id = " . $iDis;
	}else{
		$sql	.=	"loc_city_id = "	.	$iCit;
	}
	$strReturn	=	'';
	$db_select	=	new db_query("SELECT	cou_id,cou_name
											FROM	countries
											WHERE	cou_id = "	.	$iCit);
	$row_city	=	mysql_fetch_assoc($db_select->result);
	unset($db_select);
	$db_select	=	new db_query("SELECT loc_id,loc_name,loc_district_id
											FROM	locations
											WHERE	" . $sql . " ORDER BY loc_priority DESC");
	$total		=	mysql_num_rows($db_select->result);
	unset($db_select);
	$db_select	=	new db_query("SELECT loc_id,loc_name,loc_district_id
											FROM	locations
											WHERE	" . $sql . " ORDER BY loc_priority DESC LIMIT 4");
	if(mysql_num_rows($db_select->result) > 0){
		$strReturn	.=	'<table width="100%" celspacing="5"><tr><td class="hr" colspan="3">Địa danh</td></tr><tr>';
		$i = 0;
		while($row = mysql_fetch_assoc($db_select->result)){
			$i++;
			$strReturn	.=	'<td valign="top"><a href="' . $path_root . 'filter.php?module=hotel&iCit=' . $iCit . '&iDis=' . $row['loc_district_id'] . '&iLoc=' . $row['loc_id'] . '" title="' . translate("Khách sạn ở gần") . ' ' . $row['loc_name'] . '">' . $row['loc_name'] . '</a></td>';
			if($i%2 == 0) $strReturn	.=	'</tr><tr' . (($i>3) ? ' class="more noneshow"' : '') .'>';
		}	
		$strReturn		.=	'</tr>';
		if($total > 4) $strReturn	.=	'<tr><td colspan="3"><a class="showmore linksmallhotel" href="javascript:;">Xem thêm</a><span class="spriteS iconSM"></span></td></tr>';
		$strReturn	.=	'</table>';
		unset($db_select);
	}
	return $strReturn;
}
function getValueBound($string_bound = ""){
	$string  =  trim(preg_replace("/[^0-9.,]/i"," ",$string_bound));
	$fou		=	explode(",", $string);
	$arr_return = array();
	for($i = 0; $i<=3; $i++){
		$arr_return[$i] = isset($fou[$i]) ? doubleval($fou[$i]) : 0; 
	}
	return $arr_return;
}
function decodeParam(){
	$string 	 = getValue("p", "str", "GET", "");
	if($string != ""){
		$myDefine = new generate_define();
		$string 	 = $myDefine->fSdecode($string);
		$string	 = json_decode($string, true);
		if($string != null){
			if(isset($_GET["p"])) unset($_GET["p"]);
			$_GET	= array_merge($_GET, $string);
		}
	}
}
function isIE6(){
	if(preg_match('/\bmsie 6/i', $_SERVER['HTTP_USER_AGENT'])){
		return true;
	}else{
		return false;
	}
}
function amount_booking($rom_id, $timefrom = 0, $timeto = 0, $num_room = 1){
	$rom_id		=	intval($rom_id);
	
	$amount		=	0;
	//Lay ra gia ngay thuong cua loai phong
	$db_select	=	new db_query("SELECT rom_price
											FROM	rooms
											WHERE	rom_id = "	.	$rom_id);
	$row			=	mysql_fetch_assoc($db_select->result);
	unset($db_select);
	
	//Tinh tong so ngay de tinh tong so tien phai thanh toan
	$total_day_booking	=	(($timeto - $timefrom) / 86400);
	
	//Lay ra khoang gia dac biet voi khoang thoi gian tim kiem
	$db_getprice						=	new db_query("SELECT ropr_price
																	FROM	rooms_price
																	WHERE	ropr_time >= " . $timefrom . " AND ropr_time < " . $timeto . " AND ropr_rom_id = " . $rom_id);
	
	//Tong so ngay co gia dac biet
	$total_date_price_special		=	0;
	//Tong so tien cua nhung ngay co gia dac biet
	$total_amount_price_special	=	0;
	while($row_price = mysql_fetch_assoc($db_getprice->result)){
		$total_date_price_special++;
		$total_amount_price_special += $row_price['ropr_price'];
	}
	unset($db_getprice);
	//Tinh tong so tien
	$amount	=	$num_room * ($total_amount_price_special + (($total_day_booking - $total_date_price_special) * $row['rom_price']));
	
	return $amount;
}

//login
function removequote($str){
    $temp = str_replace("\'","'",$str);
    $temp = str_replace("'","''",$temp);
    return $temp;
}
function login($username, $passwd, $remember="0", $time="") {
    if(!empty($username)) {
        $db_user = new db_query("SELECT * FROM members WHERE mem_login= removequote('$username') LIMIT 1 ");
        if($row = mysql_fetch_assoc($db_user->result)) {
            if($row['mem_password'] == !empty($passwd)) {
                if($remember == 1) {
                    setcookie("login_name",$row['mem_name'], $time, "/" );
                    setcookie("login_id",$row['mem_id'], $time, "/" );
                    setcookie("login_avatar",$row['mem_avatar'], $time, "/" );
                    setcookie("login_dep_id",$row['mem_dep_id'], $time, "/" );
                } else {
                    setcookie("login_name",$row['mem_name'], null, "/" );
                    setcookie("login_id",$row['mem_id'], "null", null,"/" );
                    setcookie("login_avatar",$row['mem_avatar'],null, "/" );
                    setcookie("login_dep_id",$row['mem_dep_id'], null, "/" );
                }
            }
        }
    }
}
function logout() {
    setcookie("login_name"," ",null,"/");
    setcookie("login_id"," ",null,"/");
    setcookie("login_avatar"," ",null,"/");
    setcookie("login_dep_id"," ",null,"/");
    $_COOKIE["login_name"] = "";
    $_COOKIE["cucre_city"] = "";
    $_COOKIE["PHPSESS1D"] = "";
}
?>