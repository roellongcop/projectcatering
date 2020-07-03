
<div class="row">
	<div class="col s12">
		<div class="past-event-modal">
			<img src="<?= base_url() . $event['image']['current_path']; ?>">
			<h5><?= ucfirst($event['title']); ?></h5>
			<p><?= strtoupper($event['additional_desc']); ?></p>
			<br>
			<p><?= $event['description']; ?></p>
		</div>
	</div>
</div>

