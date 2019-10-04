<noscript><meta http-equiv="refresh" content="0; URL={{url('badbrowser')}}"></noscript>
<ul class="navbar navbar-expand" style="height: 50px">
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
    <li><a href="{{url('register')}}"> Qeydiyyat</a></li>
    <li><a href="{{url('login')}}">Daxil Ol</a></li>
    <li><a href="{{url('contact')}}">Əlaqə</a></li>

</ul>
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
