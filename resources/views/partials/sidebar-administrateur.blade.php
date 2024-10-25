<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed"  href={{route('admin')}}>
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ route('admin.users.index') }}>
                <i class="bi bi-people"></i>
                <span>Manage Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href={{ route('departments.index')}}>
                <i class="bi bi-book"></i>
                <span>Departement</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href={{ route('filieres.create')}}>
                <i class="bi bi-pen"></i>
                <span>Filiere</span>
            </a>
        </li>


        <!-- Add more menu items as needed -->

    </ul>

</aside><!-- End Sidebar-->
