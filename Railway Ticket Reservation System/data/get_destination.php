<?php 
require_once('database/Database.php');
$db = new Database();
$sql = "SELECT *
		FROM destination;
";

$destinations = $db->getRows($sql);

$db->Disconnect();

