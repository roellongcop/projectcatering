
<div class="modal-content package-info-modal">
	<h4 class="center" style="color: #c23616; text-transform: uppercase;"><?= $package['name']; ?></h4>
	<div class="row">
		<div class="col s12 center">
			<p><?= $package['description']; ?></p>
			<p><span style="color: #d35400; font-size: 16px;">This package is good for <?= $package['pax']; ?>,  with <?= $package['staff_needed']; ?> event staffs</span></p>
			<input type="text" class="datepicker event_dates" placeholder="Choose your event date">
			<br>
			<span class="date-error hide" style="color: red;">Please provide your date</span>
		</div>
	</div>
	<div class="row">
		<div class="col s12 center">
			<table class="centered " id="itemsTable">
				<thead>
					<tr>
						<th>NAME</th>
						<th>ITEM QUANTITY</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($package['items'] as $item): ?>
					<tr>
						<td><?= $item['name']; ?></td>
						<td><?= $item['quantity'] . ' pieces '; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row modal-prices">
		<h5><small style="font-size: 14px; color: #e67e22;"> TOTAL PACKAGE PRICE: </small> PHP <?= $package['price']; ?></h5>
	</div>
</div>