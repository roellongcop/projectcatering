<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Venues
		<a class="btn btn-primary" href="<?= base_url() . 'venues/create'; ?>">Create new venue</a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Venues</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">
						<?php foreach ($venues as $ven): ?>
							<div class="col-md-4">
								<div class="events">
									<div class="event-image">
										<img src="<?= base_url() . $ven['image']['current_path']; ?>" class="img-responsive">
									</div>
									<div class="event-details">
										<h3><?= $ven['name']; ?></h3>
										<span class="btn btn-default showVenueInfo" data-id="<?= $ven['id']; ?>">MORE INFO</span>
										<button class="btn btn-danger deleteVenue" data-id="<?= $ven['id']; ?>">DELETE</button>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="updateVenue" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Venue</h4>
				</div>
				<div class="modal-body">
					<div class="error-div hide">
					</div>
					<h5>Name: </h5>
					<input type="text" id="update_venue_name" class="form-control">
					<h5>Description</h5>
					<textarea id="update_venue_desc" class="form-control" rows="4"></textarea>
					<div class="error-box hide"></div>
					<h5>Image</h5>
					<input type="file" id="update_venue_image" size="20" class="form-control" /><br>
					<img src="" id="update_venue_preview" class="img-responsive">
				</div>
				<div class="modal-footer">
					<input type="hidden" id="itemId">
					<button id="btnUpdateVenue" type="button" class="btn btn-success">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
<?= $admin_footer; ?>