<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
@include('parts.scripts')
<div class="orta">
	<h3>Qeydiyyat</h3>
<div style="margin-left: 20px;">
	<br>
	<br>
	{{--<div style="margin: auto; width: 1000px">--}}
		{{--<div class="register_link_parent" style="text-align: center; float: left;display: block">--}}
			{{--height="262px"--}}
			{{--<a class="register_link" href="{{route('freelancer')}}"> <img class="register_link_image" style="" width="auto;" height="314px" src="{{asset('images/freelancer.png')}}"></a>--}}
			{{--<br>--}}
			{{--<span style=" font-family:sans-serif;"  class="afq">Freelancer Qeydiyyatı</span>--}}
		{{--</div>--}}
		{{--<div class="register_link_parent" style="text-align: center; float: left;display: block">--}}
			{{--height="240px"--}}
			{{--<a class="register_link" href="{{route('agency')}}"> <img class="register_link_image" width="auto" height="288px" src="{{asset('images/agentlik.png')}}"> </a>--}}
			{{--<br>--}}
			{{--<span style=" font-family:sans-serif; "  class="afq">Agentlik Qeydiyyatı</span>--}}
		{{--</div>--}}
		{{--<div class="register_link_parent" style="text-align: center; float: left;display: block">--}}
			{{--height:210px--}}
			{{--<a class="register_link" href="{{route('sahibkar')}}"><img class="register_link_image" style="margin-left: 5%; width:auto; height:252px" src="{{asset('images/brand5.jpg')}}"></a>--}}
			{{--<br>--}}
			{{--<span style =" font-family:sans-serif; margin-left: 18%; " class="afq">Marka Qeydiyyatı </span>--}}
		{{--</div>--}}
	{{--</div>--}}
	<div class="container m-auto">
		<div class="row">
			<div class="col register_link_parent">
				{{--height="262px"--}}
				{{--314px--}}
				<div class="row" style="height: 80%">
				<a class="register_link" href="{{route('freelancer')}}"> <img class="register_link_image" style="" width="auto;" height="376px" src="{{asset('images/freelancer.png')}}"></a>
				</div>
				<div style=" font-family:sans-serif;height: 20%"  class="row afq register_link_parent text-center ml-5"><br>Freelancer Qeydiyyatı</div>
					<br>

			</div>
			<div class="col register_link_parent">
				{{--height="240px"--}}
				{{--288px--}}
				<div class="row" style="height: 80%">
				<a class="register_link" href="{{route('agency')}}"> <img class="register_link_image" width="auto" height="345px" src="{{asset('images/agentlik1.png')}}"> </a>
				</div>
				<div style=" font-family:sans-serif;height: 20% "  class="row afq register_link_parent text-center ml-5"><br>Agentlik Qeydiyyatı</div>
					<br>

			</div>
			<div class="col register_link_parent">
				{{--height:210px--}}
				{{--252px--}}
				<div class="row" style="height: 80%">
				<a class="register_link" href="{{route('sahibkar')}}"><img class="register_link_image" style="margin-left: 5%; width:auto; height:302px" src="{{asset('images/brand5.jpg')}}"></a>
				</div>
				<div style =" font-family:sans-serif;height: 20%; " class="row afq register_link_parent text-center ml-5"><br>Marka Qeydiyyatı </div>
					<br>

			</div>
		</div>
		{{--<div class="row">--}}
			{{--<div style=" font-family:sans-serif;"  class="col afq register_link_parent text-center"><br>Freelancer Qeydiyyatı</div>--}}
			{{--<div style=" font-family:sans-serif; "  class="col afq register_link_parent text-center"><br>Agentlik Qeydiyyatı</div>--}}
			{{--<div style =" font-family:sans-serif; margin-left: 18%; " class="col afq register_link_parent text-center"><br>Marka Qeydiyyatı </div>--}}
		{{--</div>--}}
	</div>
	<br>
	<br>
	<br>
	<br>

	{{--<p style="height: 500px">--}}






	{{--</p>--}}



</div>
</div>
<br>
{{--<div style="float: bottom">--}}
	@include('parts.footer')
{{--</div>--}}
</body>


</html>