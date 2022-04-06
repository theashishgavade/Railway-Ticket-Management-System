<?php 
require_once('database/Database.php');
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}

$db = new Database();

// $sql = "SELECT *
// 		FROM accomodation;
// 		ORDER BY acc_price ASC;
// ";
// $accomodations = $db->getRows($sql);

$sqlGetSit = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";

$getSit = $db->getRow($sqlGetSit, [1]);//1 means sitting

$date = $_SESSION['departure_date'];
//with ana nga date
$sqlBookedSit = "SELECT COUNT(*) as sit
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ? 
";
$totalSit = $db->getRow($sqlBookedSit, [1, $date]);


// ika duha
$sqlEcoA = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";
$getEcoA = $db->getRow($sqlEcoA, [2]);//1 means sitting

$sqlBookedEcoA = "SELECT COUNT(*) as ecoA
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ?; 
	";
$totalEcoA = $db->getRow($sqlBookedEcoA, [2, $date]);	


//ika 3 Eco B
$sqlEcoB = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";
$getEcoB = $db->getRow($sqlEcoB, [3]);//1 means sitting

$sqlBookedEcoB = "SELECT COUNT(*) as ecoB
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ?; 
	";
$totalEcoB = $db->getRow($sqlBookedEcoB, [3, $date]);	

//ika 4 Tourist
$sqlTour = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";
$getTour = $db->getRow($sqlTour, [4]);//1 means sitting
$sqlBookedTour = "SELECT COUNT(*) as ecoT
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ?; 
	";
$totalTour = $db->getRow($sqlBookedTour, [4, $date]);	


//ika 5 naku cabin
$sqlCab = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";
$getCab = $db->getRow($sqlCab, [5]);//1 means sitting
$sqlBookedCab = "SELECT COUNT(*) as ecoC
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ?; 
	";
$totalCab = $db->getRow($sqlBookedCab, [5, $date]);	

//ika 6  delux
$sqlDel = "SELECT * 
			   FROM accomodation
			   WHERE acc_id = ?;
";
$getDel = $db->getRow($sqlDel, [6]);//1 means sitting
$sqlBookedDel = "SELECT COUNT(*) as ecoD
				 FROM booked 
				 WHERE acc_id = ?
				 AND book_departure = ?; 
	";
$totalDel = $db->getRow($sqlBookedDel, [6, $date]);	


//get trasactions


$db->Disconnect();