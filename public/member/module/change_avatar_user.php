<?php session_start();
error_reporting(0);
require_once("../../../core/classes/database.php");
require_once("../../../core/functions/functions.php");
$path = __DIR__."/../../../uploads/images/users/";
$session_id = $_SESSION['ses_mem_id'];
$avatar_id  = $_SESSION['ses_mem_avatar'];
$get_avatar = new db_query("SELECT mem_avatar FROM members WHERE mem_id = ".$_SESSION['ses_mem_id']);
$ava = mysql_fetch_assoc($get_avatar->result);
$valid_formats = array("jpg", "png", "gif", "bmp", "JPG", "PNG", "GIF", "BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];

    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
            if($size<(1024*1024))
            {
                $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
                $tmp = $_FILES['photoimg']['tmp_name'];

                if(move_uploaded_file($tmp, $path.$actual_image_name))
                {
                    unlink(__DIR__.'../../../../uploads/images/users/'.$ava['mem_avatar']);
                    $update = new db_query("UPDATE members SET mem_avatar='$actual_image_name' WHERE mem_id='$session_id'");

                    echo "<img src='uploads/images/users/".$actual_image_name."'  class='img-avatar'>";

                }
                else
                    echo "<p>failed</p>";
            }
            else
                echo "<p>File ảnh quá lớn </p>";
        }
        else
            echo "<p>File ảnh không đúng định dạng hoặc lớn hơn 1024x1024 </p>";
    }

    else
        echo "<p>Xin hãy chọn ảnh..!</p>";

    exit;
}
