<?php 
interface iTransaction {
	public function addTransaction($pay, $pass, $age, $gen, $acc_id, $orig_id, $dest_id);	
	public function getAllTransaction();
	public function getTransData($t_id);
	public function updateTrans($trans_id, $payment);
}//end iTransaction