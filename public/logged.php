<?php
header('Content-Type: text/html; charset=utf-8');
// check login and check it in detail product
if(isset($_GET['pos_id'])) {
    $pos_id = (int) $_GET['pos_id'];
    // get cate id of post
        $sql_id = new db_query("SELECT pos_cat_id FROM posts WHERE pos_id={$pos_id}");
        $cate = mysql_fetch_assoc($sql_id->result);

    if($cate == ''){
        redirect('404');
    }
    else{
        $sql_cate = new db_query("SELECT cat_is_login, cat_has_it FROM categories WHERE cat_id={$cate['pos_cat_id']}");
        $row = mysql_fetch_assoc($sql_cate->result);
    }   

    if($row['cat_is_login'] == 1 AND $row['cat_has_it'] == 0) {
        if(!isset($_SESSION['ses_mem_id'])) {
            echo "<script>";
            echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
            echo "</script>";
            redirect("/");

        } else {}
    } elseif($row['cat_has_it'] == 1) {

        if(isset($_SESSION['ses_dep_id']) == "11") {

        } else {
            echo "<script>";
            echo "alert('Chỉ IT mới được xem nội dung này');";
            echo "</script>";
            redirect("/");
        }
    } else {

    }
}
    //check login and IT in detail
elseif(isset($_GET['cat_id'])) {
    $cate = (int) $_GET['cat_id'];
    $query = new db_query("SELECT * FROM categories WHERE cat_id='$cate'");
    $row = mysql_fetch_assoc($query->result);
    // check isset cat_parent_id
    // check login
    if($row['cat_is_login'] == 1 AND $row['cat_has_it'] == 0) {
        if(!isset($_SESSION['ses_mem_id'])) {
            echo "<script>";
            echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
            echo "</script>";
            redirect("/");
        }
    }
    // check login isset id IT
    if($row['cat_is_login'] == 1 AND $row['cat_has_it'] == 1) {
        if(!isset($_SESSION['ses_mem_id'])) {
            echo "<script>";
            echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
            echo "</script>";
            redirect("/");
        } else {
            if(isset($_SESSION['ses_dep_id']) == "11") {

            } else {
                echo "<script>";
                echo "alert('Chỉ IT mới được xem nội dung này');";
                echo "</script>";
                redirect("/");
            }
        }

    }
} else {
    if(!isset($_SESSION['ses_mem_id'])) {
        redirect("/");
    }
}


?>