<?= $header; ?>
	<div class="parallax-container" style="height: 700px;">
		<div class="parallax"><img src="<?= base_url(). 'resources/img/pages.jpg'; ?>"></div>

		<div class="container custom-package">
			<div class="row" style="margin-top: 30px;">
				<div class="col m6 center">
					<span style="font-size: 32px; color: #01579b;">TOTAL AMOUNT: </span><br>
				</div>
				<div class="col m6 center">
					<span style="font-size: 36px; color: #01579b;">PHP <?= number_format($cart_total, 2); ?></span><br>
					<input type="hidden" id="cart_count" value="<?= isset($cart_count) ? $cart_count : 0; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col s6">
					<div class="left-side">
						<a class="backToCategories hide"><i class="fa fa-chevron-up"></i> BACK TO CATEGORIES</a>
						<div class="row" id="customCategoriesArea">
							<h5 class="center">Pick a category then choose the items you want.</h5>
							<?php foreach ($categories as $key => $val): ?>
							<div class="col s3" style="height: 100px; display: table; margin-bottom: 10px;">
								<div class="custom-cat-box" data-id="<?= $val['id']; ?>">
									<span class="align-middle"><?= $val['name']; ?></span>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="row hide" id="customItemsArea">
						</div>
					</div>
				</div>
				<div class="col s12 m6">
					<?php if (isset($cart_items) && $cart_items != false): ?>
					<div class="custom-items-order">
						<table class="centered">
							<thead>
								<tr>
									<th style="width: 40%;">ITEM</th>
									<th>PRICE</th>
									<th>QTY</th>
									<th>SUB-TOTAL</th>
									<th style="width: 2%;">ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cart_items as $item): ?>
								<tr>
									<td><?= $item['name']; ?></td>
									<td><?= number_format($item['price'], 2); ?></td>
									<td><?= $item['quantity']; ?></td>
									<td><?= number_format($item['sub_total'], 2); ?></td>
									<td><span class="new badge red btnRemoveItem" data-id="<?= $item['item_id']; ?>">remove</span></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row" style="padding-bottom: 50px; margin-top: 50px;">
				<div class="col m12 center">
					<button class="btn btn-large" id="btnProceedCustom" style="background: #e67e22; width: 30%;"><i class="fa fa-shopping-basket" aria-hidden="true"></i> PROCEED TO CHECKOUT</button>
				</div>
			</div>
		</div>
	</div>

	<div id="itemQuantityModal" class="modal">
		<div class="modal-content center">
			<input type="hidden" id="customItemId">
			<input type="hidden" id="customItemName">
			<input type="hidden" id="customItemPrice">
			<input type="hidden" id="customMaxQty">
			<label>How many do you want?</label>
			<input type="number" id="customtxtItemQty" style="text-align: center; font-size: 24px;">
			<span class="qty-error hide" style="color: #e74c3c";>Please provide quantity</span><br><br>
			<a class="btnAddCustomItem">ADD TO CART</a>
		</div>
	</div>

	<div id="warningModal" class="modal">
		<div class="modal-content center">
			<h5 style="text-align: left; margin-top:0px!important; color: #d35400;">Heads up!</h5>
			<span id="warningMessage"></span>
		</div>
		<div class="modal-footer">
	    	<a href="#!" class="modal-action modal-close btn-flat">Okay</a>
	    </div>
	</div>
<?= $footer; ?>