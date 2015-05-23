<?
/**
*class user
*Developed by FinalStyle.com
*/
class user{
	var $use_picture	=	"";
	protected $logged = 0;
	var $use_username;
	var $use_name;
	var $use_email;
	var $use_password;
	var $use_phone;
	var $use_gender;
	var $use_id = -1;
	var $use_face_id = 0;
	var $use_facetoken = "";
	var $use_face = 0;
	var $useField = array();
	/*
	init class
	login_name : ten truy cap
	password  : password (no hash)
	level: nhom user; 0: Normal; 1: Admin (default level = 0)
	*/
	function user($username="",$password=""){
		$checkcookie=0;
		$this->logged = 0;
		if ($username==""){
			if (isset($_COOKIE["login_name"])) $username = $_COOKIE["login_name"];
		}
		if ($password==""){
			if (isset($_COOKIE["PHPSESS1D"])) $password = $_COOKIE["PHPSESS1D"];
			$checkcookie=1;
		}
		else{
			//remove \' if gpc_magic_quote = on
			$password = str_replace("\'","'",$password);
		}

		if ($username=="" && $password=="") return;

		$db_user = new db_query("SELECT use_id,use_username,use_password,use_status,use_name,use_email, use_picture, use_phone, use_gender, use_face_id, use_face, use_facetoken
										 FROM users
										 WHERE use_username = '" . $this->removequote($username) . "' OR use_email = '" . $this->removequote($username) . "'");

		if ($row=mysql_fetch_array($db_user->result)){
			//kiem tra password va use_active
			if($checkcookie == 0)	$password = md5($password);
			if (($password == $row["use_password"] && $row["use_status"] == 1)) {
				$this->logged           = 1;
				$this->use_username 	= $username;
				$this->use_name 		= $row["use_name"];
				$this->use_email		= $row['use_email'];
				$this->use_phone		= $row['use_phone'];
				$this->use_gender		= $row['use_gender'];
				$this->use_picture 	= $row["use_picture"];
				$this->use_password 	= $password;
				$this->use_id 			= intval($row["use_id"]);
				$this->use_face_id 	= intval($row["use_face_id"]);
				$this->use_facetoken = $row["use_facetoken"];
				$this->use_face 		= intval($row["use_face"]);
				$this->useField  		= $row;
			}
		}
		unset($db_user);

	}
	/*
	Ham lay truong thong tin ra
	*/
	function row($field){
		if(isset($this->useField[$field])){
			return $this->useField[$field];
		}else{
			return '';
		}
	}
	/*
	save to cookie
	time : thoi gian save cookie, neu = 0 thi` save o cua so hien ha`nh
	*/
	function savecookie($time=0){
		if ($this->logged!=1) return false;
		if ($time > 0){
			setcookie("login_name",$this->use_username,time()+$time,"/");
			setcookie("PHPSESS1D",$this->use_password,time()+$time,"/");
		}
		else{
			setcookie("login_name",$this->use_username,null,"/");
			setcookie("PHPSESS1D",$this->use_password,null,"/");
			//setcookie("u_id",$this->u_id);
		}
	}

	function fake_login_openid($email, $name = "", $uid = 0, $token){
		if($email == "") return '';
		//$email		=	replaceMQ($email);
		$db_select 	= new	db_query("SELECT use_username,use_email,use_password, use_face
										 FROM users
										 WHERE (use_username = '" . $email . "' OR use_email = '" . $email . "')
										 LIMIT 1");
		if($row = mysql_fetch_assoc($db_select->result)){
			setcookie("login_name", $row["use_username"], null, "/");
			setcookie("PHPSESS1D", $row["use_password"], null, "/");
			if ($row['use_face'] == 1) {
				$db_ex = new db_execute("UPDATE users SET use_face_id = '".intval($uid)."', use_facetoken = '".$token."' WHERE use_username = '".$email."' OR use_email = '".$email."'");
				$this->use_face_id 	= intval($uid);
				$this->use_facetoken = $token;
			}

		}else{
			$password = md5(rand(11111,99999));
			$db_ex = new db_execute("INSERT INTO users(use_username,use_email,use_name,use_password,use_face_id,use_face,use_status)
											 VALUES('" . $email . "','" . $email . "','" . $name . "','" . $password . "'," . $uid . ",1,1)");
			unset($db_ex);

			$this->use_email		= $email;
			$this->use_name		= $name;
			$this->use_password	= $password;
			$this->use_face_id 	= intval($uid);
			$this->use_face 		= 1;
			$this->use_facetoken = $token;


			setcookie("login_name", $email, null, "/");
			setcookie("PHPSESS1D", $password, null, "/");

		}

	}

	/*
	Logout account
	*/
	function logout(){
		setcookie("login_name"," ",null,"/");
		setcookie("cucre_city"," ",null,"/");
		setcookie("PHPSESS1D"," ",null,"/");
		$_COOKIE["login_name"] = "";
		$_COOKIE["cucre_city"] = "";
		$_COOKIE["PHPSESS1D"] = "";
		//setcookie("u_id","",time()-200000);
		$this->logged=0;
	}
	//kiem tra password de thay doi email
	function check_password($password){
		$db_user = new db_query("SELECT use_password,use_security
										 FROM users, user_group
										 WHERE use_group = group_id AND use_active=1 AND use_login = '" . $this->removequote($this->use_username) . "'");
		if ($row=mysql_fetch_array($db_user->result)){
			$password=md5($password . $row["use_security"]);
			if($password==$row["use_password"]) return 1;
		}
		unset($db_user);
	}
	function logged(){
		return $this->logged;
	}
	/*
	Remove quote
	*/
	function removequote($str){
		$temp = str_replace("\'","'",$str);
		$temp = str_replace("'","''",$temp);
		return $temp;
	}

	/*
	check_user_level: Kiem tra xem User co thuoc nhom Admin hay khong. Mac dinh User thuoc nhom Normal.
	table_name: ten bang (Ex; Users)
	data_field: ten truong trong bang (Ex; use_level)
	data_level_value: Gia tri cua use_level (0: Normal member; 1: Admin member)
	where_clause: Dieu kien them
	dump_query: In cau lenh ra man hinh. (0: No; 1: Yes)
	*/
	function check_user_level($table_name,$data_field,$data_level_value,$where_clause="",$dump_query=0){
		if ($this->logged!=1) return 0;
		$level = "SELECT " . $data_field . "
					  FROM " . $table_name . "
					  WHERE " . $data_field . "=" . intval($data_level_value) . " " . $where_clause;
		//Dum_query
		if ($dump_query==1) echo $level;
		//kiem tra query
		$db_check_level = new db_query($level);
		//Check record > 0
		if (mysql_num_rows($db_check_level->result) > 0){
			unset($db_check_level);
			return 1;
		}
		else{
			unset($db_check_level);
			return 0;
		}
	}

	/*
	check_data_in_db : Kiem tra xem data hien thoi co phai thuoc user ko (check trong database)
	table_name : ten table
	data_id_field : Truong id vi du : new_id
	data_id_value : gia tri cua id vi du : 10
	user_id_field : ten truong user_id cua bang do vi du : new_userid, pro_userid....
	where_clause : cua query them va`o sau where vi du : new_approved = 1...
	dump_query : co hien thi query hay ko de debug loi. 0 : ko hien, 1: hien thi
	*/
	function check_data_in_db($table_name,$data_id_field,$data_id_value,$user_id_field,$where_clause="",$dump_query=0){
		if ($this->logged!=1) return 0;
		$my_query =  "SELECT " . $data_id_field . "
					  FROM " . $table_name . "
					  WHERE " . $data_id_field . "=" . $data_id_value . " AND " . $user_id_field . "=" . intval($this->use_id) . " " . $where_clause;

		//neu dump_query = 1 thi in ra ma`n hinh
		if ($dump_query==1) echo $my_query;

		//kiem tra query
		$db_check = new db_query($my_query);
		//neu ton tai record do thi` tra ve gia tri 1, neu ko thi` tra ve gia tri 0
		if (mysql_num_rows($db_check->result) > 0){
			unset($db_check);
			return 1;
		}
		else{
			unset($db_check);
			return 0;
		}
	}

	/*
	check_data : kiem tra xem data co phai thuoc user_id khong (check trong luc fetch_array)
	user_id : gia tri user id để so sánh
	*/
	function check_data($user_id){
		if ($this->logged!=1) return 0;
		if ($this->use_id != $user_id) return 0;
		return 1;
	}

	/*
	change password : Sau khi change password phải dùng hàm save cookie. Su dung trong truong hop Change Profile
	*/
	function change_password($old_password,$new_password){
		//replace quote if gpc_magic_quote = on
		$old_password = str_replace("\'","'",$old_password);
		$new_password = str_replace("\'","'",$new_password);

		//chua login -> fail
		if ($this->logged!=1) return 0;
		//old password ko đúng -> fail
		if (md5($old_password)!=$this->use_password) return 0;

		//change password
		$db_update = new db_execute("UPDATE users
									 SET use_password = '" . md5($new_password). "'
									 WHERE use_id = " . intval($this->use_id));
		//reset password
		$this->use_password = md5($new_password);
		  setcookie("PHPSESS1D",$this->use_password,null,"/");
		return 1;
	}

	/*
	check user access
	*/

	function check_access($right_list,$id_value=0){
		$right_array = explode(",",$right_list);
		//lap trong right_list de tim quyen (right)
		//print_r($this->user_right_name_array);

		for ($i=0;$i<count($right_array);$i++){
			//neu user_right_name_array ma bang rong tuc la khong co quyen nao ca thi return 0
			if(!is_array($this->user_right_name_array)) return 0;
			//Tim thay quyen cua trong right list
			//if (strpos($this->user_right_list,$right_array[$i])!==false){
			//Tim trong array

			$key = array_search($right_array[$i], $this->user_right_name_array);
			//co ton tai

			if ($key!==false){
				//eval global variable
				global $$right_array["$i"];
				$temp = $$right_array["$i"];
				//Kiem tra xem bien dc eval co ton tai khong
				if (!isset($temp)) { echo "<b>Variable " . $right_array["$i"] . " is undefined. </b><br>"; return 0;}

				//Neu co soluong va` action ko phai fullaccess thi` kiem tra so luong
				if ($this->user_right_quantity_array[$key]!=0 && $temp["action"]!="fullaccess" ){
					//gan query
					$sql = "SELECT count(*) as count
							FROM " . $temp["table_name"] . "
							WHERE " . $temp["user_id_field"] . "=" . $this->use_id . " ";
					//echo $sql;
					//neu action = change value them sql
					if ($temp["action"]=="changevalue") $sql.= " AND " . $temp["change_field"] . "= 1 ";

					//neu id them va`o khac 0 thi` loai bo id khoi cau lenh sql
					if ($id_value!=0) $sql.=" AND " . $temp["id_field"] . "<>" . $id_value;

					//Execute SQL
					$db_sum = new db_query($sql);
					$row = mysql_fetch_array($db_sum->result);
					unset($db_sum);

					//Kiem tra count neu nho hon gia tri cho phep thi` return 1
					if ($row["count"] < $this->user_right_quantity_array[$key]) return 1;

				}
				else{
					return 1;
				}
			}
		}
		return 0;
	}
}
?>
<?
/*
defined right
Bao gom cac thong so sau :
right gom co :  insert : Them 1 ban ghi moi,
				update : Sua chua ban ghi,
				delete : Xoa ban ghi,
				changevalue : Sua 1 column (field) na`o day trong ban ghi, vi du : hot, news, approver
				fullaccess : Admin 1 muc nao do
*/
$right_list = array("right_admin_catalogue");
/*
Defined right detail
*/
//Right admin user access module Blogs
$right_admin_catalogue = array("table_name"             =>  "",
									"id_field"       		=>  "",
								 "user_id_field"  		=>  "",
									"change_field"			=>  "",
									"action"		    	=>  "fullaccess",
									"quantity"				=>  "",
									"description"			=>  "Admin module Catalogue",
									"name"					=>  "right_admin_catalogue");
?>