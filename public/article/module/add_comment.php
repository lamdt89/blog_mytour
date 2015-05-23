<?php session_start();
require_once('../../../core/classes/database.php');
//if(isset($_POST['binhluan'])) {
    $pos_id     =  $_POST['pos_id'];
    $user_id    =  $_SESSION['ses_mem_id'];
//    if(!empty($_POST['text'])) {
//        $content = htmlentities(addslashes($_POST['text']));
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $current_time = strtotime(date('h:i A d-m-Y'));
//        $insert = new db_query("INSERT INTO
//              comments (cmt_content,cmt_time, cmt_pos_id, cmt_mem_id, cmt_like, cmt_active, cmt_parent_id )
//              VALUES ('$content', '$current_time' ,'$pos_id','$user_id',0 ,1, 0)");
//
//
//    }
//
//
//    if(!empty($_POST['post_cmt'])) {
//        $content    =  htmlentities(addslashes($_POST['post_cmt']));
//
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $current_time = strtotime(date('h:i A d-m-Y'));
//        $insert = new db_query("INSERT INTO
//              comments (cmt_content,cmt_time, cmt_pos_id, cmt_mem_id, cmt_like, cmt_active, cmt_parent_id )
//              VALUES ('$content', '$current_time' ,'$pos_id','$user_id',0 ,1, 0)");
//        // echo $insert;
//    }
//}
if(isset($_POST['text'])) {
    $content = htmlentities(addslashes($_POST['text']));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_time = strtotime(date('h:i A d-m-Y'));
    $insert = new db_query("INSERT INTO
          comments (cmt_content,cmt_time, cmt_pos_id, cmt_mem_id, cmt_like, cmt_active, cmt_parent_id )
          VALUES ('$content', '$current_time' ,'$pos_id','$user_id',0 ,1, 0)");
    echo $content;
}
if(isset($_POST['post_cmt'])) {
    $content    =  htmlentities(addslashes($_POST['post_cmt']));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_time = strtotime(date('h:i A d-m-Y'));
    $insert = new db_query("INSERT INTO
          comments (cmt_content,cmt_time, cmt_pos_id, cmt_mem_id, cmt_like, cmt_active, cmt_parent_id )
          VALUES ('$content', '$current_time' ,'$pos_id','$user_id',0 ,1, 0)");
    //echo $content;
}
