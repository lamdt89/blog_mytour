<? 
    require_once("../require.php");
      $u = "";
      $p = "";
      if(isset($_POST['btnLogin'])){
         $article = new article();
         $u = $article->fix($_POST['username']);
         $p = $article->fix(md5($_POST['password']));
         $sql2="SELECT *,count(*) as count FROM members WHERE mem_login='".$u."' and mem_password='".$p."'";              
         $count_record = new db_count($sql2);         
         if($count_record->total != 0){
            $sql2 .= " AND mem_active=1";
            $check = new db_query($sql2);                   
            $data =  mysql_fetch_assoc($check->result);
            if($data['mem_active'] == 0){
               echo "<script>alert('Tài khoản của bạn chưa được kích hoạt !');</script>";
            }else{
               
               $_SESSION['ses_mem_name']=$data['mem_name'];
               $_SESSION['ses_mem_avatar']=$data['mem_avatar']; 
               $_SESSION['ses_mem_id']=$data['mem_id'];
               $_SESSION['ses_dep_id']=$data['mem_dep_id'];

               echo "<script>window.location.href='". $_SERVER['REQUEST_URI'] ."'</script>";
            }
         }else{                  
            echo "<script>alert('Tài khoản hoặc mật khẩu không đúng !');</script>";
         }
      }
     
?>


<nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0px;">
   <div class="container" style="padding: 0px 15px 0 0px;"> 

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a href="/"><img src="http://<?=$_SERVER['HTTP_HOST']?>/themes/images/Untitled-2.png" class="img_logo"></a>
<!--          <a href="index.php"><img src="themes/images/Untitled-2.png" class="img_logo"></a> -->
      </div>
            
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
         <form method="GET" name="sform" id="sform" action="http://<?=$_SERVER['HTTP_HOST']?>/search" autocomplete="off">
            <div class="navbar-form navbar-left" role="search">
               <div class="input-group custom-search-form">
                  <input type="text" class="form-control" value="<? if(isset($_GET['q'])){ echo replace_keyword_search($_GET['q']);} ?>" placeholder="Tìm kiếm..." id="stext" name="q">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                  </button>
                  </span>
               </div><!-- /input-group -->
            </div>
         </form>          
         <ul class="nav navbar-nav">
            
            <?php 
            $check_show = "";
               if(isset($_SESSION['ses_mem_id'])){
                  
                  if($_SESSION['ses_dep_id'] == '11'){  
                     $check_show .= " OR cat_show_menu = 0 OR cat_show_menu = 2";
                  }else{
                     $check_show .= " OR cat_show_menu = 0";
                  }
               }
               
               $db = new db_query("SELECT * FROM categories WHERE  cat_active = 1 AND ( cat_show_menu = 1 ".$check_show." )");
               $data = array();
               while ($arr = mysql_fetch_assoc($db->result)){
                  $data[] = $arr;
               }
               foreach ($data as $value) {
                  if($value['cat_parent_id'] == 0){
                     $article = new article();
                     $pcat = $article->removeTitle($value['cat_name']);
                     echo '<li class="ic"><a href="http://'.$_SERVER['HTTP_HOST'].'/c'.$value['cat_id'].'-'.$pcat.'/">'.$value['cat_name'].'</a><a href="" class="fix dropdown dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>';
                     $id = $value['cat_id'];
                     $article->multimenu($data, $id);
                     echo '</li>';
                  }
               }                       
            ?>              
         </ul>
         <ul class="nav navbar-nav nav-profile">
            <li>
               <?
                  if (!isset($_SESSION['ses_mem_id'])) {

                     echo '<ul class="nav navbar-nav login"><li ><a href="#contact" data-toggle="modal">Đăng nhập</a></li></ul>';
                  }else{
                    $get_avatar = new db_query("SELECT mem_avatar FROM members WHERE mem_id = ".$_SESSION['ses_mem_id']);
                    $ava = mysql_fetch_assoc($get_avatar->result);
               ?>
               <div class="frame_login">   
                  <label class='drop_arr'>
                     <i class='fa fa-sort-asc'></i>
                  </label>
                  <a href='http://<?=$_SERVER['HTTP_HOST']?>/profile'>
                  <?
                  if($ava['mem_avatar']==""){ 
                     $ava_img =  'themes/images/DefaultImage.gif';
                  }else{ 
                     $ava_img = 'uploads/images/users/'.$ava['mem_avatar'];
                  }
                  ?>
                     <img src='http://<?=$_SERVER['HTTP_HOST']?>/<?=$ava_img?>' class='info_member'>
                  </a>
               
                  <div class="drop_control_member">
                     <ul class="nav navbar-nav">
                        <li class="row_info dropdown">
                           <a href="http://<?=$_SERVER['HTTP_HOST']?>/profile" class="txt_row info_pad_top"><i class="fa fa-info-circle"></i>&nbsp;Thông tin tài khoản</a>
                        </li>
                        <li class="row_info dropdown">
                           <a href="http://<?=$_SERVER['HTTP_HOST']?>/post" class="txt_row"><i class="fa fa-pencil-square-o"></i>&nbsp;Viết bài</a>
                        </li>
<!--                         <li class="row_info dropdown">
                           <a href="profile" class="txt_row profile-pw"><i class="fa fa-refresh"></i>&nbsp;Đổi mật khẩu</a>
                        </li> -->
                        <li class="row_info dropdown">
                           <a onclick= "return logout();" href="http://<?=$_SERVER['HTTP_HOST']?>/logout" class="txt_row info_pad_bot"><i class="fa fa-power-off"></i>&nbsp;Thoát</a>
                        </li>
                     </ul>
                  </div>
               </div>
               <?
                  }
               ?> 
            </li>
         </ul>    
      </div><!-- /.navbar-collapse -->
   </div>   
