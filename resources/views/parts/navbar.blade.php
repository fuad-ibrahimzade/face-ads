{{--<nav class="navbar navbar-default">--}}
{{--<div class="container-fluid">--}}
{{--<ul class="nav navbar-nav">--}}
<ul class="navbar navbar-expand" style="height: 50px">
    {{--KOHNE 7SENTYABR--}}
    {{--<li class="xx"> <a class="xx" href="{{route('faceads')}}"><img style="width: 220px; height: 70px;" src="{{asset('images/Logo.png')}}"></a></li>--}}
    {{--<br>--}}
    {{--<li><a  href="{{route('fas')}}">Əsas Səhifə</a></li>--}}
{{--    <li style="margin-left: 40px;"><a  href="{{route('faceads')}}">Əsas Səhifə</a></li>--}}
    {{--<li><a  href="{{route('faceads')}}">Əsas Səhifə</a></li>--}}
    {{--<li><a href="{{route('about')}}">Biz Kimik ?</a></li>--}}

    {{--<li><a href="{{route('SI')}}"> Necə İstifadə Edim ?</a></li>--}}
    {{--<li><a href="{{route('rm')}}">Rəqəmsal Marketinqin Əhəmiyyəti Nədir ?</a></li>--}}
    {{--<li><a href="{{route('rating')}}">Ən Yaxşını Tap </a></li>--}}
    {{--<li><a href="{{route('contact')}}">Əlaqə</a></li>--}}
    {{--<li><a href="{{route('register')}}"> Qeydiyyat</a></li>--}}
    {{--<li><a href="{{route('login')}}">Daxil Ol</a></li>--}}
    {{--KOHNE 7SENTYABR--}}

    {{--YENIIIIIIIII--}}
    {{--width: 220px--}}

    <li style="margin-left: 20px;"> <a class="register_link" href="{{url('/')}}"><img style="width: auto; height: 50px;" src="{{asset("images/Logo.png")}}"> </a> </li><br>
    <li><a href="{{url('about')}}">Biz Kimik ? </a></li>
    <li class="dropdown">
        <span class="dropbtn"> Necə İstifadə Edim ?</span>
        <div class="dropdown-content">
            <a href="{{url('brand1')}}"> Brend olaraq</a>
            <a href="{{url('agentlik1')}}"> Agentlik olaraq</a>
            <a href="{{url('freelancer1')}}"> Frilanser olaraq</a>
        </div>
    </li>
    {{--<li class="dropdown">--}}
        {{--<span class="dropbtn dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--Dropdown button--}}
        {{--</span>--}}
        {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
            {{--<a class="dropdown-item" href="#">Action</a>--}}
            {{--<a class="dropdown-item" href="#">Another action</a>--}}
            {{--<a class="dropdown-item" href="#">Something else here</a>--}}
        {{--</div>--}}
    {{--</li>--}}
    <li><a href="{{url('register')}}"> Qeydiyyat</a></li>
    <li><a href="{{url('login')}}">Daxil Ol</a></li>
    <li><a href="{{url('contact')}}">Əlaqə</a></li>

    {{--YENIIIIIIIII--}}


    <!-- Authentication Links -->
    {{--@guest--}}
    {{--<li class="">--}}
        {{--<a class="" style="color: #dae0e5;" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--</li>--}}
    {{--@if (Route::has('register'))--}}
    {{--<ul class="">--}}
        {{--<a class="nav-link" style="color: #dae0e5;" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
        {{--</ul>--}}
    {{--@endif--}}
    {{--@else--}}
    {{--<ul class="">--}}
        {{--<a  class="" href="#" role="button" style="color: #dae0e5;" >--}}
            {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
            {{--</a>--}}
        {{--<em style="color: white; font-style: italic;">{{ Auth::user()->name }}</em>--}}
        {{--<div class="">--}}
            {{--<a class="" href="{{ route('logout') }}" style="color: #dae0e5;"--}}
               {{--onclick="event.preventDefault();--}}
                           {{--document.getElementById('logout-form').submit();">--}}
                {{--{{ __('Logout') }}--}}
            {{--</a>--}}

            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                {{--@csrf--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</ul>--}}
    {{--@endguest--}}
</ul>
{{--</div>--}}
{{--</nav>--}}

{{--<nav class="navbar navbar-toggleable-md navbar-light bg-faded">--}}
    {{--<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown">--}}
        {{--<span class="navbar-toggler-icon"></span>--}}
    {{--</button>--}}
    {{--<a class="navbar-brand" href="#">Navbar</a>--}}
    {{--<div class="collapse navbar-collapse" id="navbarNavDropdown">--}}
        {{--<ul class="navbar-nav">--}}
            {{--<li class="nav-item active">--}}
                {{--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">Features</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">Pricing</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item dropdown">--}}
                {{--<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--Dropdown link--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
                    {{--<a class="dropdown-item" href="#">Action</a>--}}
                    {{--<a class="dropdown-item" href="#">Another action</a>--}}
                    {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</nav>--}}
{{--<div class="dropdown">--}}
    {{--<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
        {{--Dropdown button--}}
    {{--</button>--}}
    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
        {{--<a class="dropdown-item" href="#">Action</a>--}}
        {{--<a class="dropdown-item" href="#">Another action</a>--}}
        {{--<a class="dropdown-item" href="#">Something else here</a>--}}
    {{--</div>--}}
{{--</div>--}}
<script>
    $(document).ready(function () {
        $('body').on('hover', '.dropdown', function(e) {
            $(e.target).dropdown('toggle');
        });
    })
</script>
<style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }
</style>
