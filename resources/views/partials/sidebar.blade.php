<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bimcab</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(auth()->user()->profile_image))
                    <img src="{{asset('/user-image/'.auth()->user()->profile_image)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                @if(auth()->user()->is_admin())
                    <?php 
                        $masterClass = $menu = "";
                        if(request()->is('vehicle*') || request()->is('country*') || request()->is('state*') || request()->is('city*')) {
                            $masterClass = "active";
                            $menu = "menu-open";
                        }
                    ?>
                    <li class="nav-item has-treeview {{$menu}}" id="module">
                        <a href="#" class="nav-link {{$masterClass}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Masters
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('vehicle_index') }}" class="nav-link @if(request()->is('vehicle*')) active @endif" id="vehicle-module">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Vehicles</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('country_index') }}" class="nav-link @if(request()->is('country*')) active @endif" id="country-module">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Country</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('state_index') }}" class="nav-link @if(request()->is('state*')) active @endif" id="state-module">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>State</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('city_index') }}" class="nav-link @if(request()->is('city*')) active @endif" id="city-module">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>City</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <?php 
                    $masterClass = $menu = "";
                    if(request()->is('driver*') || request()->is('unapproved_driver*')) {
                        $masterClass = "active";
                        $menu = "menu-open";
                    }
                ?>
                <li class="nav-item has-treeview {{$menu}}" id="dr-module">
                    <a href="#" class="nav-link {{$masterClass}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Driver
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('driver_index') }}" class="nav-link @if(request()->is('driver*')) active @endif" id="driver-module">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Drivers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('unapproved_driver_index') }}" class="nav-link @if(request()->is('unapproved_driver*')) active @endif" id="un-approved-driver-module">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Un-Approved Drivers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->is_admin())
                    <?php 
                        $masterClass = $menu = "";
                        if(request()->is('operator*')) {
                            $masterClass = "active";
                            $menu = "menu-open";
                        }
                    ?>
                    <li class="nav-item has-treeview {{$menu}}" id="dr-module">
                        <a href="#" class="nav-link {{$masterClass}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Operator
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('operator_index') }}" class="nav-link @if(request()->is('operator*')) active @endif" id="driver-module">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Operator</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>