</nav>

<!-- POPUP ĐĂNG NHẬP -->
<div class =" modal fade" id = "contact" role = "dialog" style="top: 100px;">
   <div class = "modal-dialog">
      <div class = "modal-content" style="position: relative; background: #eef1f3;">
         <a style="position:absolute; z-index: 100; top:-6px; right:-13px; cursor: pointer; " data-dismiss = "modal"><img style="width:33px;height:33px;" src="http://<?=$_SERVER['HTTP_HOST']?>/themes/images/iconcls.png"></a>
         <div class = "modal-body">                
            <form class="form-signin" action="" method="POST">
                   <h2 class="form-signin-heading">Xin vui lòng đăng nhập</h2>
                   <label for="inputEmail" class="sr-only">Tên đăng nhập</label>
                   <input style="margin-bottom:20px;" type="text" id="inputEmail" class="form-control" placeholder="Tên đăng nhập" required="" autofocus="" name="username">
                   <label for="inputPassword" class="sr-only">Mật khẩu</label>
                   <input type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required="" name="password">
                   <div class="checkbox">                  
                     <a href="http://<?=$_SERVER['HTTP_HOST']?>/resetpass/" style="float:right;">Quên mật khẩu</a>
                   </div>
                   <button style="width:140px; margin: 0 auto;" class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin">Đăng Nhập →</button>
            </form>           
         </div>
      </div>
   </div>
</div>


<script type="text/javascript" language="Javascript">
   function logout(){
      return confirm("Bạn có muốn đăng xuất không ???");  
   }
   
   $(function(){

      $(".ic").hover(function(){
         // $(this).find('> .submenu').addClass("act");
         $(this).find('> .dropdown-menu').slideDown(100);   
      }, function() {

         $(this).find('> .dropdown-menu').hide();
      });


      $(".c1").hover(function(){
         $(this).find('> .submenu').show("slow");   
      }, function() {
         $(this).find('> .submenu').hide();
      });
   });
</script>