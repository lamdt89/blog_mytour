<?
	if(isset($_SESSION["ses_mem_id"])){
		redirect("http://".$_SERVER['HTTP_HOST']."/profile");
	}else{
		$fs_errorMsg = "";
		$ten = "";
		$mail = "";
		$dt= "";
		$new_pas = "";
		$show_new_pass = "hide";
		if(getValue("login_name","str","POST") == ""){
			$fs_errorMsg .= "&bull; Bạn chưa nhập tên đăng nhập ! <br/>";
		}else{
			if(getValue("email_rs","str","POST") == ""){
				$fs_errorMsg .= "&bull; Bạn chưa nhập địa chỉ email ! <br/>";
			}else{
				if(getValue("phone_rs","str","POST") == ""){
					$fs_errorMsg .= "&bull; Bạn chưa nhập số điện thoại ! <br/>";
				}
			}
		}
		
		
		$submitform    =  getValue("reset_password", "str", "POST","");
		if($submitform == "Lấy mật khẩu"){
			$ten = getValue("login_name","str","POST");
			$mail = getValue("email_rs","str","POST");
			$dt = getValue("phone_rs","str","POST");
			$sql = "SELECT * FROM members WHERE mem_login = '".$ten."'";
			$ck_account = new db_query($sql);
			$rs_record = mysql_fetch_assoc($ck_account->result);
			if($rs_record == true){
				if( ($dt != "") && ($rs_record['mem_email'] != $mail)){
					$fs_errorMsg .= "&bull; Địa chỉ email không chính xác ! <br/>";
				}else{
					if( ($dt != "") && ($rs_record['mem_phone'] != $dt)){
						$fs_errorMsg .= "&bull; Số điện thoại không chính xác ! <br/>";
					}
				}
			}else{
				$fs_errorMsg .= "&bull; Tên đăng nhập không chính xác ! <br/>";
			}	
			if($fs_errorMsg == ""){
				$new_pas = random();
				$sql_update = new db_query("UPDATE members SET mem_password = '".md5($new_pas)."' WHERE mem_id = ".$rs_record['mem_id'] );
				unset($sql_update);
				$show_new_pass = "show";
				$ten = "";
				$mail = "";
				$dt= "";
			}
		}
	}
?>