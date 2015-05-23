<?php
    if(isset($_GET['pos_id'])) {
        $post_id = (int) $_GET['pos_id'];
        $sql_count = "SELECT  count(*) as count FROM comments WHERE cmt_pos_id={$post_id} AND cmt_active=1";
        $sql = "SELECT * FROM comments
                  JOIN members ON comments.cmt_mem_id=members.mem_id
                  WHERE cmt_pos_id={$post_id} AND cmt_active=1 ORDER BY cmt_id DESC LIMIT 0,3";
        $comments   =   new db_query($sql);
        $count      =   new db_count($sql_count);
        $count_id   =   $count->total;
        $t_cpage    =   ceil($count_id/3);

    }
?>
