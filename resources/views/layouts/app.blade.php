<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>IMedidata</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles
    @livewireScripts
</head>
<body >
<div class="wrapper">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              @if(Request::get('theme') == 'dark')
                    <a href="{{ url('/') }}" class="nav-link px-0 hide-theme-light" >
                    <img src="{{ asset('img/white_medidata_logo.png') }}" width="110" height="20" style="height: 24px" alt="Tabler" class="navbar-brand-image">
                    </a>
                @else

                  <a href="{{ url('/') }}" class="nav-link px-0 hide-theme-dark" >
                    <img src="{{ asset('img/blackmedidata_logo.png') }}" width="110" height="20" style="height: 24px" alt="Tabler" class="navbar-brand-image">
                </a>
                  @endif
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                </div>
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                </a>
{{--                <div class="nav-item dropdown d-none d-md-flex me-3">--}}
{{--                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">--}}
{{--                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>--}}
{{--                        <span class="badge bg-red"></span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <span class="avatar avatar-sm">{{ mb_substr(Auth::user()->name, 0 ,1)}}</span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ ucwords(Auth::user()->name) }}</div>
                            <div class="mt-1 small text-muted">{{ Auth::user()->is_admin == 1 ? 'Admin' : "User" }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        @can('create-study')
                            <a href="{{ route('users.index') }}" class="dropdown-item">Users Listing</a>
                        @endcan
{{--                        <a href="#" class="dropdown-item">Profile & account</a>--}}
{{--                        <a href="#" class="dropdown-item">Feedback</a>--}}
                        <div class="dropdown-divider"></div>
{{--                        <a href="#" class="dropdown-item">Settings</a>--}}
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('/') }}" >
                              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>                              </span>
                                <span class="nav-link-title">
                                All Studies
                              </span>
                            </a>
                        </li>


                        @if(Request::segment(count(request()->segments())) == 'subject' )

                            <li class="nav-item ">
                                <a class="nav-link" href="{{ '../' }}" >
                              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                  <!-- Download SVG icon from http://tabler-icons.io/i/layers-union -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2v-2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-2" /></svg>                              </span>
                                    <span class="nav-link-title">
                                Sites
                              </span>
                                </a>
                            </li>
                        @endif

                    </ul>
{{--                    <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">--}}
{{--                        <form action="." method="get">--}}
{{--                            <div class="input-icon">--}}
{{--                    <span class="input-icon-addon">--}}
{{--                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>--}}
{{--                    </span>--}}
{{--                                <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="container-xl">
            @if(Request::segment(1) != "")
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                         @yield('name')  {{ ucwords(Request::segment(count(request()->segments()))) }}@yield('plural')
                            </h2>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Page title -->

        </div>
        <div class="page-body">
            <div class="container-xl d-flex flex-column justify-content-center">

                @yield('content')
            </div>
        </div>

    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('dist/js/tabler.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.min.js')}}"></script>
@stack('scripts')
</body>
</html>
