<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Themes
		<a class="btn btn-primary" href="<?= base_url() . 'themes/create'; ?>">Create new theme</a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Themes</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">
					<table id="themesTable" class="table table-bordered table-striped">
				        <thead>
				            <tr>
				                <th>NAME</th>
				                <th>DESCRIPTION</th>
				                <th>ACTION</th>
				            </tr>
				        </thead>
				    </table>
				</div>
			</div>
		</div>
	</section>
<?= $admin_footer; ?>