<?= $header; ?>
	
	<div class="parallax-container" style="height: 950px!important;">
    	<div class="parallax"><img src="<?= base_url(). $event['image']['current_path']; ?>" style="filter: blur(5px);"></div>

    	<div class="event-master">
    		<div class="row">
				<div class="col s12">
					<h4><?= $event['name']; ?> Packages</h4>
					<div class="row">
						<?php foreach ($packages as $key => $value): ?>
							<div class="col s3">
								<div class="card">
									<div class="card-image">
										<img src="<?= base_url() . $value['image']['current_path']; ?>">
										<span class="card-title package-title"><?= $value['name']; ?></span>
									</div>
									<div class="card-content package-content">
										<div class="row">
											<div class="col s12">
												<h5 class="center" style="margin-top: 0px; color: #e67e22;">PHP <?= number_format($value['price'], 2); ?></h5>
											</div>
										</div>
										<div class="row">
											<div class="col s12 center">
												<a href="<?= base_url(). 'site/package/'.$value['id']; ?>" class="view-package-info">MORE INFORMATION</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>	
    	</div>
    </div>
<?= $footer; ?>