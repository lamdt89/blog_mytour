<?
// function removeTitle($string,$keyReplace = "/"){
// 	 $string = removeAccent($string);
// 	 $string  =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
// 	 $string  =  str_replace(" ","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace("--","-",$string);
// 	 $string = str_replace($keyReplace,"-",$string);
// 	 return strtolower($string);
// }
/** rewrite fillter */
function rewrite_url_fillter($arr = array()){
	global $lang_path;
	/** iCat thể loại
	 *  iSub Loại phụ đề
	 *  iVid Chất lượng hình ảnh
	 *  iCou Quốc gia
	 *  iImbd Điểm imdb
	 */
	$iCat	=	$arr['iCat'];
	$iCou	=	$arr['iCou'];
	$iSub	=	$arr['iSub'];
	$iVid	=	$arr['iVid'];
	$iImdb	=	$arr['iImdb'];
	$iYear  = isset($arr['iYear']) ? $arr['iYear'] : 0;
	$iTime  = isset($arr['iTime']) ? $arr['iTime'] : 0;
	$title  = isset($arr['Title']) ? $arr['Title'] : "";
	$url	=	$lang_path . "/" . removeTitle($title)  . "-" . "c" . $iCat . "co" . $iCou . "s" . $iSub . "v" . $iVid . "i" . $iImdb . "y" . $iYear . "t" . $iTime . ".html";
	return $url;
}
/** rewrite url categories */
function rewrite_url_help($arr =	array()){
	global $lang_path;
	$iHel		= isset($arr["hel_id"]) ? intval($arr["hel_id"]) : 0;
	$url 		= $lang_path . "/" . $iHel . "_" . removeTitle($arr['hel_title']) . ".html" ;
	return $url;	
}
/** rewrite url categories */
function rewrite_url_catmovies($arr =	array()){
	global $lang_path;
	$iCat		= isset($arr["iCat"]) ? intval($arr["iCat"]) : 0;
	$url 		= $lang_path . "/" ."movie" . "/" . $arr['iCat'] . '/' . removeTitle($arr["cat_name"]) . ".html" ;
	return $url;	
}
/** rewrite url country */
function rewrite_url_countrymovies($arr =	array()){
	global $lang_path;
	$iCou		= isset($arr["iCou"]) ? intval($arr["iCou"]) : 0;
	$url 		= $lang_path . "/" . "cou-" . $arr['iCou'] . '/' . removeTitle($arr["cou_name"]) . ".html" ;
	return $url;	
}
/** rewrite url subtitle */
function rewrite_url_subtitlemovies($arr =	array()){
	global $lang_path;
	$iSub		= isset($arr["iSub"]) ? intval($arr["iSub"]) : 0;
	$url 		= $lang_path . "/" . "sub-" . $arr['iSub'] . '/' . removeTitle($arr["sub_name"]) . ".html" ;
	return $url;	
}
/** rewrite url country */
function rewrite_url_videotype($arr =	array()){
	global $lang_path;
	$iVid		= isset($arr["iVid"]) ? intval($arr["iVid"]) : 0;
	$url 		= $lang_path . "/" . "vid-" . $arr['iVid'] . '/' . removeTitle($arr["vid_name"]) . ".html" ;
	return $url;	
}

/** rewrite url playvideo */
function rewrite_url_playmovie($arr =	array()){
	global $lang_path;
	$iMov		= isset($arr["iMov"]) ? intval($arr["iMov"]) : 0;
	$url 		= $lang_path . "/" . "play-" .  $arr['iMov'] . '/' . removeTitle($arr["mov_name"]) . ".html" ;
	return $url;	
}

/** rewrite url detail movie */
function rewrite_url_detailmovies($arr =	array()){
	global $lang_path;
	$iMov		= isset($arr["iMov"]) ? intval($arr["iMov"]) : 0;
	$iGp		= isset($arr['iGp'])? intval($arr['iGp']): 0;
	$url 		= $lang_path . "/xem-phim/" . removeTitle($arr["mov_name"]) . "-v" . $arr['iMov'] . "g" . $iGp . ".html" ;
	return $url;	
}


