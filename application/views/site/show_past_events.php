<?= $header; ?>
<div class="parallax-container" style="height: 800px!important;">
	<div class="parallax"><img src="<?= base_url(). 'resources/img/past.jpeg'; ?>" style="filter: blur(5px);"></div>
	<div class="row" style="padding-top: 120px; padding-left: 50px; padding-right: 50px;">
		<?php foreach ($past_events as $event): ?>
			<div class="col s12 m3">
				<div class="card">
					<div class="card-image">
						<img src="<?= base_url() . $event['image']['current_path']; ?>">
					</div>
					<div class="card-content">
						<h5 class="past-event-page-title"><?= $event['title']; ?></h5>
						<br>
						<p><?= $event['additional_desc']; ?></p>
					</div>
					<div class="card-action center pastEventMore" data-id="<?= $event['id']; ?>">
						<span><i class="fa fa-info-circle"></i> SEE MORE</span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	</div>	

	<div id="pastEventModal" class="modal">
		<div class="modal-content">

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat">CLOSE</a>
		</div>
	</div>
</div>
<?= $footer; ?>