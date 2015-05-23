<?
require_once ("../require.php");
if(!isset($_SESSION['ses_mem_id'])) {
   echo "<script>";
   echo "alert('Bạn phải đăng nhập mới được xem nội dung này');";
   echo "</script>";
   redirect( base64_decode(getValue("url", "str", "GET", base64_encode("error-file"))) );
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Đọc file</title>
      <?=$load_header?>
      <link href="themes/css/flexpaper/flexpaper.css" rel="stylesheet" >
   </head>

   <body>
      <div id="header">
         <?php
         include '../views/view_header.php';
         ?>
      </div>

      <div id="main-page">
         <div class = "container">
            <div class = "row">
               <div class="col-md-10 col-md-offset-1">
                  <div id="documentViewer" class="flexpaper_viewer" style="width:100%;height:550px;margin: 50px 0px 50px 0px"></div>
               </div>
            </div>
         </div>
      </div>

      <div id="footer">
         <?php
         include '../views/view_footer.php';
         ?>
      </div>

      <!-- end footer -->

      <?=$load_footer?>
      <script src="themes/js/flexpaper/jquery.extensions.min.js"></script>
      <script src="themes/js/flexpaper/flexpaper_handlers.js"></script>
      <script src="themes/js/flexpaper/flexpaper.js"></script>
      <script type="text/javascript">
         var startDocument = "Paper";

         $('#documentViewer').FlexPaperViewer(
            { config : {

               /*SWFFile : 'docs/Paper.pdf.swf',
                IMGFiles : 'docs/Paper.pdf_{page}.png',
                JSONFile : 'docs/Paper.js',*/
//               PDFFile : 'uploads/document/posts/test.pdf',
               PDFFile : '<? if(isset($_GET['file'])){ echo 'uploads/document/posts/'.date('Y/m/d/',$_GET['date']).$_GET['file']; }else{ echo 'uploads/document/posts/test.pdf'; } ?>',

               Scale : 0.6,
               ZoomTransition : 'easeOut',
               ZoomTime : 0.5,
               ZoomInterval : 0.1,
               FitPageOnLoad : true,
               FitWidthOnLoad : false,
               FullScreenAsMaxWindow : false,
               ProgressiveLoading : false,
               MinZoomSize : 0.2,
               MaxZoomSize : 5,
               SearchMatchAll : false,
               InitViewMode : '',
               RenderingOrder : 'html5,flash',
               StartAtPage : '',

               ViewModeToolsVisible : true,
               ZoomToolsVisible : true,
               NavToolsVisible : true,
               CursorToolsVisible : true,
               SearchToolsVisible : true,
               WMode : 'transparent',
               localeChain: 'en_US'
            }}
         );
      </script>

      <script type="text/javascript">
         var url = window.location.href.toString();

         if(location.length==0){
            url = document.URL.toString();
         }

         if(url.indexOf("file:")>=0){
            jQuery('#documentViewer').html("<div style='position:relative;background-color:#ffffff;width:420px;font-family:Verdana;font-size:10pt;left:22%;top:20%;padding: 10px 10px 10px 10px;border-style:solid;border-width:5px;'><img src=''>&nbsp;<b>You are trying to use FlexPaper from a local directory.</b><br/><br/> FlexPaper needs to be copied to a web server before the viewer can display its document properly.<br/><br/>Please copy the FlexPaper files to a web server and access the viewer through a http:// url.</div>");
         }
      </script>
      <!-- add script -->
   </body>
</html>