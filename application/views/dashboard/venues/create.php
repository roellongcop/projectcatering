<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Venue
		<small>Create Venue</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Venue</a></li>
			<li class="active">Create Venue</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title">Details: </h3>
                        <div class="error-div hide">
                        </div>
                    </div>
					<div class="box-body">
						<div class="form-group">
							<label>Name: </label>
							<input type="text" id="venue_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" rows="9" id="venue_description"></textarea>
						</div>
						<div class="form-group">
							<label>Image: </label>
							<input type="file" id="venue_image" size="20" class="form-control" /><br>
							<div class="preview-box">
								<img src="" id="venueImagePreview" class="img-responsive">
							</div>
							<div class="error-box hide" style="color: red;">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnCreateVenue">SAVE VENUE</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>