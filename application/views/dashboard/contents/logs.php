<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		System Logs
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Logs</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">
					<table id="logsTable" class="table table-bordered table-hover">
				        <thead>
				            <tr>
				            	<th>#</th>
				            	<th>MODULE</th>
				                <th>ADMIN</th>
				                <th>DATETIME</th>
				            </tr>
				        </thead>
				    </table>
				</div>
			</div>
		</div>
	</section>

<?= $admin_footer; ?>