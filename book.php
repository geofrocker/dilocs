<?php
include('base.php');
?>
<?php startblock('body') ?>
    <div class="jumbotron">
        <form action="pesapal-iframe.php" method="post">
			<table>
				<tr>
					<td>Amount:</td>
					<td><input type="text" name="amount" class="form-control" value="500" />
					(in Ugshs)
					</td>
				</tr>
				<tr>
					<td>Type:</td>
					<td><input type="text" name="type" value="MERCHANT" class="form-control" readonly="readonly" />
					<!-- (leave as default - MERCHANT) -->
					</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><input type="text" name="description" class="form-control" value="Travelling from Kampala to Nairobi" /></td>
				</tr>
				<tr>
					<td>Reference:</td>
					<td><input type="text" name="reference" class="form-control" value="001" />
					<!-- (the Order ID ) -->
					</td>
				</tr>
				<tr>
					<td>Travellers's First Name:</td>
					<td><input type="text" name="first_name" class="form-control" value="Asiimwe" /></td>
				</tr>
				<tr>
					<td>Travellers's Last Name:</td>
					<td><input type="text" name="last_name" class="form-control" value="Geofrey" /></td>
				</tr>
				<tr>
					<td>Travellers's Email Address:</td>
					<td><input type="text" name="email" class="form-control" value="geofrocker2@gmail.com.com" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" class="btn btn-primary" value="Book Ticket" /></td>
				</tr>
			</table>
		</form>
    </div>

<?php endblock() ?>
