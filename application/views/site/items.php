<div class="row">
	<?php foreach ($items as $item): ?>
		<div class="col s12">
			<div class="item-click" data-id="<?= $item['id']; ?>" data-name="<?= $item['item_name']; ?>" data-image="<?= base_url().$item['image']['current_path']; ?>" data-price="<?= $item['price']; ?>" data-maxqty="<?= $item['quantity']; ?>">
				<div class="row" style="padding: 10px; margin-bottom: 5px!important;">
					<div class="col s8">
						<?= strtoupper($item['item_name']); ?>
					</div>
					<div class="col s4">
						PHP <?= number_format($item['price'], 2); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>