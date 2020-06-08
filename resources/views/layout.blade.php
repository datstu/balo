<!DOCTYPE html>
<html lang="zxx">

<head>
   @include('pages/head/head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">@include('pages/head/hamberger_menu')</div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">@include('pages/head/header')</header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">@include('pages/banner/hero')</section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        @include('pages/category/show_category')
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">@yield('content')</section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img style="width: 450px;height: 213px;"  src="{{asset('public/user/img/banner/bn1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img style="width: 450px;height: 213px;" src="{{asset('public/user/img/banner/bn2.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">@include('pages/sanpham/sp_moinhat')</div>
                </div>
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">@include('pages/sanpham/sp_danhgia')</div>
                </div> --}}
                <div class="col-lg-6 col-md-6">  <div class="latest-product__text">@include('pages/sanpham/sp_khuyenmai')</div></div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
   {{--  <section class="from-blog spad">@include('pages/tintuc')</section> --}}
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">@include('pages/footer/footer')</footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('public/user/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/user/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('public/user/js/mixitup.min.js')}}"></script>
    <script src="{{asset('public/user/js/owl.carousel.min.j')}}s"></script>
    <script src="{{asset('public/user/js/main.js')}}"></script>



</body>

</html>