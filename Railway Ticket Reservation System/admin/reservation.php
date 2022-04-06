<?php 
require_once('session_login.php');
 ?>

 <!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Admin Panel </title>

		<!-- Bootstrap CSS -->
   	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-theme.min.css">

     <!-- Custom CSS -->
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

	</head>
<body>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Online Ticketing Admin Panel</a>
		<ul class="nav navbar-nav">
			<li class="active"><a href="reservation.php">Reserved
			<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
			</a></li>
			<li class=""><a href="transaction.php">Transaction
			<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
			</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
	      <li><a href="../admin/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	    </ul>
	</div>
</nav>
<br />
<div class="container-fluid">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div id="book-table"></div>
	</div>
	<div class="col-md-1"></div>
</div>


<?php require_once('modal/view_passenger.php'); ?>
<?php require_once('modal/message.php'); ?>
<?php require_once('modal/confirmation.php'); ?>

<script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	function showAllBook(){
		$.ajax({
				url: '../data/get_all_book.php',
				type: 'post',
				// data: {},
				success: function (data) {
					// console.log(data);
					$('#book-table').html(data);
				},
				error: function(){
					alert('Error: L54+');
				}
			});
	}//end showAllBook
	showAllBook();

	var book_tracker;
	function deleteBook(tracker){
		// console.log(tracker);
		book_tracker = tracker;
		$('#modal-confirmation').modal('show');
	}//end deleteBook

	$('.del-book').click(function(event) {
		/* Act on the event */
		$.ajax({
				url: '../data/deleteBook.php',
				type: 'post',
				dataType: 'json',
				data: {
					tracker : book_tracker
				},
				success: function (data) {
					// console.log(data);
					$('#modal-confirmation').modal('hide');
					showAllBook();
					$('#modal-message').find('.modal-body').text(data.msg);
					$('#modal-message').modal('show');
				},
				error: function(){
					alert('Error: L87+');
				}
			});
	});//del


	function displayPassenger(tracker){
		// console.log(tracker);
		$.ajax({
				url: '../data/getPassengers.php',
				type: 'post',
				// dataType: 'json',
				data: {
					tracker : tracker	
				},
				success: function (data) {
					// console.log(data);
					$('#passenger-list').html(data);
				},
				error: function(){
					alert('Error: L113+');
				}
			});
	}//end displayPassenger

	function viewBook(tracker){
		// $('#modal-view-pass').modal('show');

		$.ajax({
				url: '../data/getBookBy.php',
				type: 'post',
				dataType: 'json',
				data: {
					tracker : tracker	
				},
				success: function (data) {
					// console.log(data);
					$('#book-by').text(data.book_by);
					$('#date').text(data.book_departure);
					$('#contact').text(data.book_contact);
					$('#address').text(data.book_address);
					$('#modal-view-pass').modal('show');
				},
				error: function(){
					alert('Error: L113+');
				}
			});
		displayPassenger(tracker);
	}//end viewBook

	function acceptPayment(){
		var counter = $('#i').val();
		var tot = 0;
		for(var i = 0; i < counter; i++){
			var name = $('#name'+i).val();
			var disc = $('#disc'+i).val();
			var price = $('#price'+i).val();
			var discounted = price * disc;
			$('#pri'+i).text(discounted);
			tot += Number(discounted);
	
		}//for loop
		$('#total').text(tot);

	}//end acceptPayment

	function addTransaction(){
		var counter = $('#i').val();
		var tot = 0;
		for(var i = 0; i < counter; i++){
			var name = $('#name'+i).val();
			var disc = $('#disc'+i).val();
			var price = $('#price'+i).val();
			var discounted = price * disc;
			$('#pri'+i).text(discounted);
			tot += Number(discounted);
				$.ajax({
	    			url: '../data/save_transaction.php',
	    			type: 'post',
	    			dataType: 'json',
	    			data: {
	    				bid : name,
	    				disc : disc
	    			},
	    			success: function (data) {
	    				console.log(data);
	    				$('#modal-view-pass').modal('hide');
	    				showAllBook();
	    				$('#modal-message').find('.modal-body').text('Transaction Save Successfully!');
	    				$('#modal-message').modal('show');
	    			},
	    			error: function(){
	    				alert('Error: L162+');
	    			}
	    		});
		}//for loop
		$('#total').text(tot);	
	}
</script>

</body>
</html>