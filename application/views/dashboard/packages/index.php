<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Packages
		<a href="<?= base_url() . 'packages/create'; ?>" class="btn btn-primary">Create new package</a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Packages</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">List of packages</h3>
					</div>
					<div class="box-body">
						<table id="packagesTable" class="table table-bordered table-hover">
					        <thead>
					            <tr>
					            	<th>EVENT</th>	
					                <th>NAME</th>
					                <th>PRICE</th>
					                <th>PAX</th>
					                <th>STAFFS</th>
					                <th>ACTION</th>
					            </tr>
					        </thead>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</section>

<?= $admin_footer; ?>