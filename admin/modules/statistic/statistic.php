<?
require_once("inc_security.php");
$idAdmin = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
if(checkAccessAddEdit($idAdmin,$module_id,'view')){
   redirect($fs_denypath);
}

$submitform 	= 	getValue("submit", "str", "POST","");

if($submitform == "Thống kê"){
   $fromDate      =  getValue("start-date","str",'POST');
   $toDate        =  getValue("end-date","str","POST");
   if($fromDate != "" || $toDate != "") {
      $fromDate = strtotime($fromDate);
      $toDate = strtotime($toDate.date(' H:i:s'));
      $count_post = new db_count('SELECT COUNT(*) AS count FROM posts WHERE pos_time BETWEEN ' . $fromDate . ' AND ' . $toDate);
      $total_post = new db_query('SELECT pos_id,pos_time FROM posts WHERE pos_time BETWEEN ' . $fromDate . ' AND ' . $toDate);
      $total_post = $total_post->resultArray();
      $statistic = [];
      foreach ($total_post as $value) {
         $date = date('m/d/Y', intval($value['pos_time']));
         array_push($statistic, $date);
         //$statistic[] = $date;
      }
      $statistic = array_count_values($statistic);
      $statistic = json_encode($statistic);
   }else{
      $error = 'Bạn không được để trống';
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      <?=$load_header?>
      <link href="../../resource/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
      <script language="javascript" src="../../resource/js/jquery-ui.min.js"></script>
      <script language="javascript" src="../../resource/js/Chart.min.js"></script>
      <script>
         $(document).ready(function(){
            $("#txtFromDate").datepicker({
               maxDate: '0',
               numberOfMonths: 2,
               onSelect: function(selected) {
                  $("#txtToDate").datepicker("option","minDate", selected)
               }
            });
            $("#txtToDate").datepicker({
               maxDate: '0',
               numberOfMonths: 2,
               onSelect: function(selected) {
                  $("#txtFromDate").datepicker("option","maxDate", selected)
               }
            });
         });
      </script>
      <style type="text/css">
      .a_url{
         float: left;
         color: blue;
         font-size: 14px;
         width: 100%;
         text-transform: uppercase;
         padding-bottom: 10px;
      }
      </style>
   </head>

   <body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
      <div style="margin: 20px 0 0 30px;width:750px;">
         
         <label class="a_url" style="color:black;">thống kê bài viết theo khoảng thời gian</label>
         <hr/>
         <?
            $form = new form();
            if(isset($error)){
         ?>
         <p><?= $error ?></p>
         <? } ?>
         <form action="" method="POST" class="frm_post" enctype="multipart/form-data">
            <p>
               <font class="form_asterisk">* </font><label>Từ ngày:</label>
               <input type="text" name="start-date" id="txtFromDate" value='<? if(getValue("start-date","str","POST") != 0){ echo getValue("start-date","str","POST");}?>' >
            </p>
            <p>
               <font class="form_asterisk">* </font><label>Đến ngày:</label>
               <input type="text" name="end-date" id="txtToDate" value='<? if(getValue("end-date","str","POST") != 0){ echo getValue("end-date","str","POST");}?>'>
            </p>
            <p>
               <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Thống kê" . $form->ec . "Làm lại", "Thống kê" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
               <?=$form->hidden("action", "action", "execute", "");?>
            </p>
         </form>

         <?
         if(!empty($statistic)){
            ?>
         <div>
            <canvas id="canvas" height="500" width="900"></canvas>
         </div>
         <script>
            var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
            var data = <?= $statistic; ?>;
            var label = [];
            //var data  = [];
            $.each(data,function(key, value){
               label.push(key);
               //console.log(value);
               //data.push(value);
            });
            //console.log(label);
            var lineChartData = {
               labels : label,
               datasets : [
                  {
                     label: "My Second dataset",
                     fillColor : "rgba(151,187,205,0.2)",
                     strokeColor : "rgba(151,187,205,1)",
                     pointColor : "rgba(151,187,205,1)",
                     pointStrokeColor : "#fff",
                     pointHighlightFill : "#fff",
                     pointHighlightStroke : "rgba(151,187,205,1)",
                     data : data
                  }
               ]

            }

            window.onload = function(){
               var ctx = document.getElementById("canvas").getContext("2d");
               window.myLine = new Chart(ctx).Line(lineChartData, {
                  responsive: true
               });
            }
         </script>
         <? }?>

      </div>
      
   </body>
</html>