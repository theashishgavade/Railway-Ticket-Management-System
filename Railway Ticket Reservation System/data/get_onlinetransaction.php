<?php 
require_once('../class/Transaction.php');
$transactions = $transaction->getAllTransaction();

// echo '<pre>';
// 	print_r($transactions);
// echo '</pre>';
?>

<h2><center>Online Transaction Information</center></h2>
<table id="myTable-trans" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>Booking ID</th>
	        <th><center>Name on Card</center></th>
	        <th><center>Email</center></th>
	        <th><center>Payment Status</center></th>
	        <th><center>Payment Time</center></th>
	    </tr>
	</thead>
    <tbody>
    	<?php foreach($transactions as $t): ?>
    		<tr>
    			<td align="center"><?= $t['trans_age']; ?></td>
				<td><?= ucwords($t['trans_passenger']); ?></td>
				<td align="center"><?= $t['trans_gender']; ?></td>
    			<td align="center"><?= $t['acc_type']; ?></td>
    			<td align="center"><?= $t['trans_payment']; ?></td>
    			
    			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>
</table>

<?php 
$transaction->Disconnect();
 ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable-trans').DataTable();
	});
</script>