<header class="topnav">
    <nav class="navbar navbar-expand-lg">
        <nav class="page-container">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown hover-dropdown">
                        <a class="nav-link dropdown-toggle drop-arrow-none" href="{{ url('/') }}">
                            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown hover-dropdown">
                        <a class="nav-link dropdown-toggle drop-arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="menu-icon"><i class="ti ti-apps"></i></span>
                            <span class="menu-text">Apps</span>
                            <div class="menu-arrow"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{ url('apps/calendar') }}" class="dropdown-item">Calendar</a>
                            <a href="{{ url('apps/chat') }}" class="dropdown-item">Chat</a>
                            <a href="{{ url('apps/email') }}" class="dropdown-item">Email</a>
                            <a href="{{ url('apps/file-manager') }}" class="dropdown-item">File Manager</a>
                            <a href="{{ url('apps/projects') }}" class="dropdown-item">Projects</a>
                            <div class="dropdown hover-dropdown">
                                <a class="dropdown-item dropdown-toggle drop-arrow-none" href="#" id="topnav-user"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    User
                                    <div class="menu-arrow"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-user">
                                    <a href="{{ url('apps/user/contacts') }}" class="dropdown-item">Contacts</a>
                                    <a href="{{ url('apps/user/profile') }}" class="dropdown-item">Profile</a>
                                </div>
                            </div>
                            <div class="dropdown hover-dropdown">
                                <a class="dropdown-item dropdown-toggle drop-arrow-none" href="#" id="topnav-tasks"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tasks
                                    <div class="menu-arrow"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tasks">
                                    <a href="{{ url('apps/kanban') }}" class="dropdown-item">Kanban</a>
                                    <a href="{{ url('apps/task-details') }}" class="dropdown-item">View Details</a>
                                </div>
                            </div>
                            <div class="dropdown hover-dropdown">
                                <a class="dropdown-item dropdown-toggle drop-arrow-none" href="#" id="topnav-invoices"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Invoice
                                    <div class="menu-arrow"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-invoices">
                                    <a href="{{ url('apps/invoices') }}" class="dropdown-item">Invoices</a>
                                    <a href="{{ url('apps/invoice-details') }}" class="dropdown-item">View Invoice</a>
                                    <a href="{{ url('apps/invoice-create') }}" class="dropdown-item">Create Invoice</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Additional menu items (Pages, Components, Layouts) can be similarly converted -->
                </ul>
            </div>
        </nav>
    </nav>
</header>