<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		<?= $past_event['title']; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Past Events / <?= $past_event['id']; ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<?php if ($this->session->flashdata('update_past_event')): ?>
						<div class="alert alert-success">
							<?= $this->session->flashdata('update_past_event'); ?>
						</div>
						<?php endif; ?>
						<div class="alert alert-warning past-error hide">

						</div>
	                </div>
					<div class="box-body">
						<div class="view-past-event"">
							<div class="row">
								<div class="col-md-6">
									<div class="past-left">
										<label>Title: </label>
										<input type="text" class="form-control" id="past_title" value="<?= $past_event['title'] ?>">
										<br>
										<label>Primary Information</label>
										<input type="text" class="form-control" id="past_additional" value="<?= $past_event['additional_desc']; ?>">
										<br>
										<label>Description</label>
										<textarea class="form-control" rows="11" id="past_description"><?= $past_event['description']; ?></textarea>
										<br>

										<button class="btn btn-success" id="btnUpdatePastEvent" data-id="<?= $past_event['id']; ?>">SAVE CHANGES</button>
									</div>
								</div>

								<div class="col-md-6">
									<div class="past-right">
										<input type="file" id="past_image_update" size="20" class="form-control" /><br>
										<div class="past-preview-box">
											<img src="<?= base_url() . $past_event['image']['current_path']; ?>" id="past-event-preview-update" class="img-responsive">
										</div>
										<div class="past-error-box hide">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?= $admin_footer; ?>