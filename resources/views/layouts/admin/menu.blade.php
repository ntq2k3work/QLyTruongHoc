<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" role="menu" data-lte-toggle="treeview" data-accordion="false">
                <!-- Dashboard Menu -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Dashboard v1</p>
                    </a>
                </li>

                <!-- Admin Menu - only for users with admin role -->
                @can('admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                @endcan

                <!-- Student Menu - only for users with student role -->
                @can('student')
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::is('student.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Student</p>
                        </a>
                    </li>
                @endcan

                <!-- Teacher Menu - only for users with teacher role -->
                @can('teacher')
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ Route::is('teacher.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Teacher</p>
                        </a>
                    </li>
                @endcan

                <!-- Parent Menu - only for users with parent role -->
                @can('parent')
                    <li class="nav-item">
                        <a href="{{ route('parent.dashboard') }}" class="nav-link {{ Route::is('parent.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Parent</p>
                        </a>
                    </li>
                @endcan
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
