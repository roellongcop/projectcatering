<?= $header; ?>

<div class="section white" id="choicesContainer">
	<div class="row container">
		<div class="col s12 review-summary">
			<h4 style="color: #e67e22;">REVIEW YOUR ORDER</h4>
			<div class="row">
				<div class="col s4 review-first">
					<div class="row">
						<div class="col s5">
							<h5>PACKAGE: </h5>
							<h5>DATE OF EVENT: </h5>
							<?php if (isset($package['name'])): ?>
								<h5>GOOD FOR: </h5>
								<h5>STAFFS/HELPERS: </h5>
							<?php endif; ?>
							<?php if ($package['theme_id'] !== '0' || ! empty($package['theme_desc'])): ?>
								<h5>EVENT THEME: </h5>
							<?php endif; ?>
							<h4>TOTAL AMOUNT: </h4>
						</div>
						<div class="col s7">
							<h5><?= isset($package['name']) ? $package['name'] : 'Custom Package'; ?></h5>
							<h5><?= date_format(date_create($package['date']), 'F d, Y'); ?></h5>
							<?php if (isset($package['name'])): ?>
								<h5><?= $package['pax']; ?></h5>
								<h5><?= $package['staff_needed']; ?></h5>
							<?php endif; ?>
							<h5 class="theme-review">
								<?php if ($package['theme_id'] == '0'): ?>
									<?= $package['theme']; ?>
								<?php else: ?>
									<?= $package['theme']['name']; ?>
								<?php endif; ?>
							</h5>
							<h4 style="color: #e67e22; font-size: 32px; left: 170px;">PHP <?= number_format($package['price'], 2); ?></h4>
						</div>
					</div>

					<div class="row">
						<div class="col s6 event-times">
							<label style="color: #000;">EVENT START: </label>
							<input type="text" class="timepicker" id="event_start_time">
						</div>
						<div class="col s6 event-times">
							<label style="color: #000;">EVENT END: </label>
							<input type="text" class="timepicker" id="event_end_time" disabled="disabled">
						</div>
					</div>
				</div>
				<div class="col s4 review-second">
					<h5 style="color: #e67e22;">Items in package: </h5>
					<?php foreach ($package['items'] as $item): ?>
					<div class="row row-review-item">
						<div class="col s6">
							<span class="review-item" data-id="<?= $item['id']; ?>"><?= $item['name']; ?></span>
						</div>
						<div class="col s2">
							<i class="fa fa-times" style="color: #f39c12;"></i> <span><?= $item['quantity']; ?></span>
						</div>
						<div class="col s4">
							<span>PHP <?= number_format($item['subtotal'], 2); ?></span>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col s4 review-second">
					<h5 style="color: #e67e22;">Package Menu: </h5>
					<?php foreach ($package['foods'] as $food): ?>
					<div class="row review-food">
						<div class="col s5">
							<span class="food-review-item" data-id="<?= $food['id']; ?>"><?= $food['name']; ?></span>
						</div>
						<div class="col s2">
							<i class="fa fa-times" style="color: #f39c12;"></i> <span><?= $food['quantity']; ?></span>
						</div>
						<div class="col s5">
							<span>PHP <?= number_format($food['subtotal'], 2); ?></span>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="parallax-container" style="height: 800px;">
	<div class="parallax"><img src="<?= base_url(). 'resources/img/venuebg.jpeg'; ?>" style="filter: blur(5px);"></div>
	<div class="venue-form">
		<div class="row">
			<div class="col s12">
				<h4 style="color: #e67e22;">EVENT VENUE</h4>
				<div class="input-field" style="width: 50%; display: block; margin: 30px auto;">
					<select id="selectVenue">
						<option value="0" selected>Describe my own</option>
						<?php foreach ($venues as $val): ?>
							<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
						<?php endforeach; ?>
					</select>
					<label>Select a venue (optional)</label>
				</div>
		    	<div class="venue-theme">
					<img src="" id="venueImagePreview" class="img-responsive" style="width: 50%; display: block; margin: 0 auto;">
					<div class="venue-desc">
						<p id="venueDesc"></p>
					</div>
				</div>
				<div class="input-field venue-desc-area hide" style="width: 50%; display: block; margin: 30px auto;">
		            <textarea id="venue_desc" class="materialize-textarea"></textarea>
		            <label for="textarea1">Describe your the venue you want</label>
		        </div>
			</div>
		</div>
	</div>
