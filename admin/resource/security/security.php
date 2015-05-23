<?
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
//error_reporting(0);
//include('constant.php');
require_once("../../../core/classes/database.php");
// require_once("../../../core/classes/entity.php");
// require_once("../../../core/classes/PHPExcel/PHPExcel/IOFactory.php");
// require_once("../../../core/classes/PHPExcel/PHPExcel.php");
// require_once("../../../core/classes/excel.php");
require_once("../../../core/classes/form.php");
require_once("../../../core/functions/functions.php");
// require_once("../../../core/functions/functions_hms.php");
// require_once("../../../core/functions/rewrite_functions_hms.php");
// require_once("../../../core/functions/file_functions.php");
require_once("../../../core/functions/date_functions.php");
// require_once("../../../core/functions/hotel_functions.php");
// require_once("../../../core/functions/tour_functions.php");
// require_once("../../../core/functions/deal_functions.php");
require_once("../../../core/functions/resize_image.php");
require_once("../../../core/functions/translate.php");
require_once("../../../core/functions/template.php");
require_once("../../../core/functions/pagebreak.php");
require_once("../../../core/classes/generate_form.php");
// require_once("../../../core/classes/generate_define.php");
// require_once("../../../core/classes/generate_define_admin.php");
// require_once("../../../core/classes/generate_quicksearch.php");
require_once("../../../core/classes/form.php");
require_once("../../../core/classes/upload.php");
require_once("../../../core/classes/menu.php");
require_once("../../../core/classes/tinyMCE.php");
// require_once("../../../core/classes/price.php");
// require_once("../../../core/classes/promo.php");
require_once("../../../core/classes/html_cleanup.php");
require_once("grid.php");
// require_once("jqgrid.php");
// require_once("../../resource/ckeditor/ckeditor.php");
//require_once("../../resource/wysiwyg_editor/fckeditor.php");
require_once("functions.php");
// require_once("../../../classes/admin_log.php");
require_once("template.php");
require_once("../../../core/functions/rewrite_functions.php");
// require_once("../../../classes/ipcheck.php");
// require_once("../../../classes/admin_user_notify.php");
// require_once("../../../vn/define.php");
// require_once("../../../hms/defined.php");
// require_once("../../../classes/room_price.php");
// require_once("../../../classes/BannerMarketing.php");
// require_once("../../../classes/permission/GroupAdmin.php");
// require_once("../../../classes/permission/AdminUser.php");
// require_once("../../../classes/permission/Role.php");
// require_once("../../../classes/permission/Permission.php");

foreach (glob("../../../controller/*") as $model) {
   require $model;
}

$tstart = microtime_float();

// if(!checkIpLogin()){
//    die("<h3 align='center'>Ban chua co quyen truy cap vao trang nay.</h3>");
// }
//die("<h3 align='center'>Hệ thống đang được nâng cấp, bạn vui lòng quay lại sau ít phút nữa.</h3>");
//Check user login...
checkLogged();
checkPermission();

// $admin_id            = getValue("user_id","int","SESSION");

// $mtUser       = AdminUser::getInstance();
// $mtGroup      = GroupAdmin::getInstance();
// $admCurrent   = $mtUser->find($admin_id);
// $mtRole       = Role::getInstance();
// $mtPermission = Permission::getInstance();
// $admCurrent->hasRole('Admin');

// Class price
// $myPrice = new roomPrice();

$current_start_time  = strtotime(date("m/d/Y"));

$lang_id             = getValue("lang_id","int","SESSION");
$isAdmin             = getValue("isAdmin", "int", "SESSION");
// $admin_log           = new admin_log($admin_id);
//Khởi tạo đối tượng notify
// $admin_notification  = new userAdminNotify($admin_id);

//Thong tin cua user dang nhap de ghi log
// $db_select = new db_query("SELECT * FROM  admin_user WHERE adm_id = " . $admin_id);
// $row_user_admin      = mysql_fetch_assoc($db_select->result);
// unset($db_select);

$map_key             = 'ABQIAAAAxX2OsBvLnA-d4iEXlVT8sRRXgDufPzUC4DRIwmB0_hQn_WYXlhRq1IFt3vqV6zLO3kBN7Nj5fhXtvA';

