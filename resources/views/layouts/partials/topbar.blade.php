<header class="app-topbar" id="header">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-light">
                    <span class="logo-lg"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></span>
                    <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo"></span>
                </span>
                <span class="logo-dark">
                    <span class="logo-lg"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo"></span>
                    <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo"></span>
                </span>
            </a>
            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>
            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>
            <!-- Topbar Page Title -->
            <div class="topbar-item d-none d-md-flex px-2">
                <div>
                    <h4 class="page-title fs-20 fw-semibold mb-0">Olá, {{ auth()->user()->name ?? 'Usuário' }}!</h4>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <!-- Search for small devices -->
            <div class="topbar-item d-flex d-xl-none">
                <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                    <i class="ri-search-line fs-22"></i>
                </button>
            </div>
            <!-- Button Trigger Search Modal -->
            <div class="topbar-search text-muted d-none d-xl-flex gap-2 me-2 align-items-center" data-bs-toggle="modal"
                data-bs-target="#searchModal" type="button">
                <i class="ri-search-line fs-18"></i>
                <span class="me-2">Buscar Processo...</span>
            </div>
            <!-- Notification Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ri-notification-snooze-line animate-ring fs-22"></i>
                        <span class="noti-icon-badge"></span>
                    </button>
                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                        <div class="p-2 border-bottom position-relative border-dashed">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold">Notifications</h6>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none link-dark"
                                            data-bs-toggle="dropdown" data-bs-offset="0,15" aria-expanded="false">
                                            <i class="ri-settings-2-line fs-22 align-middle"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Mark as Read</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Delete All</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Do not Disturb</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Other Settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative rounded-0" style="max-height: 300px;" data-simplebar>
                            @foreach($notifications ?? [] as $notification)
                                <div class="dropdown-item notification-item py-2 text-wrap {{ $notification['active'] ? 'active' : '' }}" id="notification-{{ $notification['id'] }}">
                                    <span class="d-flex align-items-center">
                                        <span class="me-3 position-relative flex-shrink-0">
                                            <img src="{{ asset($notification['avatar']) }}" class="avatar-lg rounded-circle" alt="" />
                                        </span>
                                        <span class="flex-grow-1 text-muted">
                                            <span class="fw-medium text-body">{{ $notification['user'] }}</span> {{ $notification['action'] }}
                                            <br />
                                            <span class="fs-12">{{ $notification['time'] }}</span>
                                        </span>
                                        <span class="notification-item-close">
                                            <button type="button" class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                data-dismissible="#notification-{{ $notification['id'] }}">
                                                <i class="ri-close-line fs-16"></i>
                                            </button>
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item notification-item text-center text-reset text-decoration-underline fw-bold notify-item border-top border-light py-2">
                            View All
                        </a>
                    </div>
                </div>
            </div>
            <!-- Apps Dropdown -->
            <div class="topbar-item d-none d-sm-flex">
                <div class="dropdown">
                    <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ri-apps-2-add-line fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                        <div class="p-2">
                            <div class="row g-0">
                                @foreach([
                                    ['name' => 'Slack', 'icon' => 'slack.svg', 'url' => '#'],
                                    ['name' => 'Gitlab', 'icon' => 'gitlab.svg', 'url' => '#'],
                                    ['name' => 'Dribbble', 'icon' => 'dribbble.svg', 'url' => '#'],
                                    ['name' => 'Bitbucket', 'icon' => 'bitbucket.svg', 'url' => '#'],
                                    ['name' => 'Dropbox', 'icon' => 'dropbox.svg', 'url' => '#'],
                                    ['name' => 'G Cloud', 'icon' => 'google-cloud.svg', 'url' => '#'],
                                    ['name' => 'AWS', 'icon' => 'aws.svg', 'url' => '#'],
                                    ['name' => 'Server', 'icon' => 'digital-ocean.svg', 'url' => '#'],
                                    ['name' => 'Bootstrap', 'icon' => 'bootstrap.svg', 'url' => '#']
                                ] as $app)
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="{{ $app['url'] }}">
                                            <img src="{{ asset('assets/images/brands/' . $app['icon']) }}" alt="{{ $app['name'] }}">
                                            <span>{{ $app['name'] }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button Trigger Customizer Offcanvas -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" type="button">
                    <i class="ri-settings-4-line fs-22"></i>
                </button>
            </div>
            <!-- Light/Dark Mode Button -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" id="light-dark-mode" type="button">
                    <i class="ri-moon-line light-mode-icon fs-22"></i>
                    <i class="ri-sun-line dark-mode-icon fs-22"></i>
                </button>
            </div>
            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset(auth()->user()->avatar ?? 'assets/images/users/avatar-1.jpg') }}" width="32" class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">{{ auth()->user()->name ?? 'Nowak Helme' }}</h5>
                        </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="" class="dropdown-item">
                            <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">My Account</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Wallet: <span class="fw-semibold">$89.25k</span></span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ri-question-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Support</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ri-lock-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Lock Screen</span>
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item active fw-semibold text-danger">
                            <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Sign Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>