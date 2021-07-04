<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.head')
</head>

<body class="g-sidenav-show bg-white">

    @yield('content')

    @include('admin.layout.footer')

    @include('admin.layout.scripts')
</body>

</html>
