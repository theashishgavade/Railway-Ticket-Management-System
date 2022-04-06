<div class="modal fade" id="modal-view-pass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Passengers List</h4>
			</div>
			<div class="modal-body">
			<center>
				<strong>Book By: </strong><span id="book-by"></span> <br />
				<strong>Departure Date: </strong><span id="date"></span> <br />
				<strong>Contact: </strong><span id="contact"></span> <br />
				<strong>Address: </strong><span id="address"></span><br />
			</center>
				<br />
				<div id="passenger-list">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="acceptPayment();" class="btn btn-primary accept-pay">Compute
				<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
				</button>

				<button type="button" onclick="addTransaction();" class="btn btn-success accept-pay">Accept Payment
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</div>
</div>