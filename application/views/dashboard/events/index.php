<?= $admin_header; ?>

	<section class="content-header">
		<h1>
		Events
		<a class="btn btn-primary" href="<?= base_url() . 'events/create'; ?>">Create new event</a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Events</a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">
						<?php foreach ($events as $event): ?>
							<div class="col-md-4">
								<div class="events">
									<div class="event-image">
										<img src="<?= base_url() . $event['image']['current_path']; ?>" class="img-responsive">
									</div>
									<div class="event-details">
										<h3><?= $event['name']; ?></h3>
										<a href="<?= base_url(). 'events/' . $event['id']; ?>" class="btn btn-default">MORE INFO</a>
										<?php if (! $event['is_deleted']): ?>
											<button class="btn btn-danger deleteEvent" data-id="<?= $event['id']; ?>">SET AS UNAVAILABLE</button>
										<?php else: ?>
											<button class="btn btn-success activateEvent" data-id="<?= $event['id']; ?>">SET AS AVAILABLE</button>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?= $admin_footer; ?>