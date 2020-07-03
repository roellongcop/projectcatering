<?= $header; ?>
	
	<div class="parallax-container" style="height: 1100px!important;">
    	<div class="parallax"><img src="<?= base_url(). 'resources/img/home2.jpeg'; ?>" style="filter: blur(5px);"></div>

    	<div class="package-master center">
    		<h3 style="margin-bottom: 0px!important;"><?= $package['name']; ?></h3>
    		<p style="text-align: center; color: #FFF;"><?= $package['description']; ?></p>
    		<div class="row" style="margin-top: 30px;">
    			<div class="col s12 m6 package-img">
					<img src="<?= base_url() . $package['image']['current_path']; ?>" class="responsive-img">
				</div>
				<div class="col s12 m6">
					<div class="package-description">
						<span><i class="fa fa-check" style="color: #e67e22;"></i> Includes <?= $package['staff_needed']; ?> event staffs </span><br>
						<span><i class="fa fa-check" style="color: #e67e22;"></i> Good for <?= $package['pax']; ?> PAX </span><br>
						<span><i class="fa fa-check" style="color: #e67e22;"></i> <?= $food_count?> food menus </span><br><br>
						<input type="text" class="datepicker event_date" placeholder="CHOOSE YOUR EVENT DATE">
						<div class="row calendar-legend">
							<div class="col s6 cal-available">
								<span style="font-size: 16px;">Available</span>
							</div>
							<div class="col s6 cal-full">
								<span style="font-size: 16px;">Reserved</span>
							</div>
						</div>
						<br>
						<!-- <span class="date-error hide" style="color: red; text-transform: lowercase;">Please provide your date</span> -->
						<h3>PHP <?= number_format($package['price'], 2); ?></h3>
						<a class="choose-package btnSelectPackage right" data-id="<?= $package['id']; ?>">CHOOSE THIS PACKAGE</a>
					</div>
				</div>
    		</div>
    	</div>

    	<div class="row" style="margin-top: 0px;">
    		<div class="col s12">
				<div class="package-foods">
					<h4 class="center" style="color: #fff;">PACKAGE MENU: </h4>
					<?php foreach ($package['foods'] as $key => $food): ?>
						<div class="col s12 m3">
							<div class="card">
								<div class="card-image food-image">
									<?php if (isset($food['image'])): ?>
										<img src="<?= base_url(). $food['image']['current_path']; ?>">
									<?php else: ?>
										<img src="" alt="Image not found">
									<?php endif; ?>
									<span class="card-title" style="font-size: 16px;"><?= $food['quantity'] . ' tray(s) -'; ?> <?= $food['name']; ?> </span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
    	</div>
    </div>

    <div class="row" style="height: 80px; background: #fff; margin-bottom: 0px;">
    </div>

	<div class="parallax-container" style="height: 1000px!important;">
    	<div class="parallax"><img src="<?= base_url(). 'resources/img/bot3.jpg'; ?>" style="filter: blur(5px);"></div>

    	<div class="row">
    		<div class="col s12">
    			<div class="package-theme">
    				<h4 class="center" style="color: #e67e22;">PACKAGE THEME </h4>
					<div class="card">
						<div class="card-image">
							<img src="<?= base_url() . $package['theme_image']['current_path']; ?>">
							<span class="card-title activator tooltipped" data-position="top" data-delay="50" data-tooltip="Click to view theme description"><?= strtoupper($package['theme']); ?></span>
						</div>
						<div class="card-reveal">
					    	<span class="card-title" style="background: #FFF; color: #000;"><?= strtoupper($package['theme']); ?><i class="fa fa-times right"></i></span>
					    	<p><?= $package['theme_desc']; ?></p>
					    </div>
					</div>
    			</div>
    		</div>
    	</div>
    		
    	<div class="row">
			<div class="col s12">
			<div class="package-items">
					<h4 class="center" style="color: #fff;">PACKAGE ITEMS/INCLUSIONS: </h4>
					<?php foreach ($package['items'] as $key => $item): ?>
						<div class="col s12 m3">
							<div class="card">
								<div class="card-image package-item-img">
									<img src="<?= base_url(). $item['image']['current_path']; ?>">
									<span class="card-title" style="font-size: 16px;"><?= $item['quantity'] . ' piece(s) -'; ?> <?= $item['name']; ?> </span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

    </div>

	<script type="text/javascript">
		var package_details = 1;
	</script>

<?= $footer; ?>