//phan khai bao bien dung trong admin
$fs_stype_css        = "../css/css.css";
$fs_template_css     = "../css/template.css";
$fs_border           = "#f9f9f9";
$fs_bgtitle          = "#DBE3F8";
$fs_filepath         = "../../../uploads/document/";
$fs_imagepath_gui    = "../../../uploads/images/";
$fs_imagepath        = "../../resource/images/";
$fs_scriptpath       = "../../resource/js/";
$wys_path            = "../../resource/wysiwyg_editor/";
$fs_denypath         = "../../error.php";
$wys_cssadd          = array();
$wys_cssadd          = "/css/all.css";
$sqlcategory         = "";
$fs_category         = checkAccessCategory();
$fs_is_in_adm        = 1;
$fs_path_domain      = "";
$var_domain          = "http://mytour.vn";
$glb_data_table_name = "Tables_in_db_datphong24h";

$path_images_themes  = 'http://mytour.vn:8080/themes/images/';
$path_pic_adv        = "http://mytour.vn/pictures/general/";;


$lang_time_format    = "d/m/Y";

$break_line          = "\n";

if($_SERVER['SERVER_NAME'] == "dev.mytour.vn"){
   $var_domain          = "http://dev.mytour.vn";
   $glb_data_table_name = "Tables_in_db_demomytour";
}
if($_SERVER['SERVER_NAME'] == "localhost"){
   $var_domain          = "http://localhost:8000";
   $glb_data_table_name = "Tables_in_0vg_khachsan";
   $break_line          = PHP_EOL;
}
$path_location = "/location/";
$path_root     = "/hotel/";
$path_tour     = "/tour/";
$path_hotel    = "/hotel/";
$path_deal     = "/deal/";

//Bang luu chi tiet KS theo ngon ngu (Mac dinh la TV)
$table_hotel_description    = "hotels_description_1";
//Bang luu chi tiet dia danh du lich theo ngon ngu (Mac dinh la TV)
$table_location_description = "locations_description_1";

//Bien check security
$var_security = "kjdshfkdfjdljfdd";
//phan include file css

$glb_css = '<link href="../../resource/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
$glb_css .= '<link href="../../resource/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
$glb_css .= '<link href="../../resource/css/AdminLTE.css" rel="stylesheet" type="text/css">';
$load_header = '<link href="../../resource/css/css.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/template.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/table.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/grid.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/thickbox.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/calendar.css" rel="stylesheet" type="text/css">';
//$load_header .= '<link href="../../resource/css/attribute.css" rel="stylesheet" type="text/css">';
//$load_header .= '<link href="../../resource/css/custom.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css">';
//$load_header .= '<link href="../../resource/css/bootstrap.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/jquery.tagsinput.min.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../resource/css/selectize.default.css" rel="stylesheet" type="text/css">';
$load_header .= '<link href="../../../themes/css/font-awesome.min.css" rel="stylesheet" >';

$glb_js = '<script language="javascript" src="../../resource/js/jquery.min.js"></script>';
$glb_js .= '<script language="javascript" src="../../resource/js/tinymce/tinymce.min.js"></script>';
$glb_js .= '<script language="javascript" src="../../resource/js/library.js"></script>';
$glb_js .= '<script language="javascript" src="../../resource/js/bootstrap.min.js"></script>';
$glb_js .= '<script language="javascript" src="../../resource/js/grid.js"></script>';
// $glb_js .= '<script language="javascript" src="../../resource/js/AdminLTE/app.js"></script>';
//phan include file script
//$load_header .= '<script language="javascript" src="../../resource/js/jquery_1.8.2.js"></script>';
//$load_header .= '<script language="javascript" src="../../resource/js/jquery-1.4.2.min.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/jquery.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/tinymce/tinymce.min.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/library.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/thickbox.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/calendar.js"></script>';
//$load_header .= '<script language="javascript" src="/themes/js/bootstrap.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/jquery.jeditable.mini.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/swfObject.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/jwysiwyg/jquery.wysiwyg.js"></script>';
//$load_header .= '<script language="javascript" src="../../resource/js/jquery.tagsinput.min.js"></script>';
//$load_header .= '<script language="javascript" src="../../resource/js/bootstrap-tagsinput.min.js"></script>';
$load_header .= '<script language="javascript" src="../../resource/js/selectize.min.js"></script>';

