<?php 
require_once('../class/Book.php');
$books = $book->getAllBook();

// echo '<pre>';
// 	print_r($books);
// echo '</pre>';
 ?>

<table id="myTable-book" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	    <tr>
            <th>Book ID</th>
	        <th>Book By</th>
	        <th>Contact</th>
	        <th>Address</th>
	        <th>Departure Date</th>
	        <th><center>Action</center></th>
	    </tr>
	</thead>
    <tbody>
    	<?php foreach($books as $b): ?>
    		<tr>
    			<td><?= $b['book_tracker']; ?></td>
                <td><?= ucwords($b['book_by']); ?></td>
    			<td><?= $b['book_contact']; ?></td>
    			<td><?= ucwords($b['book_address']); ?></td>
    			<td><?= $b['book_departure']; ?></td>
    			<td>
    				<center>
    					<button type="button" onclick="deleteBook('<?= $b['book_tracker']; ?>');" class="btn btn-danger btn-xs">Cancel
    					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    					</button>
    					&nbsp;
    					<button type="button" onclick="viewBook('<?= $b['book_tracker']; ?>')" class="btn btn-success btn-xs">Accept Payment
    					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    					</button>
    				</center>
    			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>
</table>


<!-- for the datatable of employee -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable-book').DataTable();
	});
</script>
