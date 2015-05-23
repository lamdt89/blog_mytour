<? 
   require_once ("../require.php");
   require ("controllers/profile.controller.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Thông tin cá nhân</title>
   <?=$load_header?>
</head>

<body>
   <div id="header">
   <?php
      include '../views/view_header.php';
   ?>       
   </div>

   <!-- end header -->

   <div id="main" class="main-profile" style="background-color: white;">
      <?php
         include 'views/view_profile.php';
      ?>
   </div>

   <!-- end main -->

   <div id="footer">
   <?php
      include '../views/view_footer.php';
   ?> 
   </div>

   <!-- end footer -->

   <?=$load_footer?>

   <!-- add script -->
   <script type="text/javascript" language="JavaScript">
      $(document).ready(function(){

         $('.paging').click(function(){

            $(this).removeClass('btn-default');
            $(this).addClass('btn-primary');
            $(this).siblings().removeClass('btn-primary');
            $(this).siblings().addClass('btn-default');
            var page = $(this).attr('data-page');
            $.ajax({
               url: 'public/views/view_pagination_profile.php',
               type: 'GET',
               data:{
                 page: page,
               },
               success: function(result){
                  //console.log(result);
                  $('.profile-table').html(result);

                  $('.delete').click(function(){
                     if(confirm('Bạn có chắc chắn muốn xóa')) {
                        pos_id = $(this).data("id");
                        $.ajax({
                           url: 'public/article/delete.php',
                           type: 'GET',
                           data: {
                              post: pos_id,
                           },
                           success: function (result) {
                              alert(result);
                              $('#tr-' + pos_id).hide();
                           }
                        });
                     }
                  });

               }
            });
         });
          // change avatar user profile
          $('#photoimg').live('change', function()			{
              $("#preview").html('');
              $("#preview").html('<img src="uploads/images/ajax.gif" alt="Uploading...."/>');
              $("#imageform").ajaxForm({
                  target: '#preview',

              }).submit();
          });

      });
   </script>

</body>

</html>