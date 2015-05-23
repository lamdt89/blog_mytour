<?
	session_start();
    if(isset($_SESSION['ses_mem_id'])) {
        unset($_SESSION['ses_mem_name']);
        unset($_SESSION['ses_mem_avatar']);
        unset($_SESSION['ses_mem_id']);
        unset($_SESSION['ses_dep_id']);
    }

	//session_destroy();
	header("location:/");
?>