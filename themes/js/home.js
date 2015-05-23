$(document).ready(function(handler){
    $(".frame_login").hover(function(){
        $('.drop_control_member').addClass('show');
    });
    $(".frame_login").mouseleave(function () {
        $('.drop_control_member').removeClass('show');
    });
    //SyntaxHighlighter.config.clipboardSwf = 'clipboard.swf';

    //giữ thanh menu
    var TopFixMenu = $(".navbar");
    $(window).scroll(function(){
        if($(this).scrollTop()>10){  
        	TopFixMenu.addClass('scroll');
        }else{
            TopFixMenu.removeClass('scroll');
        }
    });

    checkCtrl=false
    $(window).keydown(function(e){
        if(e.keyCode=='17'){
            checkCtrl=true
        }
    }).keyup(function(ev){
        if(ev.keyCode=='17'){
            checkCtrl=false
        }
    }).keydown(function(event){
        if(checkCtrl){
            if(event.keyCode=='67'){
                $('.lines').find('.line .number').html("");
                checkCtrl=false
            }
        }
    });  
    //giữ comment
    // var FixRightComment = $(".cmt_right");
    // $(window).scroll(function(){
    //     if($(this).scrollTop()>900){  
    //         FixRightComment.addClass('scroll_right');
    //     }else{
    //         FixRightComment.removeClass('scroll_right');
    //     }
    //     if($(this).scrollBottom()<300){  
    //         FixRightComment.removeClass('scroll_right');
    //     }
    // });
    // comment in detail
    $("#post_comment").click(function(){

        var text = $("#someTextBox").val();
        var id   = $("#pos_id").val();
        
        var moreText    =  CKEDITOR.instances.postBL.getData();

        if(text !== '' ) {
            $.ajax({
                type: "POST",
                url: "public/article/module/add_comment.php",
                data: "text=" + text + "&pos_id=" + id,
                success: function (result) {
                    window.location.reload();
                }
            })
        } else if (moreText !== '') {
            $.ajax({
                type: "POST",
                url: "public/article/module/add_comment.php",
                //data: "post_cmt=" + moreText + "&pos_id=" + id,
                data: {
                    post_cmt: moreText,
                    pos_id: id,
                },
                success: function (result) {
                    window.location.reload();

                }
            })
            //alert(moreText);
        } else {
            alert('Bạn chưa nhập đủ thông tin');
        }


    });
    $("#checkBL").click(function(){
        $("#cke_postBL").toggle(this.checked);
        $("#someTextBox").toggle();
    });
    // update profile

    $(".a-name").click(function(){
        $(".inp-name").removeAttr("disabled");
        $(".inp-name").removeClass();

    });

    //input change passwd
    $(".a-passwd").click(function(){
        $(".inp-passwd").removeAttr("disabled");
        $(".inp-repasswd").removeAttr("disabled");
        $(".inp-passwd").removeClass();
        $(".inp-repasswd").removeClass();
    });
    // change brithday
    $(".a-birthday").click(function(){
        $("#inp-birthday").removeAttr("disabled");
        $("#inp-birthday").removeClass();
    });
    // change name user s
    $(".a-rename").click(function(){
        $("#inp-rename").removeAttr("disabled");
        $("#inp-rename").removeClass();
    });
    // change email user
    $(".a-email").click(function(){
        $("#inp-email").removeAttr("disabled");
        $("#inp-email").removeClass();
    });
    // $("#inp-email").keypress(function() {
    //     var keycode = (event.keyCode ? event.keyCode : event.which);
    //     var email = $("#inp-email").val();
    //     var mem_id = $(".mem_id").val();
    //     if(keycode == '13') {

    //         $.ajax({
    //             type: "POST",
    //             url: "public/member/module/change_profile_user.php",
    //             data: "email="+email+"&mem_id="+mem_id,
    //             success:function(result) {
    //                 alert("Cập nhập email thành công");
    //                 window.location.reload();
    //             }
    //         });
    //     }
    // });
    // change phone
    $(".a-phone").click(function(){
        $("#inp-phone").removeAttr("disabled");
        $("#inp-phone").removeClass();
    });
    // change address
    $(".a-address").click(function(){
        $("#inp-address").removeAttr("disabled");
        $("#inp-address").removeClass();
    });


});


// scroll js
    $("#spacerForTopMenu").hide();
    $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
        $("#btn_to_top").fadeIn();
    }
    else {
        $("#btn_to_top").hide();
    }

    if ($(window).scrollTop() > 78) {
        $("#spacerForTopMenu").height($("#yanmenu").height()).show();
        $("#yanmenu").addClass("topmenu_fix").fadeIn();
    }
    else {
        $("#spacerForTopMenu").hide();
        $("#yanmenu").removeClass("topmenu_fix").fadeIn();
    }
    });

