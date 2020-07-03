<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Events
		<small>Create Event</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Events</a></li>
			<li class="active">Create Event</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title">Details: </h3>
                    </div>
					<div class="box-body">
						<div class="form-group">
							<label>Name: </label>
							<input type="text" id="event_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" rows="9" id="event_description"></textarea>
						</div>
						<div class="form-group">
							<label>Image: (for best apperance on site, an image with minimum dimension of width(1920 pixels) x height(1280 pixels) is required)</label>
							<input type="file" id="event_image" size="20" class="form-control" /><br>
							<div class="preview-box">
								<img src="" id="eventImagePreview" class="img-responsive">
							</div>
							<div class="error-box hide" style="color: red;">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnCreateEvent">SAVE EVENT</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>

	<div id="errorPhotoModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard=ßßßß"false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align: center; font-size: 16px;" id="errorPhoto"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
<?= $admin_footer; ?>