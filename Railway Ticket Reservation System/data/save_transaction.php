<?php 
require_once('../class/Book.php');
require_once('../class/Transaction.php');
if(isset($_POST['bid']) && isset($_POST['disc'])){
	$bid = $_POST['bid'];
	$disc = $_POST['disc'];

	$data = $book->selectBook($bid);//select the details first
	$pass = $data['book_name'];
	$age = $data['book_age'];
	$gen = $data['book_gender'];
	$departure = $data['book_departure'];
	$dest_id = $data['dest_id'];
	$acc_id = $data['acc_id'];
	$orig_id = $data['origin_id'];
	$price = $data['acc_price'];
	
	$pay = $price * $disc;//ge deduct nani sa iya discount
	
	//save sa transation then e delete sa booked
	$insertTrans = $transaction->addTransaction($pay, $pass, $age, $gen, $acc_id, $orig_id, $dest_id);
	$return['pay'] = $pay;

	//delete
	$book->deleteBookByID($bid);

	// echo $bid;

	echo json_encode($return);

}//end isset

$book->Disconnect();