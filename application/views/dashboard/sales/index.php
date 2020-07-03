<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Sales
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#reportModal">REPORTS MODULE</button>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<div class="row">
							<div class="col-sm-6">
								<label>Month</label>
								<select id="salesMonth" class="form-control" style="width: 50%;">
									<option value="1">January</option>
									<option value="2">February</option>
									<option value="3">March</option>
									<option value="4">April</option>
									<option value="5">May</option>
									<option value="6">June</option>
									<option value="7">July</option>
									<option value="8">August</option>
									<option value="9">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
							</div>
						</div>
					</div>
					<div class="box-body">						
						<table id="salesTable" class="table table-bordered table-hover">
					        <thead>
					            <tr>
					            	<th>DATE OF EVENT</th>
					                <th>RESERVATION CODE</th>
					                <th>CUSTOMER NAME</th>
					                <th>PACKAGE NAME</th>
					                <th>TOTAL AMOUNT</th>
					            </tr>
					        </thead>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="reportModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sales Report</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="sales-report-area">
                                <label>YEAR: </label>
								<select id="salesYear" class="form-control"> 
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                                <br>
                                <label>MONTH: </label>
                                <select id="reportMonth" class="form-control">
                                    <option value="0">All</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <hr>
                                <p style="text-align: center;">OR</p><br>
                                <label>CUSTOM DATE RANGE: </label>
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-sm-6">
                                        <label>START: </label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" id="salesStartDateText">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <label>END: </label>
                                        <div class="input-group date" data-provide="datepicker" id="salesEndDate">
                                            <input type="text" class="form-control" id="salesEndDateText">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnGenerateSalesReport">GENERATE REPORT</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
				</div>
			</div>
		</div>
	</div>
<?= $admin_footer; ?>