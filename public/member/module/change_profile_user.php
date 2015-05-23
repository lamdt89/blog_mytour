<?php
require_once("../../../core/classes/database.php");
require("../../controllers/article.controller.php");
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_name='$name' WHERE mem_id='$mem_id'");

    }
    if($_POST['old_pass'] == ""){
        echo 'Bạn chưa nhập mật khẩu cũ !';
    }else{
        if($_POST['passwd'] == ""){
        echo 'Bạn chưa nhập mật khẩu mới !';
        }else{
            if($_POST['repasswd'] == ""){
                echo 'Vui lòng nhập lại mật khẩu mới !';
            }else{
                $article = new article();
                $old_passwd = $article->fix(md5($_POST['old_pass']));
                $repasswd = $article->fix(md5($_POST['repasswd']));
                $passwd = $article->fix(md5($_POST['passwd']));
                $mem_id = $_POST['mem_id'];
                $ck_pass = new db_query("SELECT * FROM members WHERE mem_id='$mem_id'");
                $record_ck = mysql_fetch_assoc($ck_pass->result);
                if($old_passwd != $record_ck['mem_password']){
                    echo "Mật khẩu cũ không đúng";
                }else{
                    if($passwd != $repasswd){
                        echo "Mật khẩu mới không trùng khớp";
                    }else{
                        $update = new db_query("UPDATE members SET mem_password='$passwd' WHERE mem_id='$mem_id'");
                        echo 'Cập nhập mật khẩu thành công';
                    }
                }
            }
        }
    }
    
    
    // if(isset($_POST['passwd']) && isset($_POST['old_pass']) && isset($_POST['repasswd'])) {
        
    // }else{
    //     echo 'Vui lòng nhập đầy đủ các trường để thực hiện đổi mật khẩu !';
    // }

    if(isset($_POST['birthday'])) {
        $birthday = ($_POST['birthday']);
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_birthdays='$birthday' WHERE mem_id='$mem_id'");
    }
    if(isset($_POST['phone'])) {
        $phone = ($_POST['phone']);
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_phone='$phone' WHERE mem_id='$mem_id'");
    }

    if(isset($_POST['address'])) {
        $address = ($_POST['address']);
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_address='$address' WHERE mem_id='$mem_id'");
    }
    if(isset($_POST['rename'])) {
        $rename = ($_POST['rename']);
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_first_name='$rename' WHERE mem_id='$mem_id'");
    }
    if(isset($_POST['email'])) {
        $email = ($_POST['email']);
        $mem_id = $_POST['mem_id'];
        $update = new db_query("UPDATE members SET mem_email='$email' WHERE mem_id='$mem_id'");
    }
?>