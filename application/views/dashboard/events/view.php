<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Events
		<small>Update Event</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Events</a></li>
			<li class="active">Update Event</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title">Event Details: </h3>
                    </div>
					<div class="box-body">
						<div class="form-group">
							<label>Event Name: </label>
							<input type="text" id="update_event_name" class="form-control" value="<?= $event['name']; ?>">
						</div>
						<div class="form-group">
							<label>Event Description: </label>
							<textarea class="form-control" rows="9" id="update_event_description"><?= $event['description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Event Image: </label>
							<input type="file" id="update_event_file" size="20" class="form-control" /><br>
							<div class="preview-box">
								<img src="<?= base_url() . $event['image']['current_path']; ?>" id="update-event-preview" class="img-responsive">
							</div>
							<div class="error-box">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnUpdateEvent" data-id="<?= $event['id']; ?>">SAVE CHANGES</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>