<?
   require_once ("../require.php");
   require_once ("../logged.php");

   $fs_table = "posts";
   $id_field = "pos_id";
   $record_id		= getValue("post","str","GET");

   //Check user
   $db_pos = new db_query('SELECT * FROM '. $fs_table .' WHERE pos_id= '. $record_id);
   $db_pos = mysql_fetch_assoc($db_pos->result);
   if($db_pos['pos_mem_id'] != $_SESSION['ses_mem_id']){
      echo "<script>alert('Bài viết này không phải của bạn không có quyền xóa !');</script>";
      redirect('/');
   }elseif($db_pos['pos_active'] == 1){
      echo "<script>alert('Bài viết này đã kích hoạt bạn không có quyền xóa !');</script>";
   }else {
      $record_id = intval($record_id);
      $arr_record = explode(",", $record_id);
      $total = 0;
      foreach ($arr_record as $i => $record_id) {
         $record_id = intval($record_id);
         //$del    = new db_execute("DELETE FROM links WHERE lin_law_id IN(" . $record_id . ")");
         $db_del = new db_execute("DELETE FROM " . $fs_table . " WHERE " . $id_field . " IN(" . $record_id . ")");
         if ($db_del->total > 0) {
            $total += $db_del->total;
         }
         unset($db_del);
      }
      echo "Có " . $total . " bản ghi đã được xóa !";
   }


?>
