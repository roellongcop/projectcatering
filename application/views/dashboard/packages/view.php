<?= $admin_header; ?>


	<section class="content-header">
		<h1>
		Packages
		<small>Update Package</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Packages</a></li>
			<li class="active">Update Package</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
                        <h3 class="box-title">Details</h3>
                        <div class="edit-error-div hide">
                        </div>
                    </div>
                    <div class="box-body" id="package-body">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group">
									<label>Type of event: </label>
									<select class="form-control" id="event_id">
										<?php foreach ($events as $event): ?>
										<option value="<?= $event['id']; ?>" <?= ($event['id'] == $package['event_id']) ? 'selected' : ''; ?>><?= $event['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
                    			<div class="form-group">
									<label>Package name: </label>
									<input type="text" id="editPackageName" value="<?= $package['name']; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>Choose theme: </label>
									<select class="form-control" id="update_theme_id">
										<?php foreach ($themes as $theme): ?>
										<option value="<?= $theme['id']; ?>" <?= ($package['theme_id'] == $theme['id']) ? 'selected' : ''; ?>><?= $theme['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#updateFoodModal">UPDATE FOODS</button>
								</div>
								<div class="form-group">
									<label>Good for (PAX): </label>
									<input type="text" id="editPax" class="form-control" value="<?= $package['pax']; ?>">
								</div>
								<div class="form-group">
									<label>Number of Staffs: </label>
									<input type="number" id="editStaffs" class="form-control" value="<?= $package['staff_needed']; ?>">
								</div>
								<div class="form-group">
									<label>Description: </label>
									<textarea class="form-control" id="editDescription" rows="5"><?= $package['description']; ?></textarea>
								</div>
								<div class="form-group">
									<label>Package Photo: </label>
									<input type="file" id="update_package_image" size="20" class="form-control" /><br>
									<img src="<?= base_url() . $package['image']['current_path']; ?>" id="edit-pack-image-preview" class="img-responsive">
									<div class="pack-error-box hide">
									</div>
								</div>
								<div class="form-group">
									<h3><button class="btn btn-success" id="btnUpdatePackage">Save Changes</button></h3>
									<input type="hidden" id="hidden_package_id" value="<?= $package['id']; ?>">
								</div>
                    		</div>

                    		<div class="col-md-6">
                    			<div class="package-price-area">
                    			<span style="font-size: 24px;">Price: </span><span id="packagePriceEdit" style="font-size: 24px;">PHP <?= number_format($package['price'], 2); ?></span>
                    			</div>
                    			<div class="form-group">
                    				<label>Items </label>
									<div class="row">
										<div class="col-sm-12 col-md-7">
											<select class="form-control" id="edit_items_list">
												<?php foreach ($items as $key => $item): ?>
													<optgroup label="<?= $key; ?>" class="edit-group-<?php $classKey = str_replace(' ', '_', $key); echo $classKey; ?>">
														<?php foreach ($items[$key] as $val): ?>
															<option value="<?= $val['id']; ?>" data-name="<?= $val['name']; ?>" data-maxqty="<?= $val['quantity']; ?>" data-category="<?php $classKey = str_replace(' ', '_', $key); echo $classKey; ?>" data-quantity="<?= $val['quantity'];?>" data-amount="<?= $val['price']; ?>"><?= $val['name']; ?></option>
														<?php endforeach; ?>
													</optgroup>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-12 col-md-3">
											<input type="text" id="edit_item_quantity" class="form-control">
										</div>
										<div class="col-sm-12 col-md-1">
											<button class="btn btn-primary" id="btnAddItemToPackageEdit"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
										</div>
									</div>
									<div class="updateItems">
										<?php foreach ($package['items'] as $key => $item): ?>
										<?php foreach ($item as $val): ?>
										<div class="row itemWithQty" style="margin-bottom:5px; margin-top:5px;">
											<div class="col-sm-12 col-md-7">
												<input type="text" data-maxqty="<?= $val['maxqty']; ?>" data-category="<?= str_replace(' ', '_', $val['category']); ?>" data-id="<?= $val['id']; ?>" class="form-control" value="<?= $val['name']; ?>" data-quantity="<?= $val['quantity']; ?>" data-subtotal="<?= $val['subtotal']; ?>" data-amount="<?= $val['amount']; ?>" readonly/>
											</div>
											<div class="col-md-3">
												<input type="number" class="form-control itemQty" value="<?= $val['quantity']; ?>" readonly/>
											</div>
											<div class="col-md-1">
												<button class="btn btn-danger editRemoveItemBtn" data-category="<?= str_replace(' ', '_', $val['category']); ?>" data-name="<?= $val['name']; ?>" data-maxqty="<?= $val['maxqty']; ?>" data-value="<?= $val['id']; ?>" data-subtotal="<?= $val['subtotal']; ?>" data-quantity="<?= $val['quantity']; ?>" data-amount="<?= $val['amount']; ?>"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
											</div>
										</div>
										<?php endforeach; ?>
										<?php endforeach; ?>
									</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
			</div>
		</div>
	</section>
	<div id="updateFoodModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Foods</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 col-md-7">
							<select class="form-control" id="edit_food_list">
								<?php foreach ($foods as $key => $val): ?>
									<option value="<?= $val['id']; ?>" data-name="<?= $val['name']; ?>" data-amount="<?= $val['price']; ?>"><?= $val['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-12 col-md-3">
							<input type="text" id="edit_food_quantity" class="form-control">
						</div>
						<div class="col-sm-12 col-md-1">
							<button class="btn btn-primary" id="btnAddFoodToPackageEdit"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
						</div>
					</div>
					<div class="updateFoods">
						<?php foreach ($package['foods'] as $key => $val): ?>
							<div class="row foodWithQty" style="margin-bottom:5px; margin-top:5px;">
								<div class="col-sm-12 col-md-7">
									<input type="text" data-id="<?= $val['id']; ?>" class="form-control" value="<?= $val['name']; ?>" data-quantity="<?= $val['quantity']; ?>" data-subtotal="<?= $val['subtotal']; ?>" data-amount="<?= $val['amount']; ?>" readonly/>
								</div>
								<div class="col-md-3">
									<input type="number" class="form-control foodQty" value="<?= $val['quantity']; ?>" readonly/>
								</div>
								<div class="col-md-1">
									<button class="btn btn-danger editRemoveFoodBtn" data-name="<?= $val['name']; ?>" data-value="<?= $val['id']; ?>" data-subtotal="<?= $val['subtotal']; ?>" data-quantity="<?= $val['quantity']; ?>" data-amount="<?= $val['amount']; ?>"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">
	var priceEdit = "<?= $package['price']; ?>"
</script>
<?= $admin_footer; ?>

