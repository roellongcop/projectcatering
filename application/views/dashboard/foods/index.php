<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Foods
		<a class="btn btn-primary" href="<?= base_url() . 'foods/create'; ?>">Create new food</a>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewFoodCategories">View food categories</button>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Foods</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">
					<table id="foodTable" class="table table-bordered table-hover">
				        <thead>
				            <tr>
				            	<th>CATEGORY</th>
				                <th>NAME</th>
				                <th>PRICE</th>
				                <th>ACTION</th>
				            </tr>
				        </thead>
				    </table>
				</div>
			</div>
		</div>
	</section>

	<div id="viewFoodCategories" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Food Category</h4>
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
											<td><?= $val['category'] ?></td>
											<td><span class="delete deleteFoodCategory" data-id="<?= $val['id']; ?>"><i class="fa fa-trash"></i> delete</span></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFoodCategory">Add item category</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div id="addFoodCategory" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Food Category</h4>
				</div>
				<div class="modal-body">
					<h5>Food Category: </h5>
					<input type="text" id="food_category_name" class="form-control">
					<span class="food-category-error hide" style="color: red;">Please provide category</span>
				</div>
				<div class="modal-footer">
					<button id="btnSaveFoodCategory" type="button" class="btn btn-success">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<div id="preloader" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">	
					<h5>Loading..</h5>
				</div>
			</div>
		</div>
	</div>
<?= $admin_footer; ?>