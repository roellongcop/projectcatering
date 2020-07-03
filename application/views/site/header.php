<!DOCTYPE html>
<html>
	<head>
		<title>Recto's Catering</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/Ionicons/css/ionicons.min.css'; ?>">
		<link rel="stylesheet" href="<?php echo base_url().'resources/materialize/css/materialize.css';?>" media="all">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'resources/font-awesome/css/font-awesome.min.css';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'resources/css/styles.css';?>">
	</head>
	<style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        body 
        {
            padding-top: 20px;
            background-color:#FFFFFF; 
            margin: 0px;  /* this affects the margin on the content before sending to printer */
       }
    </style>
	<body>
		<!-- <div class="navbar-fixed"> -->
			<nav class="nav-fixed transparent z-depth-0">
				<div class="nav-wrapper container">
					<a class="button-collapse" href="#" data-activates="slide-out" id="button-collapse"><i class="fa fa-bars fa-2x" style="margin-left: -100px!important;"></i></a>
					<a href="<?= base_url() . 'home'; ?>" class="brand-logo"><span>RECTO'S CATERING</span></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
				        <li><a href="<?= base_url() . 'home'; ?>"><span class="<?= isset($active_page) && $active_page == 'home' ? 'active-si-li' : ' ' ; ?>">HOME</span></a></li>
				        <li><a href="<?= base_url() . 'show-packages-area'; ?>"><span class="<?= isset($active_page) && $active_page == 'packages_area' ? 'active-si-li' : ' ' ; ?>">PACKAGES</span></a></li>
				        <li><a href="<?= base_url() . 'about'; ?>"><span class="<?= isset($active_page) && $active_page == 'about' ? 'active-si-li' : ' ' ; ?>">ABOUT US</span></a></li>
				        <li><a href="<?= base_url() . 'clients/events'; ?>"><span class="<?= isset($active_page) && $active_page == 'past_events' ? 'active-si-li' : ' ' ; ?>">PAST EVENTS</span></a></li>
				        <li><a href="<?= base_url() . 'my-reservation'; ?>"><span class="<?= isset($active_page) && $active_page == 'res' ? 'active-si-li' : ' ' ; ?>">MY RESERVATION</span></a></li>
			      	</ul>
				</div>
			</nav>
		<!-- </div> -->

		<ul id="slide-out" class="side-nav">
			<li><a href="<?= base_url() . 'home'; ?>"><span class="<?= isset($active_page) && $active_page == 'home' ? 'active-si-li' : ' ' ; ?>">HOME</span></a></li>
	        <li><a href="<?= base_url() . 'show-packages-area'; ?>"><span class="<?= isset($active_page) && $active_page == 'packages_area' ? 'active-si-li' : ' ' ; ?>">PACKAGES</span></a></li>
	        <li><a href="<?= base_url() . 'about'; ?>"><span class="<?= isset($active_page) && $active_page == 'about' ? 'active-si-li' : ' ' ; ?>">ABOUT US</span></a></li>
	        <li><a href="<?= base_url() . 'clients/events'; ?>"><span class="<?= isset($active_page) && $active_page == 'past_events' ? 'active-si-li' : ' ' ; ?>">PAST EVENTS</span></a></li>
	        <li><a href="<?= base_url() . 'my-reservation'; ?>"><span class="<?= isset($active_page) && $active_page == 'res' ? 'active-si-li' : ' ' ; ?>">MY RESERVATION</span></a></li>
		</ul>

		<main>
