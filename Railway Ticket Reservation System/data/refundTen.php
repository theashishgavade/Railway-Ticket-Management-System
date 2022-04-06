<?php 
require_once('../class/Transaction.php');
if(isset($_POST['t_id'])){
	$t_id = $_POST['t_id'];
	$per = $_POST['per'];

	$data = $transaction->getTransData($t_id);
	$trans_id = $data['trans_id'];
	$payment = $data['trans_payment'];
	$payment = $payment * $per;//10%
	$refunded = $data['trans_refunded'];

	$return['valid'] = false;
	if($refunded == 0){
		$return['valid'] = true;
		$payment = number_format($payment, 2);
		$result = $transaction->updateTrans($trans_id, $payment);
	}else{
		$return['valid'] = false;
	}
	//trans_id

	echo json_encode($return);

}//end isset


$transaction->Disconnect();