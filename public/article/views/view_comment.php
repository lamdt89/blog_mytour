
<?php if(isset($count_id)): ?>

        <div class="comment">
            <div class="row top">
                <div class="col-md-12">
                    <b><?=$count_id?> bình luận</b>
                </div>
            </div>
            <?php if(isset($_SESSION['ses_mem_id'])): 
                $id_member = isset($_SESSION["ses_mem_id"]) ? intval($_SESSION["ses_mem_id"]) : 0;
                $getava = new db_query("SELECT * FROM members WHERE mem_id = ".$id_member);
                $cur_avatar = mysql_fetch_assoc($getava->result);
            ?>
            <div class="row comment-box">
                <div class="col-md-1 no-padding">
                    <img src="uploads/images/users/<?php echo $cur_avatar['mem_avatar']?>" style="width:65px; height: 60px;">
                </div>
                <div class="col-md-11 binhluan">


                        <input type="hidden" id="pos_id"  value="<?=$_GET['pos_id']; ?>"/>
                        <textarea name="text" id="someTextBox" ></textarea>
<!--                        <textarea name="post_cmt" id="postBL"  style="display: none"></textarea>-->
                        <textarea class="ckeditor" name="editor1" id="postBL"  style="display: none"></textarea>
                        <label style="font-weight:none;"><input type="checkbox" name="check" id="checkBL"/> Bình luận đầy đủ</label>
                        <button type="submit" name="binhluan" class="btn btn-primary btn-sm pull-right" id="post_comment">Bình luận</button>


                </div>

            </div>
            <?php else: {} ?>
                <p>Bạn phải đăng nhập mới được bình luận nội dung này</p>
            <?php endif;?>
        </div>
        <?php while($row = mysql_fetch_assoc($comments->result)): ?>
            <div class="row comm col-md-12 no-padding">
                <div class="col-md-1 ava no-padding">
                    <img width="100%" src="uploads/images/users/<?=$row['mem_avatar'];?>" height="60px">
                </div>

                <div class="col-md-10 no-padding" style="width:90% !important;">
                    <div class="person">
                        <p><span><a href="<?=$url_author.$row['mem_id']?>/"><?=$row['mem_name']?></a></span> - <? echo timeAgoInWords(converTime($row['cmt_time'], "H:i "))?></p>
                    </div>
                    <div class="detail">
                        <p><?=html_entity_decode($row['cmt_content']);?> </p>

                    </div>
                </div>

            </div>

            
        <?php endwhile; ?>
        <? if($count_id > 3): ?>
            <div id="c-result"></div>
            <div class="row cmt_page">
                <div class ="row col-md-12">
                    <input type="button" value="xem thêm bình luận..." id="cnext" data-cpage="1" data-pid="<?=$post_id?>" data-tcpage="<?=$t_cpage?>">
                </div>
            </div>
        <?  endif;  ?>

      <script type="text/javascript">
         $(document).ready(function() {
            $('pre code').each(function(i, block) {
               hljs.highlightBlock(block);
            });
         });
      </script>
<?php endif;?>