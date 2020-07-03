<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Past Event
		<small>Create Past Event Display</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>Past Event</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
                    </div>
                    <form action="<?= base_url() . 'past-events/store'; ?>" method="POST">
					<div class="box-body" style="width: 50%;">
						<div class="form-group">
							<label>Title: </label>
							<input type="text" name="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Primary Information: </label>
							<input type="text" name="additional_desc" class="form-control" placeholder="ex. Date and place of event" required>
						</div>
						<div class="form-group">
							<label>Event Description: </label>
							<textarea class="form-control" rows="9" name="description" placeholder="Can use basic html tags e.g <br> - Next line, <b>I am bold</b> - for bolder text" required></textarea>
						</div>
						<div class="form-group">
							<label>Photo: </label>
							<input type="file" id="past_image" size="20" class="form-control" /><br>
							<div class="preview-box hide">
								<img src="" id="past-event-preview" class="img-responsive">
							</div>
							<div class="error-box hide">
							</div>
						</div>
						<br>
						<div class="form-group">
							<button class="btn btn-success">SAVE AND PUBLISH RECORD</button>
						</div>
					</div>
					</form>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>