$load_header_google_map = '<link href="../../resource/css/custom.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" type="text/css" href="../../resource/css/autocomplete.css" />
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script type="text/javascript" src="../../resource/js/jquery.js"></script>
   <script type="text/javascript" src="../../resource/js/geo_autocomplete.js"></script>
   <script type="text/javascript" src="../../resource/js/jquery.autocomplete_geomod.js"></script>
   <script type="text/javascript" src="../../resource/js/map_api.js"></script>';

$path_picture         = "";
$path_pic_user        = $path_picture . "/pictures/users/";
$path_images_global   = "/images/";
$noimage_avatar_small = $path_images_global  .  "noAvatar_50.gif";

$fs_change_bg         = 'onMouseOver="this.style.background=\'#DDF8CC\'" onMouseOut="this.style.background=\'#FEFEFE\'"';
//phan ngon ngu admin
$db_language = new db_query("SELECT tra_text,tra_keyword FROM admin_translate");
$langAdmin   = array();
while($row=mysql_fetch_assoc($db_language->result)){
   $langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}

$db_con = new db_query("SELECT * FROM configuration WHERE con_lang_id = 1");
if($row = mysql_fetch_array($db_con->result)){
   while (list($data_field, $data_value) = each($row)) {
      if (!is_int($data_field)){
         //tao ra cac bien config
         $$data_field = $data_value;
         //echo $data_field . "= $data_value <br>";
      }
   }
}

$db_con->close();
unset($db_con);

// $array_group_attribute  =  array(
//    1 => "Group Hotel",
//    2 => "Group Room",
//    3 => "Group Restaurant",
//    4 => "Group Tour",
//    5 => "Add Service"
// );

//Mang tien te
// $arr_currency   = array();
// $arr_convert    = array();
// $array_currency = array();
// $currencies     = array();
// $db_select      = new db_query("SELECT * FROM  currency ORDER BY cur_order");
// while($row = mysql_fetch_assoc($db_select->result)){
//    $arr_currency[$row['cur_id']]   = $row['cur_name'];
//    $arr_convert[$row['cur_id']]    = $row['cur_convert'];
//    $array_currency[$row["cur_id"]] = array(
//       'cur_id'      => $row['cur_id'],
//       'cur_name'    => $row['cur_name'],
//       "name"        => $row['cur_name'],
//       'cur_convert' => $row['cur_convert'],
//       "convert"     => $row['cur_convert'],
//       "symbol"      => $row['cur_symbol']
//    );
//    $currencies[$row['cur_id']] = $row['cur_convert'];
// }
// unset($db_select);

/**
 * ID cua mot so nguoi duoc quyen duyet checkout
 * 1: thuytt: ID 36
 * 2: tuannt: 22
 * 3: manhmoc: 45
 */

