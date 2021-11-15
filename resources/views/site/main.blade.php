<!doctype html>
<html class="no-js" lang="en">

    @include('site.layout.head')
<body>

<!-- preloader -->
    @include('site.layout.loader')
<!-- preloader-end -->

<!-- header-area -->
    @include('site.layout.header')
<!-- header-area-end -->

<!-- main-area -->
    @yield('content')
<!-- main-area-end -->

<!-- footer-area -->
    @include('site.layout.footer')
<!-- footer-area-end -->

<!-- JS here -->
    @include('site.layout.scripts')
</body>

</html>
