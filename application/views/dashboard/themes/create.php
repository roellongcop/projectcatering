<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Theme
		<small>Create new Theme</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Theme</a></li>
			<li class="active">Create Theme</li>
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
							<input type="text" id="theme_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" rows="9" id="theme_desc"></textarea>
						</div>
						<div class="form-group">
							<label>Price: </label>
							<input type="number" id="theme_price" class="form-control">
						</div>
						<div class="form-group">
							<label>Image: </label>
							<input type="file" id="theme_image" size="20" class="form-control" multiple accept='image/*'/><br>
							<div class="preview-box">
								<img src="" id="my_preview" class="img-responsive">
							</div>
							<div class="theme-error-box hide">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnSaveTheme">SAVE THEME</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>