function rewrite_url_category($row, $array_param = array(), $remove = 0){
	global $lang_path;
	$iNee		= isset($array_param["iNee"]) ? intval($array_param["iNee"]) : 0;
	$iTime	= isset($array_param["iTime"]) ? intval($array_param["iTime"]) : 0;
	$url 		= $lang_path . "/" . $row["cat_type"] . "-ca" . (($remove > 0) ? $remove : $row["cat_id"]) . "ne" . $iNee  . (($iTime > 0) ? "ti" . $iTime : "") . "/" . removeTitle($row["cat_name"]) . ".html" ;
	return $url;
	
}
function rewrite_url_search($row, $array_param = array(), $remove = 0){
	global $lang_path;
	global $cit_parent_id;
	$iCat		= isset($array_param["iCat"]) ? intval($array_param["iCat"]) : 0;
	$iTime	= isset($array_param["iTime"]) ? intval($array_param["iTime"]) : 0;
	$rmiCat	= isset($array_param["rmiCat"]) ? intval($array_param["rmiCat"]) : 0;
	$keyword = isset($array_param["keyword"]) ? strval($array_param["keyword"]) : "";
	$url 		= $lang_path . "/ca" . (($rmiCat == 1) ? 0 : $iCat) . "/" . urlencode($keyword) . "/" ;
	return $url;
	
}
function rewrite_url_need($row, $array_param = array(), $remove = 0){
	global $lang_path;
	$iCat		= isset($array_param["iCat"]) ? intval($array_param["iCat"]) : 0;
	$iTime	= isset($array_param["iTime"]) ? intval($array_param["iTime"]) : 0;
	$module	= isset($array_param["module"]) ? strval($array_param["module"]) : "all";
	$url 		= $lang_path . "/" . $module . "-ca" . $iCat . "ne" . (($remove == 1) ? "0" : $row["nee_id"])  . (($iTime > 0) ? "ti" . $iTime : "") . "/" . removeTitle($row["nee_name"]) . ".html" ;
	return $url;
	
}
function rewrite_url_city($row, $array_param = array(), $remove = 0){
	global $lang_path;
	$iCat				= isset($array_param["iCat"]) ? intval($array_param["iCat"]) : 0;
	$iNee				= isset($array_param["iNee"]) ? intval($array_param["iNee"]) : 0;
	$iTime			= isset($array_param["iTime"]) ? intval($array_param["iTime"]) : 0;
	$module			= isset($array_param["module"]) ? strval($array_param["module"]) : "all";
	if($iCat == 0 && $iNee == 0 ){
		$url 	= $lang_path . "/" . removeTitle($row["cit_name"]) . "/" . $row["cit_id"] . ".html" ;
		return $url;
	}
	$url 	= $lang_path . "/" . $module . "-ca" . $iCat . "ne" . $iNee  . "ci" . (($remove == 1) ? $row["cit_parent_id"] : $row["cit_id"]) . (($iTime > 0) ? "ti" . $iTime : "") . "/" . removeTitle($row["cit_name"]) . ".html" ;
	return $url;
	
}
function rewrite_url_time($row, $array_param = array(), $remove = 0){
	global $lang_path;
	$iCat				= isset($array_param["iCat"]) ? intval($array_param["iCat"]) : 0;
	$iNee				= isset($array_param["iNee"]) ? intval($array_param["iNee"]) : 0;
	$module	= isset($array_param["module"]) ? strval($array_param["module"]) : "all";	
	$url 	= $lang_path . "/" . $module . "-ca" . $iCat . "ne" . $iNee  . "ti" . (($remove == 1) ? 0 : $row["key"]) . "/" . removeTitle($row["name"]) . ".html" ;
	return $url;
	
}
function rewrite_url_classifield($row, $array_param = array(), $remove = 0){
	global $lang_path;
	$iCat				= isset($array_param["iCat"]) ? intval($array_param["iCat"]) : 0;
	$iNee				= isset($array_param["iNee"]) ? intval($array_param["iNee"]) : 0;
	$module			= isset($array_param["module"]) ? strval($array_param["module"]) : "all";
	$url 	= $lang_path . "/" . $module . "-ca" . $iCat . "ne" . $iNee  . "cl" . $row["cla_id"] . "/" . removeTitle($row["cla_title"]) . ".html" ;
	return $url;
	
}

