<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Items
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewCategories">View categories</button>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItem">Add new item</button>
		<button type="button" class="btn btn-primary pull-right" id="itemsReport">Generate Inventory Report</button>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">List of items</h3>
					</div>
					<div class="box-body">
						<table id="itemsTable" class="table table-bordered table-hover">
					        <thead>
					            <tr>
					                <th>CATEGORY</th>
					                <th>ITEM NAME</th>
					                <th>QUANTITY (Pieces)</th>
					                <th>PRICE PER PIECE</th>
					                <th>ACTION</th>
					            </tr>
					        </thead>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</section>

<div id="viewCategories" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Item Category</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>CATEGORY</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($categories as $val): ?>
									<tr>
										<td><?= $val['name'] ?></td>
										<td><span class="delete deleteCategory" data-id="<?= $val['id']; ?>">delete</span></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">Add item category</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="addCategory" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Item Category</h4>
			</div>
			<div class="modal-body">
				<h5>Category Name: </h5>
				<input type="text" id="category_name" class="form-control">
				<span class="category-error hide" style="color: red;">Please provide category</span>
			</div>
			<div class="modal-footer">
				<button id="btnSaveCategory" type="button" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div id="addItem" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Item</h4>
			</div>
			<div class="modal-body add-item-modal">
				<div class="error-div hide">
				</div>
				<h5>Choose Item Category: </h5>
				<select id="item_category" class="form-control">
					<?php foreach ($categories as $cat): ?>
						<option value="<?= $cat['id']; ?>"><?= ucfirst($cat['name']); ?></option>
					<?php endforeach; ?>
				</select>
				<br>
				<h5>Item Name: </h5>
				<input type="text" id="item_name" class="form-control">
				<br>
				<h5>Item Quantity: </h5>
				<input type="number" id="quantity" class="form-control" min="1">
				<br>
				<h5>Price Per Item: </h5>
				<input type="number" id="item_price" class="form-control">
				<br>
				<h5>Item Image</h5>
				<input type="file" id="item_image" size="20" class="form-control" /><br>
				<img src="" id="item_preview" class="img-responsive">
			</div>
			<div class="modal-footer">
				<button id="btnSaveItem" type="button" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div id="updateItem" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Item</h4>
			</div>
			<div class="modal-body">
				<div class="error-div hide">
				</div>
				<h5>Choose Item Category: </h5>
				<select id="update_item_category" class="form-control">
					<?php foreach ($categories as $cat): ?>
						<option value="<?= $cat['id']; ?>"><?= ucfirst($cat['name']); ?></option>
					<?php endforeach; ?>
				</select>
				<br>
				<h5>Item Name: </h5>
				<input type="text" id="update_item_name" class="form-control">
				<br>
				<h5>Item Quantity: </h5>
				<input type="number" id="update_quantity" class="form-control" min="1">
				<br>
				<h5>Price Per Item: </h5>
				<input type="number" id="update_item_price" class="form-control">
				<div class="error-box hide"></div>
				<br>
				<h5>Item Image</h5>
				<input type="file" id="update_item_image" size="20" class="form-control" /><br>
				<img src="" id="update_item_preview" class="img-responsive">
			</div>
			<div class="modal-footer">
				<input type="hidden" id="itemId">
				<button id="btnUpdateItem" type="button" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<?= $admin_footer; ?>