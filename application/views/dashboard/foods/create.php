<?= $admin_header; ?>
	<section class="content-header">
		<h1>
		Foods
		<small>Create Food</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Foods</a></li>
			<li class="active">Create Food</li>
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
							<label>Category: </label>
							<select id="food_category" class="form-control">
								<?php foreach ($categories as $cat): ?>
									<option value="<?= $cat['id']; ?>"><?= ucfirst($cat['category']); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Name: </label>
							<input type="text" class="form-control" id="food_name" />
						</div>
						<div class="form-group">
							<label>Description: </label>
							<textarea class="form-control" id="food_desc"></textarea>
						</div>
						<div class="form-group">
							<label>Amount:  </label>
							<input type="number" class="form-control" id="food_price" />
						</div>
						<div class="form-group">
							<label>Image: </label>
							<input type="file" id="food_image" size="20" class="form-control" multiple accept='image/*'/><br>
							<div class="preview-box">
								<img src="" id="food_preview" class="img-responsive">
							</div>
							<div class="food-error-box hide" style="color: red!important;">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="btnCreateFood">SAVE FOOD</button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?= $admin_footer; ?>