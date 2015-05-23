
<div class="container">
	<div class="profile-bottom">
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs profile-bottom-ul">
		    <li class="active"><a href="#tab1" data-toggle="tab">Thông tin cá nhân</a></li>

		    <li ><a href="#tab3" data-toggle="tab">Quản lý bài viết</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane  active" id="tab1">

                <?php include 'view_information_user.php' ?>

		    </div>

		    <div class="tab-pane" id="tab3">

                <?php include 'view_post_manager.php' ?>

            </div>
		  </div>
		</div>
	</div>
</div>


<style type="text/css">


</style>

