<?php 
require_once('../class/Transaction.php');
$transactions = $transaction->getAllTransaction();

// echo '<pre>';
// 	print_r($transactions);
// echo '</pre>';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medallion";
$orders_data = array(); 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `orders`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
//   cardno, name, email, status, modified
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " cardnum" . $row["card_num"]. " email" . $row["email"] . " payment Status" . $row["payment_status"] . " modified" . $row["modified"] . "<br>";
	$orders_data[] = $row;
  }
} else {
  echo "0 results";
}
$conn->close();
// require_once('../database/Connection.php');
?>

<table id="myTable-trans" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>Name</th>
	        <th><center>Age</center></th>
	        <th><center>Gender</center></th>
	        <th><center>Accomodation</center></th>
	        <th><center>Paid</center></th>
	        <th><center>Discount</center></th>
	    </tr>
	</thead>

	<h2><center>Booking Information</center></h2>

    <tbody>
    	<?php foreach($transactions as $t): ?>
    		<tr>
    			<td><?= ucwords($t['trans_passenger']); ?></td>
    			<td align="center"><?= $t['trans_age']; ?></td>
    			<td align="center"><?= $t['trans_gender']; ?></td>
    			<td align="center"><?= $t['acc_type']; ?></td>
    			<td align="center"><?= $t['trans_payment']; ?></td>
    			<td align="center">
    				<button type="button" onclick="tenPercent(<?= $t['trans_id']; ?>, .90);" class="btn btn-success btn-xs">10 %
    				</button>

    				<button type="button" onclick="tenPercent(<?= $t['trans_id']; ?>, .80);" class="btn btn-info btn-xs">20 %
    				</button>
    			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>
</table>

<h2><center>Online Transaction Information</center></h2>

<table id="myTable-trans2" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th style="text-align: center;">Card number</th>
	        <th style="text-align: center;">Name on Card</th>
	        <th style="text-align: center;">Email</th>
	        <th style="text-align: center;">Payment Status</th>
	        <th style="text-align: center;">Payment Time</th>
	    </tr>
	</thead>
    <tbody>
    	<?php foreach($orders_data as $orderVal): ?>
    		<tr>
    			<td style="text-align: center;">
					<?= $orderVal['card_num']; ?>
				</td>
				<td style="text-align: center;">
					<?= ucwords($orderVal['name']); ?>
				</td>
				<td style="text-align: center;">
					<?= $orderVal['email']; ?>
				</td>
    			<td style="text-align: center;">
					<?= $orderVal['payment_status']; ?>
				</td>
    			<td style="text-align: center;">
					<?= $orderVal['modified']; ?>
				</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>
</table>

<?php 
$transaction->Disconnect();
 ?>
<!-- for the datatable of employee -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable-trans').DataTable();
	});
	$(document).ready(function() {
		$('#myTable-trans2').DataTable();
	});
</script>
