<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset(\Auth::User()->getImageProfile()) }}" class="img-circle img-user" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ \Auth::User()->getFullname() }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu hidden" id="menu-utama">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ \Auth::User()->grantAccess('dashboards') }}"><a href="{{ route('dashboards.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('profiles.index') }}"><i class="fa fa-user-plus"></i> <span>Profile</span></a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tags"></i> <span>References</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('banks') }}"><a href="{{ route('banks.index') }}"><i class="fa fa-circle-o"></i> Bank</a></li>
                <li class="{{ \Auth::User()->grantAccess('drivers') }}"><a href="{{ route('drivers.index') }}"><i class="fa fa-circle-o"></i> Driver</a></li>
                <li class="{{ \Auth::User()->grantAccess('identities') }}"><a href="{{ route('identities.index') }}"><i class="fa fa-circle-o"></i> Identity</a></li>
                <li class="{{ \Auth::User()->grantAccess('fuels') }}"><a href="{{ route('fuels.index') }}"><i class="fa fa-circle-o"></i> Fuel</a></li>
                <li class="{{ \Auth::User()->grantAccess('services') }}"><a href="{{ route('services.index') }}"><i class="fa fa-circle-o"></i> Service</a></li>
                <li class="{{ \Auth::User()->grantAccess('status') }}"><a href="{{ route('status.index') }}"><i class="fa fa-circle-o"></i> Status</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('customer_files') }}"><a href="{{ route('customer_files.index') }}"><i class="fa fa-circle-o"></i> Attachment</a></li>
                <li class="{{ \Auth::User()->grantAccess('customer_contacts') }}"><a href="{{ route('customer_contacts.index') }}"><i class="fa fa-circle-o"></i> Contact</a></li>
                <li class="{{ \Auth::User()->grantAccess('persons') }}"><a href="{{ route('persons.index') }}"><i class="fa fa-circle-o"></i> Person</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-car"></i> <span>Car</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('brands') }}"><a href="{{ route('brands.index') }}"><i class="fa fa-circle-o"></i> Brand</a></li>
                <li class="{{ \Auth::User()->grantAccess('car_images') }}"><a href="{{ route('car_images.index') }}"><i class="fa fa-circle-o"></i> Images</a></li>
                <li class="{{ \Auth::User()->grantAccess('models') }}"><a href="{{ route('models.index') }}"><i class="fa fa-circle-o"></i> Model</a></li>
                <li class="{{ \Auth::User()->grantAccess('car_penalties') }}"><a href="{{ route('car_penalties.index') }}"><i class="fa fa-circle-o"></i> Penalty</a></li>
                <li class="{{ \Auth::User()->grantAccess('types') }}"><a href="{{ route('types.index') }}"><i class="fa fa-circle-o"></i> Type</a></li>
                <li class="{{ \Auth::User()->grantAccess('vehicles') }}"><a href="{{ route('vehicles.index') }}"><i class="fa fa-circle-o"></i> Vehicles</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-money"></i> <span>Transaction</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('orders') }}"><a href="{{ route('orders.index') }}"><i class="fa fa-circle-o"></i> Order</a></li>
                <li class="{{ \Auth::User()->grantAccess('purchases') }}"><a href="{{ route('purchases.index') }}"><i class="fa fa-circle-o"></i> Purchase</a></li>
            </ul>
        </li>

        <li><a href="javacsript:void(0);"><i class="fa fa-line-chart"></i> <span>Report</span></a></li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-gears"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="{{ \Auth::User()->grantAccess('audits') }}"><a href="{{ route('audits.index') }}"><i class="fa fa-circle-o"></i> Audit Log</a></li>
                <li class="{{ \Auth::User()->grantAccess('settings') }}"><a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i> Application</a></li>
                <li class="{{ \Auth::User()->grantAccess('users') }}"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> User</a></li>
                <li class="{{ \Auth::User()->grantAccess('roles') }}"><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> Role & Permission</a></li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->