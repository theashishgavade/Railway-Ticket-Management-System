<?php 
require_once('database/Database.php');
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}
$db = new Database();
$acc_id = $_SESSION['accomodation'];

$sql = "SELECT *
		FROM accomodation
		WHERE acc_id = ?;
";

$accomodation = $db->getRow($sql, [$acc_id]);


$db->Disconnect();