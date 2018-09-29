<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!--li class="header">HEADER</li-->
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ request()->is('profit*') ? 'active menu-open' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Profit</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="#"><i class="fa fa-calendar"></i> Profit by Date</a></li>
                    <li class="{{ request()->is('profit/pair*') ? 'active' : '' }}"><a href="{{ url('profit/pair') }}"><i class="fa fa-clone"></i> Profit by Pair</a></li>
                    <li class="{{ request()->is('profit/bot*') ? 'active' : '' }}"><a href="{{ url('profit/bot') }}"><i class="fa fa-server"></i> Profit by Bot</a></li>
                </ul>
            </li>
            <li class="{{ request()->is('calculator*') ? 'active menu-open' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-calculator"></i>
                    <span>Bot Calculator</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('calculator/longBot*') ? 'active' : '' }}"><a href="{{ url('calculator/longBot') }}"><i class="fa fa-arrow-circle-up"></i> Long Bot</a></li>
                    <li class="{{ request()->is('calculator/shortBot*') ? 'active' : '' }}"><a href="{{ url('calculator/shortBot') }}"><i class="fa fa-arrow-circle-down"></i> Short Bot</a></li>
                </ul>
            </li>
            <!--li class="{{ request()->is('inspector*') ? 'active menu-open' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-search"></i>
                    <span>Bot Inspector</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('inspector/newmenuitem*') ? 'active' : '' }}"><a href="{{ url('inspector/thelink') }}"><i class="fa fa-gears"></i> Pair Settings</a></li>
                    <li class="{{ request()->is('calculator/shortBot*') ? 'active' : '' }}"><a href="{{ url('calculator/shortBot') }}"><i class="fa fa-clock-o"></i> Length</a></li>
                    <li class="{{ request()->is('calculator/shortBot*') ? 'active' : '' }}"><a href="{{ url('calculator/shortBot') }}"><i class="fa fa-life-ring"></i> Safeties</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-question-circle"></i>
                    <span>Help</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-telegram"></i>
                    <span>Suggestions</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-thumbs-up"></i>
                    <span>Donate</span>
                </a>
            </li-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>