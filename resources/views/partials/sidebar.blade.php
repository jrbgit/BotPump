<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form-->
        <!-- /.search form -->

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
                    <li class="{{ request()->is('profit/pair*') ? 'active' : '' }}"><a href="{{ url('profit/pair') }}"><i class="fa fa-circle-o"></i> Profit by Pair</a></li>
                    <li class="{{ request()->is('profit/bot*') ? 'active' : '' }}"><a href="{{ url('profit/bot') }}"><i class="fa fa-circle-o"></i> Profit by Bot</a></li>
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
                    <li class="treeview {{ request()->is('calculator/longBot*') ? 'active menu-open' : '' }}">
                        <a href="#"><i class="fa fa-circle-o"></i>Long Bot
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->is('calculator/longBot/spreadsheet*') ? 'active' : '' }}"><a href="{{ url('calculator/longBot/spreadsheet') }}"><i class="fa fa-circle-o"></i>Spreadsheet</a></li>
                        </ul>
                    </li>

                    <li class="treeview {{ request()->is('calculator/shortBot*') ? 'active menu-open' : '' }}">
                        <a href="#"><i class="fa fa-circle-o"></i>Short Bot
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->is('calculator/shortBot/spreadsheet*') ? 'active' : '' }}"><a href="{{ url('calculator/shortBot/spreadsheet') }}"><i class="fa fa-circle-o"></i>Spreadsheet</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>