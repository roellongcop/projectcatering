<?= $header; ?>
	
	<div class="parallax-container" style="height: 850px!important;">
    	<div class="parallax" id="build-parallax"><img src="<?= base_url(). 'resources/img/birthday-cake-celebration-353347.jpg'; ?>" style="filter: blur(8px);"></div>

    	<div id="theme-parallax">
	    	<h3 class="build-title">Personalize your package!</h3>
	    	<div class="build-master">
	    		<div class="row">
	    			<div class="col s12 m4">
						<div class="input-field select-theme-area">
							<select id="buildSelectTheme">
								<option value="none" disabled selected>Choose your option</option>
								<?php foreach ($themes as $val): ?>
									<option value="<?= $val['id']; ?>" data-price="<?= $val['price']; ?>"><?= $val['name']; ?></option>
								<?php endforeach; ?>
								<option value="0" data-price="0">Others</option>
							</select>
							<label>Choose a theme</label>
						</div>
						<div class="show-theme hide left">
							<a class="btnShowTheme">Show Theme Options</a>
						</div>
						<div class="date-description-area">
							<input type="text" class="datepicker custom_event_date" placeholder="Choose your event date">
							<div class="row calendar-legend">
    							<div class="col s6 cal-available">
    								<span style="font-size: 16px;">Available</span>
    							</div>
    							<div class="col s6 cal-full">
    								<span style="font-size: 16px;">Reserved</span>
    							</div>
    						</div>
							<br>
							<h5 class="build-error hide" id="error-date">Please choose your event date.</h5>
						</div>
	    			</div>
	    			<div class="col s12 m8">
	    				<div class="build-theme">
	    					<?php foreach ($themes as $val): ?>
								<img src="<?= base_url(). $val['image']['current_path']; ?>" id="<?= 'theme_' . $val['id']; ?>" data-price="<?= $val['price']; ?>" class="hide">
								<p class="hide" id="<?= 'theme_' . $val['id']; ?>"><?= $val['description']; ?></p>
							<?php endforeach; ?>
	    				</div>
    					<div class="input-field theme-desc-area hide">
				            <textarea id="theme_desc" class="materialize-textarea"></textarea>
				            <label for="textarea1">Describe your theme</label>
				        </div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col s12">
	    			<div class="price-display">
					</div>
				</div>
			</div>

	    	<div class="build-next">
	    		<div class="next-food">
					<span>CHOOSE FOODS  <i class="fa fa-chevron-right"></i></span>
				</div>
			</div>
    	</div>

    	<div id="food-parallax">
	    	<div class="food-master">
				<div class="row">
					<h4>ADD FOOD IN YOUR MENU</h4>
					<div class="col s12">
						<h5 class="build-error hide" id="food-error" style="color: #e74c3c; margin-left: 35px;">Please add at least one food in your menu.</h5>
						<div class="row" style="margin-bottom: 0px;">
							<div class="col s12 m7">
								<div class="row">
									<div class="col s12 m5">
										<div class="build-category-choices-food" id="categoryChoices">
											<span>Food Categories</span>
											<?php foreach ($food_categories as $key => $cat): ?>
											<p>
												<input type="checkbox" id="<?= $cat['id']; ?>" class="filled-in checkbox-orange food-cats" />
												<label for="<?= $cat['id']; ?>" style="color: #fff;"><?= $cat['category']; ?></label>
											</p>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="col s12 m7">
										<div class="build-item-choices" id="buildFoodChoices">
									
										</div>
									</div>
								</div>
							</div>
							<div class="col s12 m5">
								<div class="build-food-table">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
	    		<div class="col s12">
	    			<div class="price-display">
						<span id="packagePriceBuild"></span>
					</div>
				</div>
			</div>

			<div class="build-next2">
	    		<div class="row">
	    			<div class="col s6">
		    			<div class="prev-theme">
		    				<span><i class="fa fa-chevron-left"></i> BACK TO THEMES</span>
		    			</div>
		    		</div>
		    		<div class="col s6">
		    			<div class="next-item">
		    				<span>CHOOSE ITEMS <i class="fa fa-chevron-right"></i></span>
		    			</div>
		    		</div>
	    		</div>
			</div>
    	</div>

    	<div id="item-parallax">
    		<div class="items-build">
		    	<div class="row">
		    		<h4>ADD ITEMS IN YOUR PACKAGE</h4>
					<div class="col s12">					
						<h5 class="build-error hide" id="item-error" style="color: #e74c3c; margin-left: 35px;">Please add at least one item in your package.</h5>
						<div class="row" style="margin-bottom: 0px;">
							<div class="col s12 m7">
								<div class="row">
									<div class="col s12 m5">
										<div class="build-category-choices" id="categoryChoices">
											<span>Item Categories</span>
											<?php foreach ($categories as $key => $cat): ?>
											<p>
												<input type="checkbox" id="<?= 'item_'.$cat['id']; ?>" class="filled-in checkbox-blue item-cats" />
												<label for="<?= 'item_'.$cat['id']; ?>" style="color: #fff;"><?= $cat['name']; ?></label>
											</p>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="col s12 m7">
										<div class="build-item-choices" id="buildItemChoices">
									
										</div>
									</div>
								</div>
							</div>
							<div class="col s12 m5">
								<div class="build-item-table">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
	    		<div class="col s12">
	    			<div class="price-display">
						<span id="packagePriceBuild"></span>
					</div>
				</div>
			</div>

	    	<div class="build-next2">
	    		<div class="row">
	    			<div class="col s6">
		    			<div class="prev-foods">
		    				<span><i class="fa fa-chevron-left"></i> BACK TO FOODS</span>
		    			</div>
		    		</div>
		    		<div class="col s6">
		    			<div class="next-summary">
		    				<span>SHOW SUMMARY <i class="fa fa-chevron-right"></i></span>
		    			</div>
		    		</div>
	    		</div>
			</div>
    	</div>

    	<div id="summary-parallax">
			<div class="build-summary">
				<h5>CUSTOM PACKAGE BUILD</h5>

				<div class="row">
					<div class="row" style="margin-left: 40px;">
						<div class="col s6 m6 build-summary-first">
							<h4>THEME: </h4>
							<h4>FOODS: </h4>
							<h4>ITEMS: </h4>
						</div>
						<div class="col s6 m4 build-summary-second">
							<h4 id="totalTheme">PHP 0.00 </h4>
							<h4 id="totalFoods">PHP 0.00 </h4>
							<h4 id="totalItems">PHP 0.00 </h4>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12 center">
						<h4 id="packagePriceBuild"></h4>
						<a id="btnSaveCustom">FINALIZE AND PROCEED</a>
					</div>
				</div>

				<div class="build-next3">
		    		<div class="row">
		    			<div class="prev-items">
		    				<span><i class="fa fa-chevron-left"></i> BACK TO ITEMS</span>
		    			</div>
		    		</div>
				</div>
			</div>
		</div>

    </div>

	<div id="foodModal" class="modal">
		<div class="modal-content">
			<div class="row">
				<div class="col s12 m6">
					<div class="item-detail-body">
						<h4 id="modalFoodName"></h4>
						<p id="modalFoodDesc"></p>
						<h5 id="modalFoodPrice"></h5>
						<small>PRICE PER TRAY </small>
						<input type="hidden" id="txtFoodPrice">
						<span id="modalFoodMaxQty" class="hide"></span>
						<input type="hidden" id="txtFoodID">
						<input type="hidden" id="txtMaxQty">

						<div class="row" style="margin-top: 25%;">
							<div class="col s12 m6">
								<div class="input-field">
						        	<input id="txtFoodQty" type="number" placeholder="QUANTITY">
						        	<span class="foodQtyError hide">Please provide quantity</span>
						        </div>
							</div>
							<div class="col s12 m6">
								<a id="btnAddFood">ADD FOOD</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m6">
					<img src="" id="modalFoodImage">
				</div>
			</div>
			
		</div>
	</div>

	<div id="itemModal" class="modal">
		<div class="modal-content">

			<div class="row">
				<div class="col s12 m6">
					<div class="item-detail-body">
						<h4 id="modalItemName"></h4>
						<h5 id="modalItemPrice"></h5>
						<small>PRICE PER ITEM </small>
						<input type="hidden" id="txtItemPrice">
						<input type="hidden" id="txtItemID">
						<input type="hidden" id="txtItemMaxQty">

						<div class="row" style="margin-top: 35%;">
							<div class="col s12 m6">
								<div class="input-field">
						        	<input id="txtItemQty" type="number" placeholder="QUANTITY">
						        	<span class="itemQtyError hide">Please provide quantity</span>
						        </div>
							</div>
							<div class="col s12 m6">
								<a id="btnAddItem">ADD ITEM</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m6">
					<img src="" id="modalItemImage">
				</div>
			</div>
			
		</div>
	</div>

	<div id="buildErrorModal" class="modal">
		<div class="modal-content">
			<h5 class="center" id="buildError" style="color: red;"></h5>
		</div>
	</div>

	<script type="text/javascript">
		var build = 1;
	</script>
<?= $footer; ?>
<script src="<?php echo base_url().'resources/js/build.js';?>" type="text/javascript"></script>