<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Themes
		<small>Update Theme</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Themes</a></li>
			<li class="active">Update Theme</li>
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
							<input type="text" id="update_theme_name" class="form-control" value="<?= $theme['name']; ?>">
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" rows="9" id="update_theme_desc"><?= $theme['description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Price: </label>
							<input type="text" id="update_theme_price" class="form-control" value="<?= $theme['price']; ?>">
						</div>
						<div class="form-group">
							<label>Image: </label>
							<input type="file" id="update_theme_image" size="20" class="form-control" multiple accept='image/*' /><br>
							<div class="preview-box">
								<img src="<?= base_url() . $theme['image']['current_path']; ?>" id="update_my_preview" class="img-responsive">
							</div>
							<div class="theme-error-box">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnUpdateTheme" data-id="<?= $theme['id']; ?>">SAVE CHANGES</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>