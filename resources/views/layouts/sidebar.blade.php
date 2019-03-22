<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    Dashboard
                    {{--<span class="right badge badge-primary">New</span>--}}
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/profile" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    Profile
                    <span class="right badge badge-danger">New</span>
                </p>
            </router-link>
        </li>

        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <span class="fa fa-power-off"></span>
                <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-book"></i>
                <p>
                    Pages
                    <i class="fa fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/users" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Users
                            {{--<span class="right badge badge-primary">New</span>--}}
                        </p>
                    </router-link>
                </li>
                @can('isAdmin')
                <li class="nav-item">
                    <router-link to="/developer" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Developer
                            {{--<span class="right badge badge-primary">New</span>--}}
                        </p>
                    </router-link>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="../examples/profile.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../examples/login.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Login</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../examples/register.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Register</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../examples/lockscreen.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Lockscreen</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header">
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->