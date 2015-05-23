<<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript" src="../../resource/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../../resource/js/tinymce/themes/modern/theme.min.js"></script>
<script>
tinymce.init({
    selector: "#pos_content",
    theme: "modern",
    width: "100%",
    height: "auto",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: "Bold text", inline: "b"},
        {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
        {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
        {title: "Example 1", inline: "span", classes: "example1"},
        {title: "Example 2", inline: "span", classes: "example2"},
        {title: "Table styles"},
        {title: "Table row 1", selector: "tr", classes: "tablerow1"}
    ]
 }); 
</script>
</head>
<body>
        <textarea name="content" style="width:100%" id="pos_content"></textarea>
</body>
</html>