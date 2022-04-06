<?php 
require_once('database/Database.php');
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}
$db = new Database();
$orig = $_SESSION['origin'];
$desti = $_SESSION['destination'];

$sqlOrig = "SELECT *
			FROM origin
			WHERE origin_id = ?;
";
$origin = $db->getRow($sqlOrig, [$orig]);

$sqlDest = "SELECT *
			FROM destination
			WHERE dest_id = ?;
";
$dest = $db->getRow($sqlDest, [$desti]);



$db->Disconnect();