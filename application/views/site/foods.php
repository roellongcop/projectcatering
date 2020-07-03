<div class="row">
	<?php foreach ($foods as $food): ?>
		<div class="col s12">
			<div class="food-click" data-id="<?= $food['id']; ?>" 
				data-name="<?= $food['name']; ?>" 
				data-price="<?= $food['price']; ?>" 
				data-image="<?= base_url(). $food['image']['current_path']; ?>"
				data-description="<?= $food['description']; ?>">
				<div class="row" style="padding: 10px; margin-bottom: 5px!important;">
					<div class="col s8">
						<?= strtoupper($food['name']); ?>
					</div>
					<div class="col s4">
						PHP <?= number_format($food['price'], 2); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>