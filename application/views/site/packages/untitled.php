<?= $header; ?>

<main>
	<section style="background-image: url(<?= base_url(). 'resources/img/baloons.jpg';?>); height: 180px;" class="center">
	</section>

	<div class="container-fluid center welcome-text">
		<h5>Welcome to Recto's Catering</h5>
	</div>

	<div class="container-fluid" style="padding-bottom: 1px;">
		<div class="row">
			<div class="col s9">
				<div class="carousel" style="margin-top: -80px;">
					<a class="carousel-item" href="#one!"><img src="<?= base_url() .'resources/img/1.jpg';?>"></a>
					<a class="carousel-item" href="#two!"><img src="<?= base_url() .'resources/img/2.jpg';?>"></a>
					<a class="carousel-item" href="#three!"><img src="<?= base_url() .'resources/img/3.jpg';?>"></a>
					<a class="carousel-item" href="#four!"><img src="<?= base_url() .'resources/img/4.jpg';?>"></a>
					<a class="carousel-item" href="#five!"><img src="<?= base_url() .'resources/img/5.jpg';?>"></a>
					<a class="carousel-item" href="#one!"><img src="<?= base_url() .'resources/img/6.jpg';?>"></a>
					<a class="carousel-item" href="#two!"><img src="<?= base_url() .'resources/img/7.JPG';?>"></a>
					<a class="carousel-item" href="#three!"><img src="<?= base_url() .'resources/img/8.JPG';?>"></a>
					<a class="carousel-item" href="#four!"><img src="<?= base_url() .'resources/img/9.jpg';?>"></a>
					<a class="carousel-item" href="#five!"><img src="<?= base_url() .'resources/img/10.jp';?>g"></a>
				</div>
			</div>
			<div class="col s3">
				<div class="yellow lighten-4 res-next-week">
					<h5>Up-coming reservations</h5>
					<?php foreach ($up_coming_res as $res): ?>
					<div class="res-block">
						<span><?= date_format(date_create($res['date_of_event']), 'F j, Y'); ?></span><br>
						<span><?= $res['customer_name']; ?></span>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container" style="padding-bottom: 100px; margin-top: 30px;">
		<div class="row center">
			<div class="col s6">
				<a class="waves-effect waves-light btn light-blue lighten-1" style="width: 100%;" id="btnSelectFrom">I would like to avail a package</a><br><br>
				<a class="waves-effect waves-light btn light-blue darken-1" style="width: 100%;" id="btnCustomize">I would like to build my own</a>
			</div>
			<div class="col s6 right-align" style="padding-right: 40px;">
				<span style="font-size: 18px;">Choose a date for your event!</span><br>
				<input type="text" class="datepicker center" id="event_date" style="width: 50%;"><br>
				<span style="color: red;" class="date-error hide">Please choose a date</span>
			</div>
		</div>

		<div class="row hide" id="event-area">
			<div class="events-top center">
				<h5 style="font-family: 'Norican', cursive; font-size: 32px;">What type of event are you going to have? </h5>
			</div>
			<?php foreach($events as $event): ?>
			<div class="col s4">
				<div class="card">
					<div class="card-image">
						<img src="<?= base_url() . $event['image']['current_path']; ?>">
						<span class="card-title event-title"><?= $event['name']; ?></span>
					</div>
					<div class="card-content">
						<p><?= $event['description']; ?></p>
					</div>
					<div class="card-action center view-packages-area" data-id="<?= $event['id']; ?>">
						<span class="view-packages">View Packages</span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>


		<div class="row hide" id="packages-area">
			<div class="row" id="packages-area-row">
				
			</div>
		</div>

	</div>


	<div id="packageModal" class="modal">
		<div class="modal-content">
			
		</div>
		<div class="modal-footer">
			<a href="#!" class="waves-effect waves-blue btn blue lighten-1 btnSelectPackage">SELECT THIS PACKAGE</a>
		</div>
	</div>
	<!-- <section style="background-image: url(<?= base_url(). 'resources/img/banner-bot.png';?>); height: 180px;">
	</section> -->
</main>

<script type="text/javascript">
	var home = 1;
</script>

<?= $footer; ?>