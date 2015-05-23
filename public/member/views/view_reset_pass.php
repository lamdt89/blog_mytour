<div class="container">
	<div class="author-profile">
		<div class="col-md-12 author-bottom">
			<div class="author-content">
				<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs profile-bottom-ul">
				    <li class="active"><a href="#tab1" data-toggle="tab">Quên mật khẩu</a></li>
				  </ul>
				  
				    <div class="tab-pane  active" id="tab1">
				    	<div class="nearly_activity rs_pass">
				    		<h4>Vui lòng nhập đầy đủ các trường để tiến hành lấy lại mật khẩu</h4>
				    		<div class="box_new_pass <?=$show_new_pass?>">
				    			<label>Khôi phục mật khẩu thành công ^-^!</label>
				    			<label>Bạn có thể đăng nhập tài khoản của mình với mật khẩu : <b class="xanh"><?=$new_pas?></b></label>
				    		</div>
				    		<?
				                $form = new form();
				                
				            ?>
				            <p style="float: left;width: 100%;"><?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?></p>
				            <span style="text-align: left;">
				            	<?=$form->errorMsg($fs_errorMsg)?>
				            </span>
				    		<form name="reset_pas" action="" method="POST" >
				    		<table align="center" class="tb_reset_pas">	
				    			<tr>
				    				<td><label> Tên đăng nhập <font class="form_asterisk">*</font>:</label></td>
				    				<td><input value="<?=$ten?>" type="text" name="login_name" placeholder="Nhập tên đăng nhập" class="inp_reset_pas"></td>
				    			</tr>
				    			<tr>
				    				<td><label> Email <font class="form_asterisk">*</font>:</label></td>
				    				<td><input value="<?=$mail?>" type="text" name="email_rs" placeholder="Nhập địa chỉ email tài khoản của bạn" class="inp_reset_pas"></td>
				    			</tr>
				    			<tr>
				    				<td><label> Số điện thoại <font class="form_asterisk">*</font>:</label></td>
				    				<td><input value="<?=$dt?>" type="text" name="phone_rs" placeholder="Nhập số điện thoại tài khoản của bạn" class="inp_reset_pas" maxlength="13"></td>
				    			</tr>
				    			<tr>
				    				<td></td>
				    				<td>
				    					<input class="btn btn-primary btnvote" type="submit" value="Lấy mật khẩu" name="reset_password">
				    					<input class="btn btn-primary btnvote" type="reset" value="Nhập lại" name="reset_form" style="margin-left: 10px;">
				    				</td>
				    			</tr>
				    		</table>
				    		</form>
				    	</div>
				    </div>
				  
				</div>
			</div>
		</div>
	</div>
</div>
<style>

</style>