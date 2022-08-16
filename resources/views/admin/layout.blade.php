<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    @stack('title');


    <link href="{{asset('backend/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('backend/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('backend/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{asset('backend/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('backend/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('backend/css/theme.css')}}" rel="stylesheet" media="all">
</head>

<body>
      <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none" style="background-color:gray">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{ url('backend/images/icon/logo.png')}}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/category') }}">
                                <i class="fas fa-list"></i>Category</a>

                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/coupon') }}">
                                <i class="fas fa-tag"></i>Coupon</a>

                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/banner') }}">
                                <i class="fas fa-images"></i>Banner</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/size') }}">
                                <i class="fas fa-window-maximize"></i>Size</a>

                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/color') }}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('/category') }}">
                                <i class="fas fa-bold"></i>Brand</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/product') }}">
                                <i class="fa fa-"></i>Product</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/order') }}">
                                <i class="fa fa-user"></i>Orders</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/tax') }}">
                                <i class="fa fa-percent"></i>Tax</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ url('admin/customer') }}">
                                <i class="fa fa-user"></i>Customer</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block" style="background-color:white" >
            <div class="logo">
                <a href="#">
                    <img src="{{ url('backend/images/icon/logo.png')}}" alt="CoolAdmin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dash')">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('cate')">
                            <a href="{{ url('admin/category') }}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon')">
                            <a href="{{ url('admin/coupon') }}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                        <li class="@yield('banner')">
                            <a  href="{{ url('admin/banner') }}">
                                <i class="fas fa-images"></i>Banner</a>
                        </li>
                        <li class="@yield('size')">
                            <a href="{{ url('admin/size') }}">
                                <i class="fas fa-window-maximize"></i>Size</a>
                        </li>
                        <li class="@yield('color')">
                            <a href="{{ url('admin/color') }}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand')">
                            <a  href="{{ url('admin/brand') }}">
                                <i class="fa fa-bold"></i>Brand</a>
                        </li>
                        <li class="@yield('product')">
                            <a href="{{ url('admin/product') }}">
                                <i class="fa fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="@yield('review')">
                            <a class="js-arrow" href="{{ url('admin/review') }}">
                                <i class="fa fa-comment"></i>Reviews</a>
                        </li>
                        <li class="@yield('order')">
                            <a class="js-arrow" href="{{ url('admin/order') }}">
                                <i class="fa fa-shopping-cart"></i>Orders</a>
                        </li>
                         <li  class="@yield('tax')">
                            <a  href="{{ url('admin/tax') }}">
                                <i class="fa fa-percent"></i>Tax</a>
                         </li>
                         <li class="@yield('customer')">
                            <a  href="{{ url('admin/customer') }}">
                                <i class="fa fa-user"></i>Customer</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" >
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>

                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       @yield('content')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('backend/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>

    <!-- Main JS-->
    <script src="{{ url('backend/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->
