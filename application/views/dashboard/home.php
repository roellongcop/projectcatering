<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Dashboard
		<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>
						<?= $count_next_week_events; ?>
						</h3>
						<p>
							Reservations Next Week
						</p>
					</div>
					<div class="icon">
						<i class="ion ion-calendar"></i>
					</div>
					<a href="<?= base_url() . 'reservations'; ?>" class="small-box-footer">
						More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>
						<?= $total_reservations; ?>
						</h3>
						<p>
							Total Reservations
						</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="<?= base_url() . 'reservations'; ?>" class="small-box-footer">
						More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>
						<?= $total_packages; ?>
						</h3>
						<p>
							Total Packages
						</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="<?= base_url() . 'packages'; ?>" class="small-box-footer">
						More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>	
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>
						<?= $total_items; ?>
						</h3>
						<p>
							Items Inventory
						</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?= base_url() . 'items'; ?>" class="small-box-footer">
						More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="event-today <?= (! is_null($event_today) && $event_today['event_completed']) ? 'e-completed' : ''; ?>">
						<h4>TODAY'S EVENT</h4>
						<?php if (! is_null($event_today)): ?>
							<div class="row">
								<div class="col-md-6" style="padding-left: 20px;">
									<small>Reservation code:</small> 
									<h3><a href="<?= base_url(). 'reservations/' . $event_today['id']; ?>"><?= $event_today['reservation_code']; ?></a></h3>
									<small>Customer name:</small> 
									<h5><?= $event_today['customer_name']; ?></h5>
									<small>Customer contact:</small> 
									<h5><?= $event_today['customer_contact']; ?></h5>
									<small>Customer address:</small> 
									<h5><?= $event_today['customer_address']; ?></h5>
									<input type="hidden" id="hidden_date_of_event" value="<?= $event_today['date_of_event']; ?>">
									
								</div>
								<div class="col-md-6">
									<div class="today-details">
										<h4>Package: <?= ($event_today['package'] == null ? 'Custom Package' : $event_today['package']); ?></h4>
										<h4>Total Amount: </h4>
										<h4 style="text-align: center; font-weight: bolder;">PHP <?= number_format($event_today['total_amount'], 2); ?></h4>
										<?php if ($event_today['event_completed'] == false): ?>
											<button class="btn btn-success" id="btnMarkComplete" data-id="<?= $event_today['id']; ?>">Mark as complete <i class="fa fa-check"></i></button>
										<?php else: ?>
											<h2>EVENT COMPLETED</h2>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div style="background: #F3F3F3; text-align: center; padding: 80px;">
								<h5 style="font-size: 30px; color: #D7D7D7;">NO EVENT FOR TODAY</h5>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box">
					<div class="next-week-events">
						<h4>EVENTS THIS WEEK</h4>
						<?php if (! empty($next_week_events)): ?>
							<?php foreach ($next_week_events as $event): ?>
								<div class="next-event-block">
									<div class="row">
										<div class="col-md-8">
											<h5><?= date_format(date_create($event['date_of_event']), 'F j, Y'); ?> 
												- <?= empty($event['package']) ? ' Custom Package' : $event['package']; ?>
											</h5>
											<span style="font-size: 15px; color: #0D527F;"><?= $event['customer_name']; ?> | # <?= $event['customer_contact']; ?> | <?= $event['customer_address']; ?></span>
										</div>
										<div class="col-md-4" style="text-align: right;">
											<h5>PHP <?= number_format($event['total_amount'], 2); ?></h5>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div style="background: #F3F3F3; text-align: center; padding: 80px;">
								<h5 style="font-size: 30px; color: #D7D7D7;">NO UPCOMING EVENTS</h5>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
				<li><a href="#sales-tab" data-toggle="tab"> <i class="fa fa-dollar-sign"></i> Income</a></li>
				<li class="active"><a href="#reservations-tab" data-toggle="tab">Reservations</a></li>
				<li class="pull-left header"><i class="fa fa-inbox"></i> Statistics</li>
			</ul>
			<div class="tab-content">
				<div class="chart tab-pane" id="sales-tab" style="position: relative; height: 400px;">
					<button class="btn btn-primary print-sales">DOWNLOAD AS IMAGE</button>
					<canvas id="sales-chart" width="400" height="120"></canvas>
				</div>
				<div class="chart tab-pane active" id="reservations-tab" style="position: relative; height: 400px;">
					<button class="btn btn-primary print-res">DOWNLOAD AS IMAGE</button>
					<canvas id="myChart" width="400" height="120"></canvas>
				</div>
			</div>
		</div>

	</section>

<script type="text/javascript">
	var home = 1;
</script>
<?= $admin_footer; ?>