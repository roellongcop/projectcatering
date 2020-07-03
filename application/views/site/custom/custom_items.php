<div class="row" id="customItemsArea">

	<table class="table striped centered">
		<thead>
			<th>ITEM NAME</th>
			<th>PRICE PER ITEM</th>
			<th>ACTION</th>
		</thead>
		<tbody>
			<?php foreach ($item as $val): ?>
				<tr>
					<td><?= $val['item_name']; ?></td>
					<td><?= number_format($val['price'], 2); ?></td>
					<td><a data-id="<?= $val['id']; ?>" data-name="<?= $val['item_name']; ?>" data-price="<?= $val['price']; ?>" data-maxqty="<?= $val['quantity']; ?>" class="customItem">ADD TO CART</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>