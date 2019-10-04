<!DOCTYPE html>
<html>
    @include('parts.head')
    <body>
        @include('parts.navbar')
        @yield('content')
        @yield('extra-scripts')
    </body>
</html>