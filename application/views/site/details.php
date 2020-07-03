<?= $header; ?>
<div class="parallax-container" style="height: 700px;">
	<div class="parallax"><img src="<?= base_url(). 'resources/img/buildbot.jpg'; ?>"></div>
	
	<div class="container details-page">
		<div class="row">
			<div class="col s12">
				<div class="details" id="details">
					<?php if ($modify_flag === 0): ?>
						<h5><i class="fa fa-check-circle"></i> Your Reservation was successfully sent!</h5>
						<p>Please wait for the confirmation message for about 1-2 days</p>
					<?php else: ?>
						<h5>Reservation Details</h5>
					<?php endif; ?>

					<div class="details-part" id="detailsPart">
						<div class="row">
							<div class="col s6 details-1" style="padding-left: 28%;">
								<h5>Reservation code:</h5>
								<h5>Status: </h5>
								<h5>Customer name:</h5>
								<h5>Customer email:</h5>
								<h5>Date of event:</h5>
								<h5>Package selected:</h5>
								<h5>Total amount:</h5>
							</div>
							<div class="col s6">
								<h5 style="font-weight: bolder;"><?= $reservation['reservation_code']; ?></h5>
								<h5 style="font-weight: bolder; text-transform: uppercase;"><?= $reservation['status']; ?></h5>
								<h5 style="font-weight: bolder;"><?= ucwords($reservation['customer_name']); ?></h5>
								<h5 style="font-weight: bolder;"><?= $reservation['customer_email']; ?></h5>
								<h5 style="font-weight: bolder;"><?= date_format(date_create($reservation['date_of_event']), 'F d, Y'); ?></h5>
								<h5 style="font-weight: bolder;"><?= (! is_null($reservation['name'])) ? $reservation['name'] : 'Custom Package' ?></h5>
								<h5 style="font-weight: bolder;">PHP <?= number_format($reservation['total_amount'], 2); ?></h5>
							</div>
						</div>
					</div>

					<div class="details-print">
						<div class="row">
							<div class="col s2">
							</div>
							<div class="col s4">
								<h5>Reservation code:</h5>
								<h5>Status: </h5>
								<h5>Customer name:</h5>
								<h5>Customer email:</h5>
								<h5>Date of event:</h5>
								<h5>Package selected:</h5>
								<h5>Total amount:</h5>
							</div>
							<div class="col s6">
								<h5 style="color: #d35400;"><?= $reservation['reservation_code']; ?></h5>
								<h5 style="color: #d35400;"><?= $reservation['status']; ?></h5>
								<h5 style="color: #d35400;"><?= ucwords($reservation['customer_name']); ?></h5>
								<h5 style="color: #d35400;"><?= $reservation['customer_email']; ?></h5>
								<h5 style="color: #d35400;"><?= date_format(date_create($reservation['date_of_event']), 'F d, Y'); ?> (<?= isset($reservation['event_time']) ? $reservation['event_time'] : 'N/A' ?> )</h5>
								<h5 style="color: #d35400;"><?= (! is_null($reservation['name'])) ? $reservation['name'] : 'Custom Package' ?></h5>
								<h5 style="color: #d35400;">PHP <?= number_format($reservation['total_amount'], 2); ?></h5>
							</div>
						</div>
						<div class="row">
							<div class="col s6">
								<h5 style="text-align: center; color: #2980b9;">Foods</h5>
								<ul>
									<?php foreach ($reservation['foods'] as $val): ?>
										<li>
											<div class="row" style="margin-bottom: 0px;">
												<div class="col s6">
													<?= $val['name']; ?>
												</div>
												<div class="col s6">
													<?= $val['quantity'] . ' pieces'; ?>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="col s6">
								<h5 style="text-align: center; color: #2980b9;">Items</h5>
								<ul>
									<?php foreach ($reservation['package_items'] as $val): ?>
										<li>
											<div class="row" style="margin-bottom: 0px;">
												<div class="col s6">
													<?= $val['name']; ?>
												</div>
												<div class="col s6">
													<?= $val['quantity'] . ' pieces'; ?>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<span>Recto's Terms and Conditions</span>
								<ul style="margin-left: 20px;">
								<?php foreach ($terms as $term): ?>
									<li><?= $term['term']; ?></li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col s12" style="padding-right: 185px; margin-top: 20px;">
							<a class="print-details right"><i class="fa fa-print"></i> PRINT DETAILS </a> 
							<?php if ($reservation['status'] != 'rejected' && $reservation['cancelled_flag'] == 0 && ! $is_date_passed): ?>
								<a class="cancel-reservation right modal-trigger" href="#cancelModal" data-id="<?= $reservation['id']; ?>"><i class="fa fa-times"></i> CANCEL RESERVATION </a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<img src="<?= base_url(). 'resources/img/logo.jpg'; ?>" class="print-logo" />
		<span>Congressional Rd. (Lumang Petron) Brgy. Maderan, GMA, Cavite</span><br>
		<span></span><br>
	</div>
</div>

<div id="cancelModal" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<div class="row">
					<div class="input-field">
						<textarea id="cancel_reason" class="materialize-textarea"></textarea>
          				<label for="textarea1">Please provide reason for cancellation</label>
					</div>
					<span style="color: red;" class="irror hide">Reason for cancellation is required</span>
				</div>
				<div class="row">
					<div class="col s12">
						<h5 id="cancelReservation" data-id="<?= $reservation['id']; ?>">PROCEED</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $footer; ?>