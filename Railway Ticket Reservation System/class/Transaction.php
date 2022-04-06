<?php
require_once('../database/Database.php');
require_once('../interface/iTransaction.php');
class Transaction extends Database implements iTransaction
 {

	public function addTransaction($pay, $pass, $age, $gen, $acc_id, $orig_id, $dest_id)
	{
		$sql = "INSERT INTO transaction (trans_payment, trans_passenger, trans_age, trans_gender,
				acc_id, origin_id, dest_id)
				VALUES(?,?,?,?,?,?,?);
		";
		return $this->insertRow($sql, [$pay, $pass, $age, $gen, $acc_id, $orig_id, $dest_id]);
	}//end addTransaction
	
	public function getAllTransaction()
	{
		$sql = "SELECT *
				FROM transaction t
				INNER JOIN accomodation a 
				ON t.acc_id = a.acc_id
			";
		return $this->getRows($sql);
	}//end getAllTransaction

	public function getTransData($t_id)
	{
		$sql = "SELECT *
				FROM transaction 
				WHERE trans_id = ?;
		";
		return $this->getRow($sql, [$t_id]);
	}//end getTransData

	public function updateTrans($trans_id, $payment)
	{	
		$refunded = 1;
		$sql = "UPDATE transaction
				SET trans_payment = ?, trans_refunded = ?
				WHERE trans_id = ?;
		";
		return $this->updateRow($sql, [$payment, $refunded, $trans_id]);

	}//end updateTrans

}//end class Transaction

$transaction = new Transaction();

/* End of file Transaction.php */
/* Location: .//D/xampp/htdocs/medallion/class/Transaction.php */


