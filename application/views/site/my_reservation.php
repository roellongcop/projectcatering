<?= $header; ?>
	<div class="parallax-container" style="height: 800px!important;">
    	<div class="parallax"><img src="<?= base_url(). 'resources/img/myreservation.jpeg'; ?>" style="filter: blur(5px);"></div>

    	<div class="my-reservation">
    		<div class="row">
    			<div class="col s12 m12">
    				<div class="inside">
    					<div class="input-field">
		    				<input type="text" id="reservation_code">
		    				<label>RESERVATION CODE: </label>
	    				</div>
	    				<div class="input-field">
		    				<input type="email" id="reservation_email">
		    				<label>EMAIL ADDRESS: </label>
	    				</div>

	    				<h5 class="res-error hide">Reservation does not exist.</h5>

	    				<h4 class="btnMyReservation">SEARCH RESERVATION</h4>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    
<?= $footer; ?>