$db_select = new db_query("SELECT adm_id, adm_loginname FROM admin_user
   WHERE adm_active = 1 AND adm_delete = 0");
while ($row = mysql_fetch_assoc($db_select->result)) {
   $loginname  = $row['adm_loginname'];
   $$loginname = intval($row['adm_id']);
}
unset($db_select);

// $arr_check_isset = array(
//    'huyenctt',
//    'santh',
//    'nhungpt'
// );
// foreach ($arr_check_isset as $k) {
//    if (!isset($$k)) $$k = 0;
// }
// if (!isset($baongocdv)) {
//    $baongocdv = 0;
// }
// if (!isset($tuannmh)) {
//    $tuannmh = 0;
// }
// if (!isset($hadt)) {
//    $hadt = 0;
// }
// if (!isset($cuongtdb)) {
//    $cuongtdb = 0;
// }
// if (!isset($vietdq)) {
//    $vietdq = 0;
// }
// if (!isset($nhungpt)) {
//    $nhungpt = 0;
// }
// if (!isset($phuongdm)) {
//    $phuongdm = 0;
// }
// if (!isset($thanhvd)) {
//    $thanhvd = 0;
// }
// if (!isset($anhvtn_mytour)) {
//    $anhvtn_mytour = 0;
// }
// if (!isset($thuyduong)) {
//    $thuyduong = 0;
// }
// if (!isset($hangtt)) {
//    $hangtt = 0;
// }
// if (!isset($trind)) {
//    $trind = 0;
// }
// if (!isset($ngando)) {
//    $ngando = 0;
// }
// if (!isset($huyennt)) {
//    $huyennt = 0;
// }
// if (!isset($nhungpt_kt)) {
//    $nhungpt_kt = 0;
// }
// if (!isset($hangpt)) {
//    $hangpt = 0;
// }
// if (!isset($trandtv)) {
//    $trandtv = 0;
// }
// if (!isset($anhvtn)) {
//    $anhvtn = 0;
// }
// if (!isset($trinhntk)) {
//    $trinhntk = 0;
// }
// if (!isset($vananhnt)) {
//    $vananhnt = 0;
// }
// if (!isset($hanhlth)) {
//    $hanhlth = 0;
// }
// if (!isset($quangmanh)) {
//    $quangmanh = 0;
// }
// if (!isset($sonpt)) {
//    $sonpt = 0;
// }
// if (!isset($thanhnt)) {
//    $thanhnt = 0;
// }
// if (!isset($nguyetminh)) {
//    $nguyetminh = 0;
// }
// if (!isset($haict)) {
//    $haict = 0;
// }

// if (!isset($bichhien)) {
//    $bichhien = 0;
// }

// if (!isset($mainq)) {
//    $mainq = 0;
// }

// $array_admin_special = array($thuytt, $sontn, $thanhvd, $manhmoc, $huyenctt, $phuongdm, $baongocdv);
// $array_admin_money   = array($thuytt, $thuypt, $nhungpt, $anhptl, $phuongdm, $sontn, $huyennt, $hangpt, $trandtv, $bichhien, $ngando);
// $array_group_leader  = array($thuytt, $anhvtn, $thoanq, $annt, $huyenctt, $trind, $anhvtn, $vietdq, $hangtt, $ngocdth, $ngando, $mainq);
// $array_change_status = array($thuypt, $thuytt, $nhungpt, $huyennt);

//Group category
$cat_type_news       = "static";
$cat_type_restaurant = "restaurant";
$cat_type_food       = "food";
$cat_type_tour       = "tour";
$cat_type_deal       = "deal";
$cat_type_faq        = "faq";
$cat_type_news_mytour= "news";

//Thong tin gui kem o phan cuoi Email, sua o day thi sua ben ngoai nua

// $footer_of_email = '<p style="margin-top: 20px;">-----------------------------------------------------------------------</p>';
// $footer_of_email .= "<p style='font-weight: bold; margin-bottom: 0px;'>" . $con_end_email_string . "</p>";
// $footer_of_email .= "<p style='font-weight: bold; margin-bottom: 0px;'>Tài khoản ATM:</p>";
// $footer_of_email .= $con_atm_account;
// $footer_of_email .= "<p style='margin: 10px 0px 2px 0px;'><b>Hotline:</b> " . $con_hotline . "</p>";
// $footer_of_email .= "<p style='margin: 2px 0px;'><b>Email:</b> " . $con_email_support . "</p>";

//Mang chua mot so attribute dac biet nhu wifi, an sang... Sua o day thi sua ca ben ngoai nua
// $array_attribute_service = array(
//    1 => array(
//       "col"      => 1,
//       "value"    => 67108864,
//       "class"    => "wifi",
//       "title"    => "Wifi miễn phí",
//       "title_en" => "Free wifi"
//    )
//    ,2 => array(
//       "col"      => 4,
//       "value"    => 8192,
//       "class"    => "freefood",
//       "title"    => "Miễn phí 3 bữa ăn",
//       "title_en" => "Fully 3 meals per day"
//    )
//    ,3 => array(
//       "col"      => 4,
//       "value"    => 128,
//       "class"    => "breakfast",
//       "title"    => "Bữa sáng miễn phí",
//       "title_en" => "Breakfast included"
//    )
// );

$array_year = array(
   2011  => "2011"
   ,2012 => "2012"
   ,2013 => "2013"
   ,2014 => "2014"
   ,2015 => "2015"
);

$array_month   =  array(
   1   => "01"
   ,2  => "02"
   ,3  => "03"
   ,4  => "04"
   ,5  => "05"
   ,6  => "06"
   ,7  => "07"
   ,8  => "08"
   ,9  => "09"
   ,10 => "10"
   ,11 => "11"
   ,12 => "12"
);
//So luong bang luu gia phong
$num_table_price  =  10;

//Các hinh thuc thanh toan (Sua ngoai inc_config_variable)
// $array_pay_method = array(
//    0                     => "NA"
//    ,PAYMENT_DIRECT       => "Mytour office"
//    ,PAYMENT_DIRECT_HN    => "Mytour office HN"
//    ,PAYMENT_DIRECT_HCM   => "Mytour office HCM"
//    ,PAYMENT_BANK         => "Bank transfer personal account"
//    ,PAYMENT_BANK_COMPANY => "Bank transfer company account"
//    //,3                  => "Thanh toán qua baokim.vn"
//    ,PAYMENT_ONLINE       => "Electric payment"
//    ,PAYMENT_CARD         => "Card"
//    ,PAYMENT_ONLINE_BK    => "Online Bao Kim"
//    ,PAYMENT_HOME         => "Home charge"
//    ,PAYMENT_DIRECT_HOTEL => "Hotel charge"
//    ,PAYMENT_DISCOUNT     => "Discount"
//    ,PAYMENT_CYBERPAY     => "Cyberpay"
// );
//TT noi dia hay QT
// $array_payment_type = array(
//    PAYMENT_ONLINE_VN  => "TT nội địa Onepay"
//    ,PAYMENT_ONLINE_GL => "TT quốc tế Onepay"
//    ,PAYMENT_ONLINE_BK => "TT Baokim"
//    ,PAYMENT_BAOKIM_VN => "TT nội địa BK"
//    ,PAYMENT_BAOKIM_GL => "TT quốc tế BK"
// );
// Thanh toan qua ngan hang
// $array_payment_type_bank = array();
// $array_bank_fee          = array();
// $db_sl_banks_onepay = new db_query("SELECT ban_bank_id, ban_bank_name, ban_fee
//    FROM banks_onepay
//    WHERE ban_active = 1
//    ORDER BY ban_order ASC");
// while ($row_banks_onepay = mysql_fetch_assoc($db_sl_banks_onepay->result)) {
//    $array_payment_type_bank[$row_banks_onepay['ban_bank_id']] = $row_banks_onepay['ban_bank_name'];
//    $array_bank_fee[$row_banks_onepay['ban_bank_id']]  =  (double)$row_banks_onepay['ban_fee'];
// }
// unset($db_sl_banks_onepay);

/* khi thanh toan quet the */
// $array_payment_type_card_bidv = array(
//    1 => array('title' => 'Ghi nợ nội địa', 'fee' => 0.3),
//    2 => array('title' => 'Visa', 'fee' => 1.6),
//    3 => array('title' => 'Master', 'fee' => 1.8),
//    4 => array('title' => 'CUP', 'fee' => 2)
// );

/* khi thanh toan quet the */
// $array_payment_type_card_vtb = array(
//    1 => array('title' => 'E-partner', 'fee' => 0.55),
//    2 => array('title' => 'Banknet', 'fee' => 0.7),
//    3 => array('title' => 'JSB', 'fee' => 1.31),
//    4 => array('title' => 'Discover/Diners Club', 'fee' => 1.31),
//    5 => array('title' => 'Visa', 'fee' => 1.8),
//    6 => array('title' => 'Master', 'fee' => 1.8),
//    7 => array('title' => 'CUP', 'fee' => 2.31)
// );

// Thanh toan tai nha
// $array_payment_type_home = array(
//    PAYMENT_HOME_VIETTEL => "Viettel",
//    PAYMENT_HOME_TRIVIET => "Trí Việt",
//    PAYMENT_HOME_STAFF   => "Nhân viên"
// );

// Thanh toan tai van phong
// $array_payment_type_direct = array(
//    PAYMENT_DIRECT_HN  => "TT tại văn phòng HN",
//    PAYMENT_DIRECT_HCM => "TT tại văn phòng HCM"
// );

//Cac trang thai cua don dat phong
// $array_status_booking   =  array(
//    BOOKING_NEW             => "Đặt mới"
//    ,BOOKING_PROCESSING      => "Đang xử lý"
//    ,BOOKING_WAITTING_CENSOR => "Chờ duyệt"
//    ,BOOKING_SUCCESS         => "Thành công"
//    ,BOOKING_FAIL             => "Thất bại"
// );
/** Mảng chứa các loại đặt khuyến mại **/
// $array_booking_type = array(
//    -1        => "Tất cả"
//    ,SEASON_1 => "99k"
//    ,SEASON_2 => "199k đợt 1"
//    ,SEASON_3 => "199k đợt 2"
// );

//Moc thoi gian up version 2 để dùng khi thống kê một vài chỗ:
$time_version_2 = strtotime("07/15/2012");

//Phan loai muc dich dat phong của KH
// $array_purpose_booking = array(
//    1 => "Business",
//    2 => "Leisure"
// );
//Code security face login
$ip_fake       = $_SERVER['REMOTE_ADDR'];
$security_fake = "kdjhf08234jdsk3dskf";

//Cac loai ve: Ve tau, ve xe, ve may bay
// $array_traffic_type  =  array(
//    1 => "Vé tàu",
//    2 => "Vé xe",
//    3 => "Vé MB"
// );

//Mảng dịch vụ cung cấp
$array_supplier_service = array(
   // 1 => "Tour",
   // 2 => "Vé tàu",
   // 3 => "Vé ô tô",
   // 4 => "Vé máy bay",
   // 5 => "Xe du lịch",
   // 6 => "Hộ chiếu",
   // 7 => "Hướng dẫn viên"
);
//Thời gian lấy làm mốc để tính thời gian khởi hành của vé tàu xe (Vì thời gian khởi hành chỉ lưu theo phút)
/** Tuyệt đối ko được sửa giá trị date_ticket này **/
$date_ticket = "20/04/2012";
//Mảng các hình thức giảm tiền khi đặt phòng
// $array_type_discount = array(
//    DISCOUNT_BANK             => "TT ngân hàng qua Onepay",
//    DISCOUNT_VOUCHER          => "Mã voucher",
//    DISCOUNT_1068             => "Đại lý",
//    DISCOUNT_REGISTER         => "Đăng ký 12/2012",
//    DISCOUNT_ACCOUNT_MONEY    => "Tài khoản user",
//    DISCOUNT_DEAL             => "Điểm thưởng DEAL",
//    DISCOUNT_1K_CAMPAIN       => "Giảm trừ chương trình 1K",
//    DISCOUNT_VOUCHER_CHECKOUT => "Voucher giảm trừ tiền khi checkout",
//    DISCOUNT_11_11_2013       => "Giảm trừ trực tiếp 20%"
// );

//Array ly do that bai don dat phong -- Luu y: Khong duoc phep thay doi
// $array_fail = array(
//    0   => "-Chọn lý do thất bại-"
//    ,1  => "Same booking (Trùng)"
//    ,11 => "Loop booking (Lặp)"
//    ,2  => "Unreal booking (Ảo)"
//    ,3  => "Last minute (Đặt gấp)"
//    ,4  => "Out of room (Hết phòng)"
//    ,5  => "Test (IT test)"
//    ,6  => "Cancelled booking (Khách hủy)"
//    ,7  => "Other (Khác)"
//    ,8  => "Khách đổi khách sạn"
//    ,9  => "Sai giá khách sạn"
//    ,10 => "Giá cao hơn đối thủ"
//    ,12 => "Khách sạn không hợp tác"
//    ,13 => "Booking ngoài giờ làm việc"
//    ,14 => "Vấn đề thanh toán"
//    ,15 => "Hết phòng: OOR Last minute"
//    ,16 => "Hết phòng: OOR Thường"
//    ,17 => "Booking Fail OTA"
// );
//Thời gian cho phép sửa thông tin phòng sau khi chuyển sang thành công
$time_limit_edit = 86400;

//Chi nhánh
// $arr_branch = array(
//    BRANCH_HN   => "Hà Nội",
//    BRANCH_HCM  => "Hồ Chí Minh"
// );

// $array_debug_ip = array(MY_IP);
/** DEBUG ALLOW **/
$debug_allow = 0;
if (($_SERVER["SERVER_NAME"] == 'dev.mytour.vn' && in_array($_SERVER['REMOTE_ADDR'], $array_debug_ip)) || $_SERVER["SERVER_ADDR"] == '127.0.0.1') {
   $debug_allow = 1;
}
//Array Cac method payment online
// $array_payment_online = array(PAYMENT_ONLINE, PAYMENT_BANK, PAYMENT_ONLINE_BK);
//Mảng chứa những admin user kế toán
// $group_accountancy = 2048;
// $array_accountancy = array();
// $db_select = new db_query("SELECT adm_id FROM admin_user
//    WHERE adm_group >= $group_accountancy AND adm_group & $group_accountancy");
// while ($row = mysql_fetch_assoc($db_select->result)) {
//    $array_accountancy[] = intval($row['adm_id']);
// }
// unset($db_select);
// $array_accountancy[] = 101;
//print_r($array_accountancy);

//Danh sách admin kế toán lấy từ mảng phía trên
// $list_accountancy = implode(",", $array_accountancy);

// if ($list_accountancy == '') $list_accountancy = '-1111';

//Module booking
// $arr_module_booking = array(
//    MODULE_HOTEL  => array(
//       'table'  => 'booking_hotel',
//       'prefix' => 'boo_',
//       'folder' => 'booking_hotel'
//    ),
//    MODULE_DEAL   => array(
//       'table'  => 'booking_deal',
//       'prefix' => 'bod_',
//       'folder' => 'booking_deal'
//    ),
//    MODULE_TICKET => array(
//       'table'  => 'booking_ticket',
//       'prefix' => 'boot_',
//       'folder' => 'booking_ticket'
//    ),
//    MODULE_TOUR   => array(
//       'table'  => 'tour_booking',
//       'prefix' => 'tbo_',
//       'folder' => 'booking_tour'
//    )
// );

//Moc thoi gian bat dau thay doi cach tinh tien
$time_0307 = strtotime('07/03/2013 11:00');

//Thời gian bắt đầu tính doanh số theo cách: Tháng nào ko thu tiền mà phải thanh toán cho KS thì trừ lãi
$time_november = strtotime('11/01/2013');
//Thoi gian thay doi cach tinh doanh so lan thu (Cha nho lan thu may)
$time_0101 = strtotime('01/01/2014');

//Cac thong so cua viec tinh revenue
$arr_revenue_info = array(
   'commission'       => 0,
   'received'         => 0,
   'payed'            => 0,
   'fee'              => 0,
   'total_change'     => 0,
   'supplier_change'  => 0,
   'fee_change'       => 0,
   'time'             => 0,
   'total_money'      => 0,
   'supplier_money'   => 0,
   'discount'         => 0,
   'partner_discount' => 0,
   'partner_id'       => 0,
   'module'           => 0,
   'id'               => 0,
   'code'             => '',
   'branch'           => 1,
   'case'             => '',
   'received_all'     => 0,
   'payed_all'        => 0,
   'comission_last'   => 0,
   'admin_check'      => 0,
   'admin_sale'       => 0
);
//Cac truong hop cua viec tinh doanh so
$arr_case_revenue =  array(
   1 => 'Thu',
   2 => 'XN đại lý',
   3 => 'Chi',
   4 => 'Sửa',
   5 => 'Trả KH',
   6 => 'ĐT ghi nợ'
);
$glb_arr_agent = array(-1 => 'All', 0 => 'Desktop', 1 => 'Mobile');

//Cac kieu thanh toan cho doi tac
//0: Theo tung boooking, 1: Thanh toan theo hàng tháng
// $arr_payment_type_supplier = array(
//    PAY_EACH_BOOKING => 'Từng booking',
//    PAY_MONTHLY      => 'Theo tháng'
// );
?>