</div>

<div class="parallax-container" style="height: 800px;">
	<div class="parallax"><img src="<?= base_url(). 'resources/img/home2.jpeg'; ?>"></div>

	<div class="user-form">
		<h4 style="color: #e67e22;">CUSTOMER DETAILS</h4>
		<div class="row">
			<div class="input-field col s4">
				<input name="lname" type="text" id="lname">
				<label for="lname">Last Name: </label>
				<span id="error-lname" class="hide" style="color: red;">Last name is required</span>
			</div>
			<div class="input-field col s4">
				<input name="mname" type="text" id="mname">
				<label for="m_name">Middle Name: </label>
			</div>
			<div class="input-field col s4">
				<input name="fname" type="text" id="fname">
				<label for="f_name">First Name: </label>
				<span id="error-fname" class="hide" style="color: red;">First name is required</span>
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
	
		<div class="row">
			<div class="col s6">
				<div class="file-field input-field">
					<div class="btn" style="background: #2980b9;">
						<span>UPLOAD VALID ID PROOF</span>
						<input type="file" id="valid_id_proof" multiple accept='image/*'>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
				<span id="error-image" class="hide" style="color: red;">Please include a valid document image </span>
			</div>
			<div class="col s6" style="padding-top: 40px;">
				<input type="checkbox" id="filled-in-box" class="filled-in" />
				<label for="filled-in-box" style="color: #2c3e50;">I agree to Recto's Catering's <a class="terms modal-trigger" href="#termsModal" >Terms and Conditions</a></label><br>
				<span id="error-terms" class="hide" style="color: red;">Please accept the terms and conditions</span>
			</div>
		</div>


		<button class="waves-effect waves-light btn-large right" id="btnReserve"> <i class="fa fa-paper-plane" aria-hidden="true"></i> RESERVE NOW</button>
	</div>
</div>

<div id="imageModal" class="modal">
	<div class="modal-content center">
		<img src="" id="reviewImageModal" class="responsive-img">
	</div>
</div>

<div id="codeModal" class="modal">
	<div class="modal-content center">
		<span style="font-size:18px!important;">Please enter the code we sent to your email address .</span>
		<br>
		<span style="font-size:16px!important;" id="resendCodeArea">Did not receive code? <a class="resend-code">Resend Code</a></span><br>
		<input id="code" type="text" style="width: 50%; text-align: center;font-size: 32px;"><br>
		<label id="labelError">Verification Code: </label>
		<br><br>
		<button class="btn" id="btnSendReservation" style="background: #e67e22;">PROCEED</button>
	</div>
</div>

<div id="reserveErrorModal" class="modal">
	<div class="modal-content center">
		<h5 style="color: red;">Invalid time value</h5>
	</div>
</div>

<div id="preloaderModal" class="modal">
	<div class="modal-content center" style="height: 200px!important;">
		<span style="font-size: 24px!important;">Processing ....</span>
		<br>
		<div class="preloader-wrapper big active">
			<div class="spinner-layer spinner-blue-only">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div><div class="gap-patch">
				<div class="circle"></div>
			</div><div class="circle-clipper right">
			<div class="circle"></div>
		</div>
		</div>
		</div>
	</div>
</div>

<div id="termsModal" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<div class="my-terms">
					<h5>Recto's Catering Terms and Conditions</h5>
					<br>
					<?php foreach ($terms as $val): ?>
						<p><?= $val['term']; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
   		<a class="modal-action modal-close btn-flat">close</a>
    </div>
</div>

<?= $footer; ?>