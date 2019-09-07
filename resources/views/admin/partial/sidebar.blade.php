<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ url('admincp') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admincp/category') }}">
                    <i class="fa fa-list"></i> <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admincp/product') }}">
                    <i class="fa fa-th"></i> <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admincp/orders') }}">
                    <i class="fa fa-th"></i> <span>Orders</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
