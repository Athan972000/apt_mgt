<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

	if (!$_SERVER['HTTP_USER_AGENT']) {
			echo 'forbidden 403';   // 서버 접속방지, 일반 브라우져만 접속허용
			return;
	}
	
	$username 	= trim(strip_tags($_POST["names-mail"]));
	$email 		= trim(strip_tags($_POST["emails-mail"]));	
	$mod 		= $_POST["mod"];
	$scode   	= $_POST["scode"];
	if ($mod == 0) {
		$company   	= trim(strip_tags($_POST["companys-mail"]));
		$country  	= trim(strip_tags($_POST["nation-mail"]));
		$howtouse   = trim(strip_tags($_POST["msgs-mail"]));			
	} 
	$api='';
	$password ='';
	
	require_once 'Secure_word.php';		
	if (time($email) != '' and $scode == $secure_code ) {
				require_once 'api_user_mgt.php';
				$db_func = new DB_Functions(); 
				switch ($mod) {
					case 0 : $db_func->Insert_New_Applicant($username,$password,$api,$email,$company,$country,$howtouse,$id); break;  // New
					case 1 : $db_func->Issue_APIkey($username,$email); break;  // issue
					case 2 : $db_func->Update_applicant_ALL($username,$password,$api,$email,$company,$country,$howtouse,$id); break;  // Update all
					case 3 : $db_func->Search_client($username,$email); break;  // search
				}

	} else {
			echo "Check Secure code or a your email ID.";
	}



?>

				
