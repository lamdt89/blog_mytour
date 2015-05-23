<?
	session_start();

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$current_time = strtotime(date('h:i A d-m-Y'));

	require_once("../../core/classes/database.php");
	require_once("../../core/classes/menu.php");
	require_once("../../core/classes/generate_form.php");
	require_once("../../core/classes/upload.php");
	require_once("../../core/functions/functions.php");
	require_once("../../core/classes/form.php");
	require_once("../../core/classes/timeago.php");

	require_once("../controllers/article.controller.php");
	require_once("../controllers/comment.controller.php");
	//load css
	$load_header = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
    $load_header .= '<link href="http://'.$_SERVER["HTTP_HOST"].'/themes/images/favicon.ico" rel="icon" type="image/x-icon">';
	$load_header .='<link href="http://'.$_SERVER["HTTP_HOST"].'/themes/css/bootstrap.min.css" rel="stylesheet" >';
	$load_header.='<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["HTTP_HOST"].'/themes/css/style.css" />';
	$load_header.='<link href="http://'.$_SERVER["HTTP_HOST"].'/themes/css/font-awesome.min.css" rel="stylesheet" >';
	//style code
	$load_header .= '<link type="text/css" rel="stylesheet" href="http://'.$_SERVER["HTTP_HOST"].'/themes/css/shCore.css">';
	$load_header .= '<link type="text/css" rel="stylesheet" href="http://'.$_SERVER["HTTP_HOST"].'/themes/css/shThemeDefault.css">';
	$load_header .= '<link type="text/css" rel="stylesheet" href="http://'.$_SERVER["HTTP_HOST"].'/themes/js/highlight/styles/github.css">';
	// $load_header .= '<link href="admin/resource/css/jquery.autocomplete.css" rel="stylesheet" type="text/css">';
	//load js
	$load_header .= '<script src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/jquery.js"></script>';
	$load_header .= '<script src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/bootstrap.min.js"></script>';
    $load_header .= '<script src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/bootstrap.filestyle.js"></script>';
	$load_footer = '<script src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/ajax.js"></script>';

	$load_footer .= '<script type="text/javascript" src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/ckeditor/ckeditor.js"></script>';

	$load_footer .= '<script type="text/javascript" src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/highlight/highlight.pack.js"></script>';

	//thêm home.js
	$load_footer.='<script src="http://'.$_SERVER["HTTP_HOST"].'/themes/js/home.js"></script>';
	$fs_imagepath_up    = "../../uploads/images/";

	$url_author = 'http://'.$_SERVER["HTTP_HOST"].'/author-';	
?>