<?
$page = $_GET["page"];
require_once ("../require.php");

$mem_id = $_SESSION['ses_mem_id'];
$sql = "SELECT * FROM members WHERE mem_id = ".$mem_id;
$user = new db_query($sql);
$sql1 = "SELECT count(*) as count FROM posts WHERE pos_mem_id =".$mem_id;
$count_record = new db_count($sql1);
$Pagination = new pagination();
$Pagination->totalRow('posts',$mem_id);
$Pagination->totalPage(10);
$page = $Pagination->page();
$firstRow = $Pagination->firstRow($page,10);

$db = new db_query("SELECT * FROM posts WHERE pos_mem_id =".$mem_id." ORDER BY pos_id DESC LIMIT ".$firstRow.",10");

count($db);
while($rows = mysql_fetch_assoc($db->result)){
   $post[] = $rows;
}

//echo json_encode($post);

$article = new Article();
   ?>
      <tbody>
         <tr class="tr-title">
            <td class="col-md-2">STT</td>
            <td class="col-md-6">Tiêu đề</td>
            <td class="col-md-2">Thời gian đăng bài</td>
            <td class="col-md-2">Trạng thái</td>
         </tr>
         </tr>
         <?php

         $stt = $page*10;
         foreach ($post as $item) {

            $string = $article->removeTitle($item['pos_title']);
            $stt++;
            ?>
            
            <tr class="tr-content" id="tr-<?= $item['pos_id'] ?>">
               <td class="col-md-2"><?=$stt?></td>
               <td class="col-md-6">
                   <?
                       if($item['pos_active'] == 0){
                           echo "<i>".$item['pos_title']."</i>";
                          $tt = "<span>Chưa kích hoạt</span><br>";
                          $tt .= "<a href='edit-".$item['pos_id']."'><i class='fa fa-edit'></i> Sửa</a>&nbsp;&nbsp;&nbsp;";
                          $tt .= "<a class='delete' href='javascript:void(0);' data-id='". $item['pos_id'] ."'><i class='fa fa-trash-o'></i> Xóa</a>";
                       }else{
                           $tt = "<label style='color:#337ab7;'>Đã kích hoạt</label>";
                   ?>
                       <a href="http://<?=$_SERVER['HTTP_HOST'].'/p'.$item['pos_id'].'-'.$string?>.html"><?=$item['pos_title']?></a>
                   <?}?>
               </td>
               <td class="col-md-2"><?=timeAgoInWords(converTime($item['pos_time'], "H:i "))?></td>
               <td class="col-md-2">
                   <b><?=$tt?></b>
               </td>
            </tr>
         <?php
         }
         ?>
      </tbody>