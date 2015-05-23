<script src="themes/js/jquery.min.js"></script>
<script src="themes/js/jquery.form.js"></script>
<script>

</script>
<?php while($row = mysql_fetch_assoc($user->result)) :?>
<div class="content profile">
    <div class="col-md-2">
    <?
    if($row['mem_avatar']==""){ 
        $ava_img =  'themes/images/DefaultImage.gif';
    }else{ 
        $ava_img = 'uploads/images/users/'.$row['mem_avatar'];
    }
    ?>
        <div class="img-avatar"> <img class="img-responsive" id="avatar" src="http://<?=$_SERVER['HTTP_HOST']?>/<?=$ava_img?>" alt=""/></div>
        <a href="#" class="align change-avatar">
            <form id="imageform" method="post" enctype="multipart/form-data" action='public/member/module/change_avatar_user.php'>
                <span class="btn btn-default btn-file" style="border: none !important;">
                    <i class="fa fa-pencil"></i> Thay đổi <input type="file" name="photoimg" id="photoimg">
                </span>
            </form>
        </a>
        <div id='preview'>
        </div>

    </div>
    <div class="col-md-10">
        <table width="100%">
            <input type="hidden" class="mem_id" value="<?=$row['mem_id'];?>"/>
            <tr class="bg-tr-1">
                <td width="200px;" class="padding-left">Tên hiển thị : </td>
                <td> <b><input type="text" maxlength="255" size="50" id="inp-name" name="name" disabled="disabled" value="<?=$row['mem_name']?>" class="inp-profile inp-name" onkeyup="CheckKeyShowName(event)" /></b></td>
                <td><a href="#" class="a-name">Thay đổi</a></td>

            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Mật khẩu :</td>
                <td>
                    <input type="password" id="inp-oldpasswd" name="oldpasswd"  disabled="disabled" value="" class="inp-profile inp-passwd" placeholder="Mật khẩu cũ" onkeyup="CheckKeyChangePass(event)" style="width: 200px!important; height: 30px!important;margin: 5px 0 0px 0;float: left;padding: 0px 0 0px 5px;line-height: normal;"/>
                    <input type="password" id="inp-passwd" name="passwd"  disabled="disabled" value="" class="inp-profile inp-passwd" placeholder="Mật khẩu mới" onkeyup="CheckKeyChangePass(event)" style="width: 200px!important; height: 30px!important;margin: 5px 0 0px 0;float: left;padding: 0px 0 0px 5px;line-height: normal;"/>
                    <input type="password" id="inp-repasswd" name="repasswd"  disabled="disabled" value="" class="inp-profile inp-passwd" placeholder="Nhập lại mật khẩu" onkeyup="CheckKeyChangePass(event)" style="width: 200px!important; height: 30px!important;margin: 5px 0 0px 0;float: left;padding: 0px 0 0px 5px;line-height: normal;"/>
                </td>
                <td><a href="#" class="a-passwd">Thay đổi</a></td>

            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Email :</td>
                <td>
                    <b><input type="email" maxlength="255" size="50" id="inp-email" required name="email" disabled="disabled" value="<?=$row['mem_email']?>" class="inp-profile inp-email" onkeyup="CheckKey(event)"/></b>
                <td><a href="#" class="a-email">Thay đổi</a></td>
            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Họ và tên :</td>
                <td>
                    <b><input type="text" maxlength="255" size="50" id="inp-rename" name="rename" disabled="disabled" value="<?=$row['mem_first_name']?>" class="inp-profile inp-rename" onkeyup="CheckKeyName(event)"/></b>

                </td>
                <td><a href="#" class="a-rename">Thay đổi</a></td>

            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Ngày sinh :</td>
                <td><b><input type="text" id="inp-birthday" maxlength="10" size="50" disabled="disabled" value="<?=$row['mem_birthdays']?>" class="inp-profile" onkeyup="CheckKeyDOB(event)"/></b></td>
                <td><a href="#" class="a-birthday">Thay đổi</a></td>
            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Số điện thoại :</td>
                <td><b><input type="text" id="inp-phone" maxlength="11" size="50" disabled="disabled" value="<?=$row['mem_phone'];?>" class="inp-profile" onkeyup="CheckKeyPhone(event)"/></b></td>
                <td><a href="#" class="a-phone">Thay đổi</a></td>
            </tr>
            <tr class="bg-tr-1">
                <td class="padding-left">Địa chỉ :</td>
                <td><b><input type="text" id="inp-address" maxlength="255" size="50" disabled="disabled" value="<?=$row['mem_address']?>" class="inp-profile" onkeyup="CheckKeyAddress(event)"/></b></td>
                <td><a href="#" class="a-address">Thay đổi</a></td>
            </tr>
        </table>


    </div>
