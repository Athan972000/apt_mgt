<?php
ini_set('display_errors',1); 


class DB_Functions {

	private $db;
	private $dbcon;

	//put your code here
	// constructor
	function __construct() {
		//include_once '../dic/database/db_connect.php';
		require_once 'db_connect.php';
		// connecting to database 
		$this->db = new DB_Connect();
		$this->db->connect();	
	}

	// destructor
	function __destruct() { 

		//$this->db->close();
	//	Echo "************** close DB *************";
	}

function Insert_New_Applicant($username,$password,$api,$email,$company,$tlang,$howtouse,$id)
{
	echo "Your Applicaiton Form"."<br><br>";
	echo $username.'<br>'.$email.'<br>'.$company.'<br>'.$tlang.'<br>'.$howtouse.'<br>';
	
	if (!$this->Select_applicant_api($username, $email)) {
		$DBQuery = 'insert into `user_API`  values (auto,"$username","$password","$api","$email","$company","$tlang",now(),"$howtouse","$id") ';
/*	Must to be changed all fields like below

		$DBQuery = 'INSERT INTO  `user_API`  SET  			
				`username`   = "'.mysql_real_escape_string($username).'",
				`password`   = "'.mysql_real_escape_string($password).'",
				`apikey`   = "'.mysql_real_escape_string($api).'",
				`email`   = "'.mysql_real_escape_string($email).'"
				`company`   = "'.mysql_real_escape_string($company).'",
				`country`   = "'.mysql_real_escape_string($tlang).'",
				`date`   = now(),
				`howtouse`   = "'.mysql_real_escape_string($howtouse).'",
				`id`   = "'.mysql_real_escape_string($id).'"'
				;
	*/	
		$result = mysql_query($DBQuery);
echo $DBQuery."<br>";	
		if (!$result) { echo "<br>Sorry!!! There are some DataBase Problem while inserting. Insert_applicant_api <br> ";
			echo  $DBQuery."<br>";
			echo  mysql_errno(), " : ";
			echo  mysql_error()."<br>";	
		} else {
			echo "Success insertion : ".$username.'/'.$email."<br>";
			$this->Send_email_API($username,$password,$api,$email,$company,$tlang,$howtouse,$id,0);
		}
	} else {
			echo "<br><br><h2>This key is exsited - ".$email."</h2><br>";
	}
} 
function Generate_API_key()
{
	$key=date("Y/m/d")."vocaDB".date("h:i:sa");
	$time = microtime(); 
	$time = explode( " " , $time ); 
	$time = $time[0] + $time[1]; 
	$key = md5($time.$key);// 32 character hex number , // md5(string,raw) 
	//echo $key."<br>";
	return $key;
}
	
function search_client($username,$email)
{
	$result = $this->Select_applicant_api($username, $email);
	if ($result) {
			$row = mysql_fetch_array($result);	
			echo "Username : ".$row['username']."<br>".
	"email : ".$row['email']."<br>".
	"apikey : ".$row['apikey']."<br>".
	"company : ".$row['company']."<br>".
	"Language : ".$row['tlang']."<br>".
	"Signed Date : ".$row['date']."<br>".
	"How to use : ".$row['howtouse'];
	} else {
			echo "<br><br><h2>This key is not exsited - ".$username." / ".$email."</h2><br>";
	}
} 


function Issue_APIkey($username,$email)
{
	$result = $this->Select_applicant_api($username, $email);
	if ($result) {
		$row = mysql_fetch_array($result);	
		if ($row['apikey'] != '') {
			echo "<br> <h2>This client has a key already. : ".$row['apikey']."</h2>";
			return;
		}
		$api = $this->Generate_API_key();
		$DBQuery = "UPDATE `user_API` SET apikey='$api' where email='$email' "; 
	
		$result = mysql_query($DBQuery);
	
		if (!$result) { 
			echo "<br>Sorry!!! There are some DataBase Problem while issuing APIkey. <br> ";
			echo  $DBQuery."<br>";
			echo  mysql_errno(), " : ";
			echo  mysql_error()."<br>";	
			return false;
		} else {
			$result = $this->Select_applicant_api($username,$email);
			$row = mysql_fetch_array($result);	
echo $email." / ".$row['company']." / ".$row['tlang']." / ".$row['howtouse'];			
			$this->Send_email_API($username,'',$api,$email,$row['company'],$row['tlang'],$row['howtouse'],$row['id'],1);
		}
	} else {
			echo "<br><br><h2>This key is not exsited - ".$username." / ".$email."</h2><br>";
	}
} 

function Update_applicant_ALL($username,$password,$api,$email,$company,$tlang,$howtouse,$id)
{
	if ($this->Select_applicant_api($username,$email)) {

$DBQuery = 'UPDATE `user_API` SET password="'.$password.'",email="'.$email.'",company="'.$company.'",tlang="'.$tlang.'",howtouse="'.$howtouse.'",id="'.$id.'" where username="'.$username.'"';
//exceot api="$api", username="$username",
echo $DBQuery."<br>";		
		$result = mysql_query($DBQuery);
	
		if (!$result) { echo "<br>Sorry!!! There are some DataBase Problem while updating.Update_applicant <br> ";
			echo  $DBQuery."<br>";
			echo  mysql_errno(), " : ";
			echo  mysql_error()."<br>";	return false;
		} else {
			$this->Send_email_API($username,$password,$api,$email,$company,$tlang,$howtouse,$id,2);
			echo "Success Update for your information";
		}
	} else {
			echo "<br><br><h2>This key is not exsited : ".$username." / ".$api."</h2><br>";
	}
} 

function Select_applicant_api($username,$email)
{
	$DBQuery = 'select * from user_API where username="'.$username.'" or email="'.$email.'" '; 

	$result = mysql_query($DBQuery);
	return $result;
}	


function Send_email_API($username,$password,$api,$email,$company,$tlang,$howtouse,$id,$mod)
{
				$todaydate=date('Y-m-d');
				$vocaDB="vocadb@gmail.com";
				$to = $email.", ".$vocaDB;
				switch ($mod) {
					case 0 : $subject='Thanks for applying vocaDB API'; $message = 'Thank you so much. We will review your application ASAP and will send API key.'; break;
					case 1 : $subject='Congulatulations. This is your vocaDB APIKey'; $message = 'Congulatulations.<br>This is your vocaDB API : <b>'.$api.'</b>'; break;
					case 2 : $subject='Success to update your information by vocaDB'; $message = 'Suceess to update your information.'; break;
				}	
		
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= "From: <$vocaDB>";
				$emassage ="
$message<br>
o Date : $todaydate<br>
o Name : $username<br>
o E-mail : $email<br>
o Company : $company<br>
o Language : $tlang<br>
o How to use : $howtouse<br><br><br><br>
";

$tail = "<div style='border-top:1px solid #9C9C9C; border-bottom:1px solid #F6F6F6;'></div>
<div style='margin-top:10px; font-family: '맑은 고딕', Arial,ＭＳ Ｐゴシック;  background-color:#4486f6;'>
  Smart Dictionary & Translation<br>
  Innovative Translation / Book indexing / learning languages<br>
  <a href='http://www.vocadb.com'><b>http://www.vocadb.com</b></a><br>
   vocadb@gmail.com<br>
   MDM solution <a href='http://www.vocadb.co.kr/cross6'>http://www.vocadb.co.kr/cross6</a><br><br>
<div style='border-top:1px solid #9C9C9C; border-bottom:1px solid #F6F6F6;'></div>
</div>
<br>";
		echo '<br> Block email for testing temporary.<br><br> <br> Title : '.$subject."<br>".$emassage.$tail;
		/*
		$result=mail($to, $subject, $emassage.$tail, $headers);
		if(!$result){
					$meg ='<br><br>  <h2>* error : Please check your internet environment.</h2>';
		} 
		*/
}

}
?>