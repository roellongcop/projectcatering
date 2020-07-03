<div class="container reservation-page">
		<div class="row">
			<div class="col s12">
				<div class="display-packages">
					<div class="row">
						<div class="col s12 m6">
							<div class="package-details">
								<h4>Reservation Details: </h4>
								<div class="row">
									<div class="col s6">
										<div class="reserve-left">
											<h5>Package Chosen: </h5>
											<h5>Date of event: </h5>
											<?php if (isset($package['name'])): ?>
												<h5>Good for: </h5>
												<h5>Staffs/Helpers: </h5>
											<?php endif; ?>
										</div>
									</div>
									<div class="col s6">
										<div class="reserve-right">
											<h5><?= isset($package['name']) ? strtoupper($package['name']) : 'CUSTOM PACKAGE'; ?></h5>
											<h5><?= date_format(date_create($package['date']), 'F d, Y'); ?></h5>
											<?php if (isset($package['name'])): ?>
												<h5><?= $package['pax']; ?></h5>
												<h5><?= $package['staff_needed']; ?></h5>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="reserve-items">
									<h5>Items in this package: <a class="printItems"><i class="fa fa-print tooltipped" aria-hidden="true" data-position="top" data-delay="50" data-tooltip="Click to print list of items"></i></a> </h5>
									<table class="centered bordered" id="reserveItemsTbl">
										<thead>
											<th>ITEM</th>
											<th>QUANTITY</th>
										</thead>
										<tbody>
											<?php foreach($package['items'] as $item): ?>
												<tr>
													<td><?= $item['name']; ?></td>
													<td><?= $item['quantity'] . ' pc (s)'; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>

								<h5 class="reserve-total-amount">PHP <?= number_format(($package['is_customized'] ? $package['total_amount'] : $package['price']), 2); ?></h5>
								<p style="text-align: center; font-size: 12px; margin-top: 0px;">TOTAL AMOUNT TO BE PAID</p>
								<p style="font-size: 14px; margin-top: 20px;"><i class="fa fa-info-circle"></i> Kindly send your downpayment thru payment transfers in order to confirm your reservation.</p>
							</div>
						</div>

						<div class="col s12 m6">
							<div class="customer-details">
								<h4>Customer Details: </h4>
								<div class="row">
									<div class="input-field col s4">
										<input name="fname" type="text" id="fname">
										<label for="f_name">First Name: </label>
										<span id="error-fname" class="hide" style="color: red;">First name is required</span>
									</div>
									<div class="input-field col s4">
										<input name="mname" type="text" id="mname">
										<label for="m_name">Middle Name: </label>
									</div>
									<div class="input-field col s4">
										<input name="lname" type="text" id="lname">
										<label for="lname">Last Name: </label>
										<span id="error-lname" class="hide" style="color: red;">Last name is required</span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input name="email_address" type="text" id="email_address">
										<label for="email_address">Email Address:</label>
										<span id="error-email" class="hide" style="color: red;"></span>
									</div>
									<div class="input-field col s12 m6">
										<input id="confirm_email" type="text" id="confirm_email">
										<label for="confirm_email">Confirm Email Address:</label>
										<span id="error-confirm-email" class="hide" style="color: red;">Emails do not match</span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input name="contact_no" type="number" id="contact_no" value="09">
										<label for="contact_no">Contact Number: </label>
										<span id="error-contact" class="hide" style="color: red;">Contact number is required</span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s1">
										<input name="address" type="text" id="house_number">
										<label for="address">#</label>
									</div>
									<div class="input-field col s1">
										<input name="address" type="text" id="block">
										<label for="address">Blk:</label>
									</div>
									<div class="input-field col s1">
										<input name="address" type="text" id="lot">
										<label for="address">Lot:</label>
									</div>
									<div class="input-field col s5">
										<input name="address" type="text" id="st_brgy">
										<label for="address">Street/Brgy: </label>
									</div>
									<div class="input-field col s4">
										<input name="address" type="text" id="city">
										<label for="address">City/Municipality: </label>
									</div>
									<p id="error-address" class="hide" style="color: red; margin-left: 15px; margin-top: 0px; margin-bottom: 10px;">Please provide your address</p>
								</div>
								<div style="color: #2980b9; padding: 5px; padding-top: 10px;">
									<input type="checkbox" id="filled-in-box" class="filled-in" />
      								<label for="filled-in-box" style="color: #2c3e50;">I agree to Recto's Catering's <a class="terms modal-trigger" href="#termsModal" >Terms and Conditions</a></label><br>
      								<span id="error-terms" class="hide" style="color: red;">Please accept the terms and conditions</span>
								</div>

								<button class="waves-effect waves-light btn-large right" id="btnReserve"> <i class="fa fa-paper-plane" aria-hidden="true"></i> RESERVE NOW</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>