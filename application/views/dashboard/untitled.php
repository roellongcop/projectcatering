<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left info">
                            <p>Hello, Jane</p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?= isset($active_page) && $active_page == 'home' ? 'active' : ' ' ; ?>">
                            <a href="<?= base_url() . 'dashboard'; ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?= isset($active_page) && $active_page == 'events' ? 'active' : ' ' ; ?>">
                            <a href="<?= base_url() . 'events'; ?>">
                                <i class="fa fa-th"></i> <span>Events</span>
                            </a>
                        </li>
                        <li class="<?= isset($active_page) && $active_page == 'items' ? 'active' : ' ' ; ?>">
                            <a href="<?= base_url() . 'items'; ?>">
                                <i class="fa fa-th"></i> <span>Items</span>
                            </a>
                        </li>
                        <li class="<?= isset($active_page) && $active_page == 'packages' ? 'active' : ' ' ; ?>">
                            <a href="<?= base_url() . 'packages'; ?>">
                                <i class="fa fa-th"></i> <span>Packages</span>
                            </a>
                        </li>
                        <li class="<?= isset($active_page) && $active_page == 'reservations' ? 'active' : ' ' ; ?>">
                            <a href="<?= base_url() . 'reservations'; ?>">
                                <i class="fa fa-th"></i> <span>Reservations</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>