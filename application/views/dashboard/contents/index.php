<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Content Management
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Content Management</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">				
					<div class="row">
						<div class="col-md-6">
							<h4>Terms of Reservation</h4>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTerm">Add new term</button>
							<div class="terms">
								<ul>
									<?php foreach ($terms as $val): ?>
										<li>
											<span class="term-item" data-id="<?= $val['id']; ?>"><?= $val['term']; ?></span>
										</li>
									<?php endforeach; ?>	
								</ul>
							</div>
						</div>
						<div class="col-md-6">
							<h4>About Page Details</h4>
							<label>Recto's Contact Number: </label>
							<input type="number" class="form-control" id="about_contact" value="<?= (! empty($about)) ? $about['contact_no'] : ''; ?>" >
							<label>Recto's Address: </label>
							<input type="text" class="form-control" id="about_address" value="<?= (! empty($about)) ? $about['address'] : ''; ?>">
							<label>Description</label>
							<textarea class="form-control" rows="9" id="about_text"><?= (! empty($about)) ? $about['display'] : ''; ?></textarea>
							<div class="error-about hide" style="color: red;">
								Please provide complete details
							</div>
							<br>
							<button class="btn btn-primary pull-right" id="btnSaveAbout">SAVE DETAILS</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="addTerm" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Term</h4>
				</div>
				<div class="modal-body add-item-modal">
					<div class="error-div hide">
						Please provide a term.
					</div>
					<h5>Policy: </h5>
					<textarea id="term" class="form-control" rows="7"></textarea>
				</div>
				<div class="modal-footer">
					<button id="btnSaveTerm" type="button" class="btn btn-success">SAVE TERM</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
				</div>
			</div>
		</div>
	</div>

	<div id="editTerm" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Term</h4>
				</div>
				<div class="modal-body add-item-modal">
					<div class="error-div hide">
						Please provide a term.
					</div>
					<h5>Policy: </h5>
					<textarea id="update_term" class="form-control" rows="7"></textarea>
					<input type="hidden" id="hidden_term_id">
				</div>
				<div class="modal-footer">
					<button id="btnDeleteTerm" type="button" class="btn btn-danger">DELETE TERM</button>
					<button id="btnUpdateTerm" type="button" class="btn btn-success">SAVE TERM</button>
				</div>
			</div>
		</div>
	</div>
<?= $admin_footer; ?>