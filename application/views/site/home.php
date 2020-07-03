<?= $header; ?>
	
	<div class="parallax-container" style="height: 900px!important;">
    	<div class="parallax"><img src="<?= base_url(). 'resources/img/pexels-photo-54296.jpeg'; ?>" style="filter: blur(10px);"></div>

    	<div class="home-master">
    		<div class="row">
    			<div class="col s12">
    				<h3 class="home-header1">Welcome to </h3>
    				<h5 class="home-header2">Recto's Catering!</h5>
    			</div>
    		</div>
    	</div>
    </div>

	<div class="parallax-container" style="height: 800px; padding-bottom: 100px;" style="overflow-y: auto;">
    	<div class="parallax"><img src="<?= base_url(). 'resources/img/bot.jpg'; ?>" style="filter: blur(10px);"></div>

    	<div class="col s12">
			<h4 style="text-align: center; color: #fff;">EVENTS </h4>
			<div class="row">
				<?php foreach ($events as $event): ?>
					<div class="col s12 m4 center">
						<img src="<?= base_url() . $event['image']['current_path']; ?>" class="responsive-img event-img">
						<a><h5 class="event-link"><?= strtoupper($event['name']); ?></h5></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
    </div>

	<div id="packageModal" class="modal">
		<div class="modal-content">
		</div>
		<div class="modal-footer">
			<a class="btnSelectPackage">SELECT THIS PACKAGE</a>
		</div>
	</div>

	<div id="pastEventModal" class="modal">
		<div class="modal-content">

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat">CLOSE</a>
		</div>
	</div>

	<script type="text/javascript">
		var home = 1;
	</script>
<?= $footer; ?>