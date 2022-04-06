<?php 
require_once('database/Database.php');
$db = new Database();
$sql = "SELECT *
		FROM origin;
";

$origins = $db->getRows($sql);

$db->Disconnect();