</div>
<?php endwhile; ?>
<script type="text/javascript">
    function CheckKey(e){
    var code = e.keyCode ? e.keyCode : e.which;
    var email = $("#inp-email").val();
    var mem_id = $(".mem_id").val();
        if(code === 13){
           $.ajax({
                    type: "POST",
                    url: "public/member/module/change_profile_user.php",
                    data: "email="+email+"&mem_id="+mem_id,
                    success:function(result) {
                        alert("Cập nhập email thành công");
                        window.location.reload();
                    }
                });
        }
    }
    function CheckKeyPhone(e) {
        var keycode = e.keyCode ? e.keyCode : e.which;
        var phone = $("#inp-phone").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {

            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: "phone="+phone+"&mem_id="+mem_id,
                success:function(result) {
                    alert("Cập nhập số điện thoại thành công");
                    window.location.reload();
                }
            });
        }
    }
    function CheckKeyAddress(e){
        var keycode = e.keyCode ? e.keyCode : e.which;
        var address = $("#inp-address").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {

            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: "address="+address+"&mem_id="+mem_id,
                success:function(result) {
                    alert("Cập nhập địa chỉ thành công");
                    window.location.reload();
                }
            });
        }
    }
    function CheckKeyName(e){
        var keycode = e.keyCode ? e.keyCode : e.which;
        var rename = $("#inp-rename").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {

            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: "rename="+rename+"&mem_id="+mem_id,
                success:function(result) {
                    alert("Cập nhập tên thành công");
                    window.location.reload();
                }
            });
        }
    }
    function CheckKeyDOB(e){
        var keycode = e.keyCode ? e.keyCode : e.which;
        var birthday = $("#inp-birthday").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {

            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: "birthday="+birthday+"&mem_id="+mem_id,
                success:function(result) {
                    alert("Cập nhập ngày sinh thành công");
                    window.location.reload();
                }
            });
        }
    }
    function CheckKeyChangePass(e){
        var keycode = e.keyCode ? e.keyCode : e.which;
        var oldpasswd = $("#inp-oldpasswd").val();
        var passwd = $("#inp-passwd").val();
        var repasswd = $("#inp-repasswd").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {
            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: {
                    repasswd: repasswd,
                    mem_id:mem_id,
                    old_pass:oldpasswd,
                    passwd:passwd
                },
                success:function(result) {
                    if(result == 'Cập nhập mật khẩu thành công' ){
                        alert('Cập nhập mật khẩu thành công');
                        window.location.reload();
                    }else{
                        alert(result)
                    }
                }
            });
        }
    }
    function CheckKeyShowName(e){
        var keycode = e.keyCode ? e.keyCode : e.which;
        var name = $("#inp-name").val();
        var mem_id = $(".mem_id").val();
        if(keycode === 13) {
            
            $.ajax({
                type: "POST",
                url: "public/member/module/change_profile_user.php",
                data: "name="+name+"&mem_id="+mem_id,
                success:function(result) {
                    alert("Cập nhập tên hiển thị thành công");
                    window.location.reload();
                }
            });
        }
    }
</script>