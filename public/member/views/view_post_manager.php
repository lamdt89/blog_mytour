
<div class="row list-post">
    <h3 class="col-md-12">Danh sách bài viết của: <?=$_SESSION['ses_mem_name']?></h3>
    <h4 class="col-md-12">Tổng số bài viết: <?=$count_record->total?></h4>
    <?php 
        if($count_record->total == 0) {
            echo "<h4 class='col-md-12' style='text-align:center;'>Chưa có bài viết</h4>";
        }else {
    ?>
    <table class="profile-table"  >
        <tr class="tr-title">
            <td class="col-md-2">STT</td>
            <td class="col-md-6">Tiêu đề</td>
            <td class="col-md-2">Thời gian đăng bài</td>
            <td class="col-md-2">Trạng thái</td>
        </tr>
            <?php

                $stt = 0;
                foreach ($post as $item) {

                    $string = $article->removeTitle($item['pos_title']);
                    $stt++;
            ?>
            
            <tr class= "tr-content" id="tr-<?= $item['pos_id'] ?>">
                <td class="col-md-2"><?=$stt?></td>
                <td class="col-md-6">
                    <?
                        if($item['pos_active'] == 0){
                            echo "<i>".$item['pos_title']."</i>";
                            $tt = "<span>Chưa kích hoạt</span><br>";
                            $tt .= "<a href='edit-". $item['pos_id'] ."'><i class='fa fa-edit'></i> Sửa</a>&nbsp;&nbsp;&nbsp;";
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
    </table>

    <?php
        }
    ?>
    <div class="page profile-page">
        <?php
            for ( $page = 0; $page <= ($Pagination->totalPage(10) - 1); $page++ ){
               if($page == 0){
                  echo "<a data-page='". ($page) ."' class='btn btn-primary paging' style='margin-right:10px;' href='javascript:void(0);'>".($page+1)."</a>";
               }else {
                  echo "<a data-page='" . ($page) . "' class='btn btn-default paging' style='margin-right:10px;' href='javascript:void(0);'>" . ($page + 1) . "</a>";
               }
            }
        ?>
    </div>
</div>

