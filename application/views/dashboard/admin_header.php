<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recto's Catering</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/Ionicons/css/ionicons.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'resources/dist/css/AdminLTE.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/dist/css/skins/skin-blue.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/css/dashboard.css'; ?>">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
        
        <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
                <!-- Main Header -->
                <header class="main-header">
                    <!-- Logo -->
                    <a href="<?= base_url() . 'dashboard'; ?>" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>A</b>LT</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Recto's </b> Catering</span>
                    </a>
                    <!-- Header Navbar -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span><?= $this->session->userdata('user')['full_name']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?= base_url(). 'dashboard/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <p><?= $this->session->userdata('user')['full_name']; ?></p>
            </div>
              <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="<?= isset($active_page) && $active_page == 'home' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'dashboard'; ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'events' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'events'; ?>">
                        <i class="fa fa-birthday-cake"></i> <span>Events</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'themes' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'themes'; ?>">
                        <i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i><span>Themes</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'foods' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'foods'; ?>">
                        <i class="glyphicon glyphicon-star" aria-hidden="true"></i><span>Foods</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'packages' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'packages'; ?>">
                        <i class="glyphicon glyphicon-gift" aria-hidden="true"></i> <span>Packages</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'items' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'items'; ?>">
                        <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i><span>Items</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'venues' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'venues'; ?>">
                        <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i><span>Venues</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'reservations' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'reservations'; ?>">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>Reservations <span class="badge" id="resBadge"></span></span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'sales' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'sales'; ?>">
                        <i class="fa fa-briefcase"></i><span>Sales</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'past-events' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'past-events'; ?>">
                        <i class="fa fa-camera"></i><span>Past Events Slider</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'contents' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'contents'; ?>">
                        <i class="fa fa-asterisk"></i><span>About Us</span>
                    </a>
                </li>
                <li class="<?= isset($active_page) && $active_page == 'logs' ? 'active' : ' ' ; ?>">
                    <a href="<?= base_url() . 'admin-logs'; ?>">
                        <i class="fa fa-file"></i><span>System Logs</span>
                    </a>
                </li>
                <!-- <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul> -->
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