function get_navigate($array = array()){
	global $cat_parent_id;
	global $arrayTimeShow;
	global $arr_categories;
	global $arr_country;
	global $arr_subtitle;
	global $arr_video_type;
	global $arr_imdb;
	global $arrayYear;
	$iCat 		= getValue("iCat", "int", "GET", 0);
	$iSub 		= getValue("iSub", "int", "GET", 0);
	$iVid 		= getValue("iVid", "int", "GET", 0);
	$iImdb 		= getValue("iImdb", "int", "GET", 0);
	$iCou 		= getValue("iCou", "int", "GET", 0);
	$iTime		=	getValue("iTime");
	$iYear		=	getValue("iYear");
	$keyword		= getValue("keyword", "str", "GET", "");
	if($keyword == 'Nhập từ tìm kiếm') $keyword = "";
	$arrayRetun	=	array();
	$arrayQuery	=	array();
	$i	=	0;
	
	if($keyword != "" && $keyword != "Nhập từ tìm kiếm"){
		$cit_id			=	($cit_parent_id > 0) ? $cit_parent_id : $iCit;
		$param			=	array("iCat" => 0, "keyword" => $keyword);
		$link				=	rewrite_url_search(array(), $param, 0);
		$arrayRetun["keyword"]["name"]	= htmlspecialchars($keyword);
		$arrayRetun["keyword"]["link"]	= $link;
		$i++;	
		
	}
	if(isset($arr_categories[$iCat]) && $iCat != 0){
		if($row = $arr_categories[$iCat]){
			$link	=	"";
			$arrayRetun["cat"]["name"]	= $row["cat_name"];
			$arrayRetun["cat"]["label"]			= "Danh Sách Phim Thể Loại " . $row["cat_name"];
			$arrayRetun["cat"]["description"]	= "thể loại phim " . $row["cat_name"] . " chuyên trang phim online miễn phí, phim chất lượng cao với đầy đủ thể loại phim như: Hành động, Tâm lý, Tình cảm, Hình sự, Viễn tưởng - Khoa học, Phiêu lưu, kinh dị ..";
			$arrayRetun["cat"]["link"]	= $link;
			$i++;	
		}		
	}	
	if(isset($arr_country[$iCou]) && $iCou != 0){
		$row	=	$arr_country[$iCou];
		$link	=	"";
		$arrayRetun["country"]["name"]	= $row["cou_name"];
		$arrayRetun["country"]["label"]	= "Danh Sách Phim Quốc Gia " . $row["cou_name"];
		$arrayRetun["country"]["description"]	= "Xem phim thuôc quốc gia " . $row["cou_name"] . " chuyên trang phim HD, Bluray bản đẹp, Phim bộ phim tập bản đẹp, và hơn nữa bạn được xem những bộ phim của những quốc gia có nền điện ảnh bậc nhất thế giới hiện nay.";
		$arrayRetun["country"]["link"]	= $link;
		$i++;
	}
	if(isset($arr_subtitle[$iSub]) && $iSub != 0){
		$row	=	$arr_subtitle[$iSub];
		$link	=	"";
		$arrayRetun["subtitle"]["name"]	= $row["sub_name"];
		$arrayRetun["subtitle"]["label"]	= "Danh Sách Phim Phụ Đề " . $row["sub_name"];
		$arrayRetun["subtitle"]["description"]	= "Phụ đề " . $row["sub_name"] . " , Với nhiều loại phụ đề khác nhau: tiếng việt, lồng tiếng, thuyết minh đảm bảo độ sắc nét khi xem phim.";
		$arrayRetun["subtitle"]["link"]	= $link;
		$i++;
	}
	if(isset($arr_video_type[$iVid]) && $iVid != 0){
		$row	=	$arr_video_type[$iVid];
		$link	=	"";
		$arrayRetun["videotype"]["name"]	= $row["vid_name"];
		$arrayRetun["videotype"]["label"]	= "Danh Sách Phim Chất Lượng " . $row["vid_name"];
		$arrayRetun["videotype"]["description"]	= "Chất lượng " . $row["vid_name"] . " , đến với motphim.vn bạn sẽ được thưởng thức những thước phim chất lượng hình ảnh HD, Bluray và hơn thế nữa bạn có thể hiểu nhiều hơn về thế giới phim khi xem thông tin về phim.";
		$arrayRetun["videotype"]["link"]	= $link;
		$i++;
	}
	if(isset($arr_imdb[$iImdb]) && $iImdb != 0){
		$row	=	$arr_imdb[$iImdb];
		$link	=	"";
		$arrayRetun["score"]["name"]	= $row["fil_title"];
		$arrayRetun["score"]["label"]	= "Danh Sách Phim IMDB " . $row["fil_title"];
		$arrayRetun["score"]["description"]	= "Lọc theo điểm phim " . $row["fil_title"] . " , Với motphim.vn bạn sẽ được xem những bộ phim nảy lửa, những bộ phim vang chấn thế giới đã được đánh giá điểm Imdb rất cao.";
		$arrayRetun["score"]["link"]	= $link;
		$i++;
	}	
	if(isset($arrayYear[$iYear]) && $iYear > 0){
		$row	=	$arrayYear[$iYear];
		$link	=	"";
		$arrayRetun["year"]["name"]	= $row["name"];
		$arrayRetun["year"]["label"]	= "Danh Sách Phim Có Năm Phát Hành " . $row["name"];
		$arrayRetun["year"]["description"]	= "Năm phát hành phim " . $row["name"] . " , motphim.vn không chỉ đưa lên những phim mới, phim xuất sắc mà còn đưa lên cả những bộ phim vang chấn một thời từ các năm trước đó.";
		$arrayRetun["year"]["link"]	= $link;
		$i++;
	}
	//print_r($arrayRetun);
	return $arrayRetun;
}

//detail url
function url_detail_news() {
	
}
?>