<?
	require_once ("../require.php");

	$fs_action		=	"";
	$fs_errorMsg	=	"";
	$submitform 	= 	getValue("insert_vote", "str", "POST","");
	$id_member = isset($_SESSION["ses_mem_id"]) ? intval($_SESSION["ses_mem_id"]) : 0;
	if($submitform == "Hoàn tất"){
	   if(getValue("vote_option","int","POST") == ""){
	   		echo "<script>alert('Bạn chưa chọn tiêu chí bình chọn !')</script>";
	   }else{
	   		$vod_op_id = getValue("vote_option","int","POST");
	   		
	   		$check_vote = new db_query("SELECT * FROM votes JOIN vote_option ON votes.vot_vote_option_id = vote_option.vop_id WHERE vop_pos_id = ".getValue("pos_id","int","GET")." AND vot_mem_id = ".$id_member);
	   		$active_v = mysql_fetch_assoc($check_vote->result);
	   		if($active_v == ""){
	   			$db_insert = new db_query("INSERT INTO votes(vot_vote_option_id, vot_mem_id) VALUES(".$vod_op_id.",".$id_member.")");
	   		}else{

	   			echo "<script>alert('Bạn đã tham gia bình chọn rồi')</script>";
	   		}	   	
	    }
	}
?>