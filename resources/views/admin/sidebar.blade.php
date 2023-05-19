<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DSA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/img/profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() === 'enquiry.add' || Route::currentRouteName() === 'enquiry.manage' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::currentRouteName() === 'enquiry.add' || Route::currentRouteName() === 'enquiry.manage' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Enquiries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('enquiry.add') }}"
                                class="nav-link {{ Route::currentRouteName() === 'enquiry.add' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('enquiry.manage') }}"
                                class="nav-link {{ Route::currentRouteName() === 'enquiry.manage' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Enquiry</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.manage') }}"
                        class="nav-link {{ Route::currentRouteName() === 'contact.manage' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editProfile') }}"
                        class="nav-link {{ Route::currentRouteName() === 'editProfile' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() === 'user.add' || Route::currentRouteName() === 'user.manage' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::currentRouteName() === 'user.add' || Route::currentRouteName() === 'user.manage' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.add') }}"
                                class="nav-link {{ Route::currentRouteName() === 'user.add' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.manage') }}"
                                class="nav-link {{ Route::currentRouteName() === 'user.manage' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() === 'task.add' || Route::currentRouteName() === 'task.manage' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::currentRouteName() === 'task.add' || Route::currentRouteName() === 'task.manage' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Task
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('task.add') }}"
                                class="nav-link {{ Route::currentRouteName() === 'task.add' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Tak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('task.manage') }}"
                                class="nav-link {{ Route::currentRouteName() === 'task.manage' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Tasks</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('reporting') }}"
                        class="nav-link {{ Route::currentRouteName() === 'reporting' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Reporting
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('leave.manage') }}"
                        class="nav-link {{ Route::currentRouteName() === 'leaves' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-times"></i>
                        <p>
                            Leaves
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.manage') }}"
                        class="nav-link {{ Route::currentRouteName() === 'attendance' ? 'active' : '' }}">
                        <i class="nav-icon far fa-clock"></i>
                        <p>
                            Attendance
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link bg-white">
                        <i class="nav-icon fas fa-power-off text-danger"></i>
                        <p class="text-danger">Logout</p>
                    </a>
                </li>
                <li class="nav-item bg-danger rounded">
                    <a href="{{ route('markout') }}" class="nav-link">
                        <i class="nav-icon	fas fa-sign-out-alt"></i>
                        <p>
                            Markout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
