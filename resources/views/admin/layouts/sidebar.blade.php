@extends('admin.layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header text-center p-3">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="logo-img mb-3">
            <button id="close-sidebar" class="close-sidebar d-md-none btn btn-sm btn-light">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="list-unstyled">
                <li class="{{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteNamed('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-list"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteNamed('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fas fa-box"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        <span>Cài đặt</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <style>
        .sidebar {
            background-color: #ffe6f0; /* hồng nhạt */
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar-header img.logo-img {
            height: 120px;
            width: auto;
        }
        .sidebar-menu ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 4px 10px;
        }
        .sidebar-menu ul li a i {
            margin-right: 10px;
        }
        .sidebar-menu ul li a:hover,
        .sidebar-menu ul li.active a {
            background-color: #caeee2ff; 
            color: #fff;
        }
        .toggle-sidebar-btn {
            position: fixed;
            top: 50%;
            left: 220px;
            transform: translateY(-50%);
            background-color: #f0c6dbff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .toggle-sidebar-btn:hover {
            background-color: #e9b2cdff;
        }
        .close-sidebar {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>

    <!-- Toggle sidebar button -->
    <button id="toggle-sidebar" class="toggle-sidebar-btn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const closeBtn = document.getElementById('close-sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.add('collapsed');
    });
</script>
@endsection
