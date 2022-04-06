<?php 
require_once('../class/User.php');
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}
if(isset($_POST['un']) && isset($_POST['pwd']) ){
	$un = $_POST['un'];
	$pwd = $_POST['pwd'];

	$pwd = md5($pwd);//hash

	$result = $user->loginUser($un, $pwd);
	if($result > 0){
		$return['valid'] = true;
		$return['url'] = "reservation.php";
		$_SESSION['logged'] = $result['user_id'];
	}else{
		$return['valid'] = false;
		$return['msg'] = "Invalid Username / Password!";
	}
	echo json_encode($return);
}//end isset

$user->Disconnect();