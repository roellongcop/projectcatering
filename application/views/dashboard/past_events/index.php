<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Past Events
		<a class="btn btn-primary" href="<?= base_url() . 'past-events/create'; ?>">Create new record</a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Past Events</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<?php if (! empty($this->session->flashdata('create_past_event'))): ?>
							<div class="alert alert-success">
								<?= $this->session->flashdata('create_past_event'); ?>
							</div>
						<?php endif; ?>
	                </div>
					<div class="box-body">
						<div class="row">
							<div class="error-past-events hide">
								<h5></h5>
							</div>
							<?php foreach ($past_events as $event): ?>
								<div class="col-md-3">
									<div class="past-events <?= $event['is_featured'] == 1 ? 'featured' : ''; ?>">
										<div class="past-event-image">
											<img src="<?= base_url() . $event['image']['current_path']; ?>" class="img-responsive">
										</div>
										<div class="past-event-details">
											<h3><?= $event['title']; ?></h3>
											<div class="past-action-buttons">
												<a class="past-event-info" href="<?= base_url(). 'past-events/' . $event['id']; ?>"><i class="fa fa-info-circle"></i> MORE INFORMATION</a>
												<?php if ($event['is_featured'] == 1): ?>
													<a class="remove-featured" data-id="<?= $event['id']; ?>">REMOVE FROM FEATURED</a>
												<?php else: ?>
													<a class="set-featured" data-id="<?= $event['id']; ?>"><i class="fa fa-star"></i> SET AS FEATURED EVENT</a>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?= $admin_footer; ?>