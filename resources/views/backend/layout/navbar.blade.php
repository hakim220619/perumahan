<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    <!--  Brand demo (display only for navbar-full and hide on below xl) -->

    <!-- ! Not required for layout-without-menu -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        {{-- <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <i class="bx bx-search bx-sm"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a>
            </div>
        </div> --}}
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->


            <!--/ Language -->


            <!-- Style Switcher -->
            {{-- <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class='bx bx-sm'></i>
                </a>
            </li> --}}

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-cart bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">10</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Cart</h5>
                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                    class="bx fs-4 bx bx-cart bx-sm"></i></a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            {{-- @foreach (Helper::comment() as $co)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                @if ($co->email_verified_at != null)
                                                    <img src="{{ $co->image }}" alt
                                                        class="w-px-40 h-auto rounded-circle">
                                                @else
                                                    <img src="{{ asset('/storage/images/users/' . $co->image . '') }}"
                                                        alt class="w-px-40 h-auto rounded-circle">
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $begin = new DateTime('now');
                                            $end = new DateTime($co->created_at);
                                            $date_post = $begin->diff($end);
                                        @endphp
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $co->full_name }}</h6>
                                            <p class="mb-0">{{ $co->body }}</p>
                                            @if ($date_post->format('%h') <= 1)
                                                <small
                                                    class="text-muted">{{ $date_post->format('%i menit yang lalu') }}</small>
                                            @elseif ($date_post->format('%d') <= 1)
                                                <small
                                                    class="text-muted">{{ $date_post->format('%h jam %i menit yang lalu') }}</small>
                                            @else
                                                <small
                                                    class="text-muted">{{ $date_post->format('%d hari %h jam yang lalu') }}</small>
                                            @endif

                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                    class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                    class="bx bx-x"></span></a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach --}}
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                        <a href="javascript:void(0);"
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40">
                            View all Cart
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    @if (request()->user()->role == 1)
                        <div class="avatar avatar-online">
                            <img src="{{ asset('') }}storage/images/users/{{ request()->user()->image }}"
                                alt="" class="w-px-40 rounded-circle">
                        </div>
                    @elseif (request()->user()->email_verified_at == null)
                        <div class="avatar avatar-online">
                            <img src="{{ asset('/storage/images/users/users_.png') }}" alt=""
                                class="w-px-40 rounded-circle">
                        </div>
                    @else
                        <div class="avatar avatar-online">
                            <img src="{{ request()->user()->image }}" alt="" class="w-px-40 rounded-circle">
                        </div>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="/">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    @if (request()->user()->role == 1)
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('') }}storage/images/users/{{ request()->user()->image }}"
                                                alt="" class="w-px-40 rounded-circle">
                                        </div>
                                    @elseif (request()->user()->email_verified_at == null)
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('/storage/images/users/users_.png') }}" alt=""
                                                class="w-px-40 rounded-circle">
                                        </div>
                                    @else
                                        <div class="avatar avatar-online">
                                            <img src="{{ request()->user()->image }}" alt=""
                                                class="w-px-40 rounded-circle">
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        {{ request()->user()->full_name }}
                                    </span>
                                    @if (request()->user()->role == 1)
                                        <small class="text-muted">Admin</small>
                                    @else
                                        <small class="text-muted">Anggota</small>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/pages/profile-user">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/list">
                            <i class="bx bx-credit-card me-2"></i>
                            <span class="align-middle">Billing</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class='bx bx-log-in me-2'></i>
                            <span class="align-middle">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search...">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>

</nav>
<!-- / Navbar -->
