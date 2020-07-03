<div class="container" id="packages-area">
	<div class="row">
		<?php if (! empty($packages)): ?>
			<?php foreach ($packages as $key => $value): ?>
				<div class="col s3">
					<div class="card">
						<div class="card-image">
							<img src="<?= base_url() . $value['image']['current_path']; ?>">
							<span class="card-title package-title"><?= $value['name']; ?></span>
						</div>
						<div class="card-content orange darken-1 package-content">
							<div class="row">
								<div class="col s5">
									<span>Amount: </span><br>
									<span>Good For: </span><br>
									<span>Staffs: </span><br>
								</div>
								<div class="col s7">
									<span>PHP <?= $value['price']; ?></span><br>
									<span><?= $value['pax'] ?></span><br>
									<span><?= $value['staff_needed']; ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col s12 center">
									<a class="waves-effect waves-light btn amber lighten-4 view-package-info" data-id="<?= $value['id']; ?>" style="color: #e65100;">more information</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="col s12">
				<div style="display: block; margin: 30px auto; background: #FFF5ED; padding: 15px;">
					<h5 style="text-align: center; color: #d35400;">Sorry, there no available package for this event right now.</h5>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>