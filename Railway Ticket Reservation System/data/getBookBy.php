<?php 
require_once('../class/Book.php');

if(isset($_POST['tracker'])){
	$tracker = $_POST['tracker'];

	$bookBy = $book->getBookBy($tracker);
	echo json_encode($bookBy);
}

$book->Disconnect();