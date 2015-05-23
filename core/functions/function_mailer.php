<?
////////////////////////////////////////////////
// Ban khong thay doi cac dong sau:
function send_mailer($to,$title,$content, $FromName = "",$id_error=""){
	global $con_gmail_name;
	global $con_gmail_pass;
	global $con_gmail_subject;
	global $con_admin_email;
	//*	
	$header  = 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$header .= 'From: admin@123tv.vn <admin@123tv.vn>' . "\r\n";
	//*/	
	$class_path = dirname(__FILE__);
	if(file_exists(str_replace("functions","classes",$class_path) . "/mailer/class.phpmailer.php")){
		require_once(str_replace("functions","classes",$class_path) . "/mailer/class.phpmailer.php");
	}
	
	$mail_server	=	"";
	$user_name		=	"";
	$password		=	"";
	
	
	//Lấy account mail có lần gửi ít nhất	
		
	$mail_server 	= "smtp.gmail.com";
	$user_name		= "phuongdm1987@gmail.com";
	$password		= "m1nhphu0n9";
	
	/*$db_select 		=	new db_query("SELECT *
											  FROM mails_account
											  WHERE mac_active = 1
											  ORDER BY mac_time_sent ASC
											  LIMIT 1");
 	if($row = mysql_fetch_assoc($db_select->result)){
		$mail_server 	= $row["mac_mail_server"];
		$user_name		= $row["mac_email"];
		$password		= $row["mac_password"];
		//update vao bang mails account
		$db_ex = new db_execute("UPDATE mails_account SET mac_time_sent = " . time() . " WHERE mac_id = " . intval($row["mac_id"]));
		unset($db_ex);
	}*/
	//$mail_server 	= "smtp.gmail.com";
	//$user_name		= "mysite201001@gmail.com";
	//$password		= 'toan!@#$%^';
	/*
	echo $mail_server . "<br>";
	echo $user_name . "<br>";
	echo $password . "<br>";
	*/
	
	//bắt đầu thực hiện gửi mail
	$mail 					= new PHPMailer();
	$mail->IsSMTP();
	//$mail->SMTPDebug		=	true;
	$mail->Host     		= $mail_server;
	$mail->SMTPAuth 		= true;
	$mail->CharSet 			= "UTF-8";
	$mail->ContentType		= "text/html";
	
	
	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	
	$mail->Username = $user_name;				// SMTP username
	$mail->Password = $password; 				// SMTP password
	
	$mail->From     = 'phuongdm1987@gmail.com';				// Email duoc gui tu???
	$mail->FromName = 'BQT website 123tv.vn';			// Ten hom email duoc gui
	/*$to_array = split(",",$to);
	for ($i=0; $i<count($to_array); $i++){
		$mail->AddAddress($to_array[$i],"Admin");	 	// Dia chi email va ten nhan
	}*/
	$mail->AddAddress($to);
	$mail->AddReplyTo("phuongdm1987@gmail.com","Information");		// Dia chi email va ten gui lai
	//$mail->SMTPDebug		=	true;
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;				// Chu de email
	$mail->Body     =  $content;			// Noi dung html
	//$mail->AddAttachment("../cv_stores/", "a.doc");
	
	//Nếu là google mail
	if ($mail->Host == "smtp.gmail.com" || $mail->Host == "smtp.bizmail.yahoo.com"){
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Port       = 465;                   // set the SMTP port
		//$mail->MsgHTML($content);
	}
	//var_dump($mail);
	//die();
	if(!$mail->Send())
	{
		//Nếu không send được thì thử lại với account khác, chỉ thử lại max đến 2 lần là dừng lại
		//strlen($id_error) <= 3 - Ứng với 1 lần retry
		if (strlen($id_error) <= 3){
			///send_mailer($to, $title, $content, $id_error);
		}
		//echo "Loi: " . $mail->ErrorInfo;
		//*
		//echo "Email chua duoc gui di! <p>";
		//echo "Loi: " . $mail->ErrorInfo;
		//*/
		//exit;
		return false;
	}else{
		//trường hợp mail gửi thành công
		
		//echo $user_name . "<br>";
		//echo "Email da duoc gui!";
		return true;
	}
}

//require_once("../classes/database.php");
//send_mailer("dinhtoan1905@gmail.com","chu de gui di","Cộng hòa xã hội chủ nghĩa Việt Nam <b>Xin chào các bạn</b><br><br>Cúc cu xin chào các bạn");

function generate_content($content,$array = array()){
	foreach($array as $key=>$value){
		$content = str_replace("{#" . $key . "#}",$value,$content);
	}
	return $content;
}

function send_mailer_spam($to,$title,$content, $FromEmail = "", $FromName = 'LươngCao.com (chuyên trang tuyển dụng)',$id_error=""){
	global $con_gmail_name;
	global $con_gmail_pass;
	global $con_gmail_subject;
	global $con_admin_email;
	//*	
	$header  = 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$header .= 'From: ' . $FromEmail . ' <' . $FromEmail . '>' . "\r\n";
	//*/	
	$class_path = dirname(__FILE__);
	if(file_exists(str_replace("functions","classes",$class_path) . "/mailer/class.phpmailer.php")){
		require_once(str_replace("functions","classes",$class_path) . "/mailer/class.phpmailer.php");
	}
	
	$mail_server	=	"";
	$user_name		=	"";
	$password		=	"";
	
	$mail_server 		= "smtp.gmail.com";
	$user_name			= "";
	$password			= '';
	/*
	echo $mail_server . "<br>";
	echo $user_name . "<br>";
	echo $password . "<br>";
	*/
	
	//bắt đầu thực hiện gửi mail
	$mail 					= new PHPMailer();
	$mail->IsSMTP();
	//$mail->SMTPDebug		=	true; echo '<br>' . $user_name;
	$mail->Host     		= $mail_server;
	$mail->SMTPAuth 		= true;
	$mail->CharSet 			= "UTF-8";
	$mail->ContentType		= "text/html";
	
	
	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	
	$mail->Username = $user_name;				// SMTP username
	$mail->Password = $password; 				// SMTP password
	
	$mail->From     = $user_name;				// Email duoc gui tu???
	$mail->FromName = $FromName;			// Ten hom email duoc gui
	$to_array = split(",",$to);
	for ($i=0; $i<count($to_array); $i++){
		$mail->AddAddress($to_array[$i],"Admin");	 	// Dia chi email va ten nhan
	}
	//$mail->AddReplyTo("vatgia@truonghocso.com","Information");		// Dia chi email va ten gui lai
	
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;				// Chu de email
	$mail->Body     =  $content;			// Noi dung html
	//$mail->AddAttachment("../cv_stores/", "a.doc");
	
	//Nếu là google mail
	if ($mail->Host == "smtp.gmail.com" || $mail->Host == "smtp.bizmail.yahoo.com"){
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Port       = 465;                   // set the SMTP port
		//$mail->MsgHTML($content);
	}
	if(!$mail->Send())
	{
		//Nếu không send được thì thử lại với account khác, chỉ thử lại max đến 2 lần là dừng lại
		//strlen($id_error) <= 3 - Ứng với 1 lần retry
		if (strlen($id_error) <= 3){
			///send_mailer($to, $title, $content, $id_error);
		}
		//echo "Loi: " . $mail->ErrorInfo;
		//*
		//echo "Email chua duoc gui di! <p>";
		//echo "Loi: " . $mail->ErrorInfo;
		//*/
		//exit;
		return false;
	}else{
		//trường hợp mail gửi thành công
		
		//echo $user_name . "<br>";
		//echo "Email da duoc gui!";
		return true;
	}
}
?>