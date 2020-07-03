<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Foods
		<small>Update Food</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Foods</a></li>
			<li class="active">Update Food</li>
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
							<input type="text" class="form-control" id="update_food_name" value="<?= $food['name']; ?>" />
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" id="update_food_desc"><?= $food['description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Amount:  </label>
							<input type="number" class="form-control" id="update_food_price" value="<?= $food['price']; ?>" />
						</div>
						<div class="form-group">
							<label>Image: </label>
							<input type="file" id="update_food_image" size="20" class="form-control" multiple accept='image/*'/><br>
							<div class="preview-box">
								<img src="<?= base_url() . $food['image']['current_path']; ?>" id="update_food_preview" class="img-responsive">
							</div>
							<div class="food-error-box hide">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnUpdateFood" data-id="<?= $food['id']; ?>">SAVE FOOD</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>