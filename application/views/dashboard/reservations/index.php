<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Reservations
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#resReportModal">REPORTS MODULE</button>
		</h1>
	</section>
	<section class="content">
	    <div class="row">
	        <div class="col-xs-12">
	            <div class="box">
	            	<div class="box-header">

	            	</div>
	            	<div class="box-body">
	            		<div class="nav-tabs-custom">
			                <ul class="nav nav-tabs">
			                    <li class="active" style="width: 33%; text-align: center;"><a href="#tab_1" data-toggle="tab" style="color: #2c3e50; font-weight: bold;">PENDING RESERVATIONS <div class="circle"><span><?= $count_pending; ?></span></div></a></li>
			                    <li style="width: 33%; text-align: center;"><a href="#tab_2" data-toggle="tab" style="color: #3498db; font-weight: bold;">CONFIRMED RESERVATIONS <div class="circle circle-confirmed"><span><?= $count_confirmed; ?></span></div></a></li>
			                    <li style="width: 32%; text-align: center;"><a href="#tab_3" data-toggle="tab" style="color: #e74c3c; font-weight: bold;">REJECTED RESERVATIONS <div class="circle circle-reject"><span><?= $count_rejected; ?></span></div></a></li>
			                </ul>
			                <div class="tab-content">
			                    <div class="tab-pane active" id="tab_1">
			                    	<div class="row">
			                    		<div class="col-md-12">
											<table id="pendingReservations" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th style="text-align: left;">CUSTOMER NAME</th>
														<th>CONTACT NO.</th>
														<th>PACKAGE</th>
														<th>DATE OF EVENT</th>
														<th>STATUS</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
			                    		</div>
			                    	</div>
			                    </div>
			                    <div class="tab-pane" id="tab_2">
			                        <div class="row">
			                    		<div class="col-md-12">
											<table id="confirmedReservations" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>CUSTOMER NAME</th>
														<th>CONTACT NO.</th>
														<th>PACKAGE</th>
														<th>DATE OF EVENT</th>
														<th>STATUS</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
			                    		</div>
			                    	</div>
			                    </div>
			                    <div class="tab-pane" id="tab_3">
			                        <div class="row">
			                    		<div class="col-md-12">
											<table id="rejectedReservations" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>CUSTOMER NAME</th>
														<th>CONTACT NO.</th>
														<th>PACKAGE</th>
														<th>DATE OF EVENT</th>
														<th>STATUS</th>
														<th>ACTION</th>
													</tr>
												</thead>
											</table>
			                    		</div>
			                    	</div>
			                    </div>
			                </div>
			            </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</section>


	<div id="resReportModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="sales-report-area">
								<label>RESERVATION STATUS: </label>
								<select id="resStatus" class="form-control"> 
                                    <option value="1">All</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Confirmed</option>
                                    <option value="4">Rejected</option>
                                </select>
                                <br>
                                <label>YEAR: </label>
								<select id="resYear" class="form-control"> 
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                                <br>
                                <label>MONTH: </label>
                                <select id="resMonth" class="form-control">
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
                                            <input type="text" class="form-control" id="resStartDateText">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <label>END: </label>
                                        <div class="input-group date" data-provide="datepicker" id="resEndDate">
                                            <input type="text" class="form-control" id="resEndDateText">
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
					<button type="button" class="btn btn-success" id="btnGenerateResReport">GENERATE REPORT</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?= $admin_footer; ?>