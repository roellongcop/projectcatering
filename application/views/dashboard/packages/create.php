<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Packages
		<small>Create New Package</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Packages</a></li>
			<li class="active">Create Package</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
                        <h3 class="box-title">Details</h3>
                        <div class="error-div hide">
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body" id="package-body">
                    	<div class="row">
                    		<div class="col-md-6">
								<div class="form-group">
									<label>Type of event: </label>
									<select class="form-control" id="event_id">
										<?php foreach ($events as $event): ?>
										<option value="<?= $event['id']; ?>"><?= $event['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label>Package name: </label>
									<input type="text" id="package_name" class="form-control">
								</div>
								<div class="form-group">
									<label>Choose theme: </label>
									<select class="form-control" id="theme_id">
										<?php foreach ($themes as $them): ?>
										<option value="<?= $them['id']; ?>" data-price="<?= $them['price']; ?>"><?= $them['name']; ?> - <?= number_format($them['price'], 2); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#foodModal">ADD FOODS</button>
								</div>
								<div class="form-group">
									<label>Good for (PAX): </label>
									<input type="text" id="package_pax" class="form-control">
								</div>
								<div class="form-group">
									<label>Number of Staffs: </label>
									<input type="number" id="package_staffs" class="form-control">
								</div>
								<div class="form-group">
									<label>Description: </label>
									<textarea class="form-control" rows="5" id="description"></textarea>
								</div>
								<div class="form-group">
									<label>Package Photo: </label>
									<input type="file" id="package_image" size="20" class="form-control" /><br>
									<img src="" id="pack-image-preview" class="img-responsive">
									<div class="pack-error-box hide" style="color: red;">
									</div>
								</div>
								<div class="form-group">
									 <h3><button class="btn btn-success" id="btnSavePackage">Save Package</button></h3>
								</div>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="package-price-area">
                    			<span style="font-size: 24px;">Price: </span><span id="packagePrice" style="font-size: 24px;"></span>
                    			</div>
                    			<div class="form-group">
                    				<label>Items </label>
									<div class="row">
										<div class="col-sm-12 col-md-7">
											<select class="form-control" id="items_list">
												<?php foreach ($items as $key => $item): ?>
												<optgroup label="<?= $key; ?>" class="group-<?php $classKey = str_replace(' ', '_', $key); echo $classKey; ?>">
													<?php foreach ($items[$key] as $val): ?>
													<option value="<?= $val['id']; ?>" data-name="<?= $val['name']; ?>" data-maxqty="<?= $val['quantity']; ?>" data-category="<?php $classKey = str_replace(' ', '_', $key); echo $classKey; ?>" data-amount="<?= $val['price']; ?>"><?= $val['name'] . ' - ' . number_format($val['price'], 2); ?></option>
													<?php endforeach; ?>
												</optgroup>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-12 col-md-3">
											<input type="text" id="item_quantity" class="form-control" placeholder="Quantity">
										</div>
										<div class="col-sm-12 col-md-1">
											<button class="btn btn-primary" id="btnAddItemToPackage"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
										</div>
									</div>
									<div id="itemsContainer">
									</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
			</div>
	</section>

	<div id="errorModalPackage" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 id="packageErrorMessage"></h5>
				</div>
			</div>
		</div>
	</div>

	<div id="foodModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Foods</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 col-md-7">
							<select class="form-control" id="food_list">
								<?php foreach ($foods as $key => $val): ?>
								<option value="<?= $val['id']; ?>" data-name="<?= $val['name']; ?>" data-amount="<?= $val['price']; ?>"><?= $val['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-12 col-md-3">
							<input type="text" id="food_quantity" class="form-control" placeholder="Quantity">
						</div>
						<div class="col-sm-12 col-md-1">
							<button class="btn btn-primary" id="btnAddFoodToPackage"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
						</div>
					</div>
					<div id="foodsContainer">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var page = 'createpackage';
	</script>

<?= $admin_footer; ?>