<?= $header; ?>
<div class="container" style="padding-bottom: 100px; margin-top: 80px;">
	<div class="row">
		<div class="col s12 center">
			<img src="<?= base_url(). 'resources/img/logo.jpg'; ?>" class="responsive-img" style="width: 400px; height: auto;" /><br><br>
			<span style="color:#4e342e; font-size: 18px;"><?= (! empty($about)) ? '<i class="fa fa-phone-square" aria-hidden="true"></i> Contact No.: ' . $about['contact_no'] : '' ; ?></span><br>
			<span style="color:#4e342e; font-size: 18px;"><?= (! empty($about)) ? '<i class="fa fa-map-marker" aria-hidden="true"></i> ' . $about['address'] : ''; ?></span>
			<br><br>
			<p style="font-size: 16px;">
				<?= (! empty($about)) ? $about['display'] : ''; ?>
			</p>
		</div>
	</div>	
</div>
<?= $footer; ?>