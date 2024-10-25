<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('professeur') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ route('prof.select')}} >
                <i class="bi bi-calendar"></i>
                <span>My Schedule</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <!-- Add more menu items specific to the professor -->

    </ul>

</aside><!-- End Sidebar-->
